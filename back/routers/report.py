from fastapi import APIRouter

router = APIRouter()

@router.get("/reports/")
async def read_reports():
    return [{"report_id": "report1"}, {"report_id": "report2"}]