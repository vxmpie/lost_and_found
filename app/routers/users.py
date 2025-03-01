from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from app.config.database import SessionLocal
from app.models.models import User
from app.schemas.schemas import UserCreate, UserLogin
from passlib.context import CryptContext
import jwt
import datetime

router = APIRouter()
SECRET_KEY = "supersecret"

pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")

def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

# 🔹 Register API
@router.post("/register")
def register(user: UserCreate, db: Session = Depends(get_db)):
    hashed_password = pwd_context.hash(user.password)
    db_user = User(username=user.username, password_hash=hashed_password)
    db.add(db_user)
    db.commit()
    return {"message": "User created successfully"}

# 🔹 Login API
@router.post("/login")
def login(user: UserLogin, db: Session = Depends(get_db)):
    db_user = db.query(User).filter(User.username == user.username).first()
    if not db_user or not pwd_context.verify(user.password, db_user.password_hash):
        raise HTTPException(status_code=400, detail="Invalid credentials")
    
    token = jwt.encode({"sub": db_user.username, "exp": datetime.datetime.utcnow() + datetime.timedelta(hours=12)}, SECRET_KEY)
    return {"token": token}