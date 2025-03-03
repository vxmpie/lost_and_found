from fastapi import APIRouter, Depends
from sqlalchemy.orm import Session
from ..database import SessionLocal
from models import Item

router = APIRouter()

def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

@router.get("/search")
def search_items(query: str, db: Session = Depends(get_db)):
    items = db.query(Item).filter(Item.name.contains(query)).all()
    return {"results": items}
