from fastapi import APIRouter, HTTPException, Query
from src.models.lost_item import LostItem
from src.database import get_db_connection
from rapidfuzz import fuzz
from src.utils import send_email

router = APIRouter()

@router.get("/lost-items")
def get_lost_items():
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM lost_items")
    items = cursor.fetchall()
    conn.close()
    return items

@router.get("/lost-items/search")
def search_lost_items(q: str = Query(..., min_length=1)):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)

    search_query = "SELECT * FROM lost_items WHERE MATCH(item_name, description) AGAINST (%s IN NATURAL LANGUAGE MODE)"
    cursor.execute(search_query, (q,))
    results = cursor.fetchall()

    if not results:
        cursor.execute("SELECT * FROM lost_items")
        all_items = cursor.fetchall()
        matches = [
            (fuzz.partial_ratio(q.lower(), item["item_name"].lower()), item)
            for item in all_items
        ]
        results = [match[1] for match in sorted(matches, key=lambda x: x[0], reverse=True) if match[0] >= 60]

    conn.close()
    return results

@router.put("/lost-items/{item_id}/status")
def update_lost_item_status(item_id: int, new_status: str):
    if new_status not in ["lost", "found"]:
        raise HTTPException(status_code=400, detail="Invalid status")

    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)

    cursor.execute("SELECT * FROM lost_items WHERE id = %s", (item_id,))
    item = cursor.fetchone()

    if not item:
        conn.close()
        raise HTTPException(status_code=404, detail="Lost item not found")

    cursor.execute("UPDATE lost_items SET status = %s WHERE id = %s", (new_status, item_id))
    conn.commit()

    if new_status == "found":
        email_subject = "🔔 แจ้งเตือน: เราพบของหายของคุณแล้ว!"
        email_message = f"""
        <h3>สวัสดี {item['user_email']},</h3>
        <p>ระบบของเราได้พบ <b>{item['item_name']}</b> ที่คุณแจ้งว่าหายไปแล้ว!</p>
        <p>กรุณาติดต่อแอดมินเพื่อนัดรับของของคุณกลับไป 🎉</p>
        <p>ขอบคุณที่ใช้บริการ!</p>
        """
        send_email(item["user_email"], email_subject, email_message)

    conn.close()
    return {"message": f"Item status updated to {new_status}"}