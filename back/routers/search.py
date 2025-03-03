from fastapi import APIRouter, Depends, HTTPException
from typing import List
from sqlalchemy.orm import Session
from back import models, schemas, dependencies
from back.database import get_db

router = APIRouter(
    prefix="/search",
    tags=["search"],
)

@router.get("/", response_model=List[schemas.Item])
def search_items(query: str, db: Session = Depends(get_db)):
    results = db.query(models.Item).filter(models.Item.name.contains(query)).all()
    if not results:
        raise HTTPException(status_code=404, detail="No items found")
    return results