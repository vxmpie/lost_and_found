from fastapi import APIRouter, Depends, Form, UploadFile, File
from sqlalchemy.orm import Session
from database import SessionLocal
from models import Item
import shutil
import os

router = APIRouter()

def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

UPLOAD_DIR = "frontend/static/images/"

@router.post("/add")
def add_item(
    name: str = Form(...),
    description: str = Form(...),
    date_found: str = Form(...),
    location: str = Form(...),
    image: UploadFile = File(...),
    db: Session = Depends(get_db)
):
    file_path = os.path.join(UPLOAD_DIR, image.filename)
    with open(file_path, "wb") as buffer:
        shutil.copyfileobj(image.file, buffer)

    new_item = Item(
        name=name,
        description=description,
        date_found=date_found,
        location=location,
        image=file_path
    )
    
    db.add(new_item)
    db.commit()
    db.refresh(new_item)

    return {"message": "Item added successfully", "item": new_item}
