from fastapi import APIRouter, HTTPException, Depends
from src.database import execute_query, fetch_one, fetch_all
from src.routes.auth import admin_required
from src.models.report import Report

router = APIRouter()

@router.post("/reports")
def create_report(report: Report, user=Depends(admin_required)):
    lost_item = fetch_one("SELECT id FROM lost_items WHERE id = %s", (report.lost_item_id,))
    
    if not lost_item:
        raise HTTPException(status_code=404, detail="Lost item not found")

    sql = "INSERT INTO reports (lost_item_id, reason, status) VALUES (%s, %s, %s)"
    values = (report.lost_item_id, report.reason, report.status)
    execute_query(sql, values)

    return {"message": "Report submitted successfully!"}

@router.get("/reports")
def get_all_reports(user=Depends(admin_required)):
    reports = fetch_all("SELECT * FROM reports")
    return reports