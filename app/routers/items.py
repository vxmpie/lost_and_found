# API สำหรับของหาย 

from fastapi import APIRouter, Depends
from sqlalchemy.orm import Session
from app.config.database import SessionLocal
from app.models.models import Item
from datetime import datetime

router = APIRouter()

def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

# 🔹 แจ้งของหาย
@router.post("/items")
def create_item(user_id: int, item: str, description: str, location: str, db: Session = Depends(get_db)):
    new_item = Item(user_id=user_id, item=item, description=description, location=location, date=datetime.utcnow())
    db.add(new_item)
    db.commit()
    return {"message": "Item reported successfully", "id": new_item.id}

# 🔹 ดึงของหายทั้งหมด
@router.get("/items")
def get_items(db: Session = Depends(get_db)):
    items = db.query(Item).all()
    return items

@router.get("/search")
def search_items(q: str, db: Session = Depends(get_db)):
    items = db.query(Item).filter(Item.item.ilike(f"%{q}%")).all()
    return items
