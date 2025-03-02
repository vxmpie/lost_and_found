from fastapi import APIRouter, HTTPException, Depends, Request
from src.database import get_db_connection
from src.models.user import UserRegister, UserLogin, TokenResponse
import bcrypt
import jwt
import os
from datetime import datetime, timedelta
from typing import Optional

router = APIRouter()
SECRET_KEY = os.getenv("SECRET_KEY", "fallback_secret_key")
ALGORITHM = "HS256"

def hash_password(password: str) -> str:
    return bcrypt.hashpw(password.encode('utf-8'), bcrypt.gensalt()).decode('utf-8')

def verify_password(password: str, hashed_password: str) -> bool:
    return bcrypt.checkpw(password.encode('utf-8'), hashed_password.encode('utf-8'))

def create_access_token(data: dict, expires_delta: timedelta):
    to_encode = data.copy()
    expire = datetime.utcnow() + expires_delta
    to_encode.update({"exp": expire})
    return jwt.encode(to_encode, SECRET_KEY, algorithm=ALGORITHM)

@router.post("/register")
def register(user: UserRegister, admin_secret: Optional[str] = None):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)

    cursor.execute("SELECT * FROM users WHERE email = %s", (user.email,))
    existing_user = cursor.fetchone()
    if existing_user:
        conn.close()
        raise HTTPException(status_code=400, detail="Email already registered")

    expected_secret = os.getenv("ADMIN_SECRET_KEY")
    role = "admin" if admin_secret == expected_secret else "user"

    hashed_password = hash_password(user.password)
    sql = "INSERT INTO users (username, email, password_hash, role) VALUES (%s, %s, %s, %s)"
    cursor.execute(sql, (user.username, user.email, hashed_password, role))
    conn.commit()
    conn.close()

    return {"message": f"User registered as {role} successfully!"}

@router.post("/login", response_model=TokenResponse)
def login(user: UserLogin):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)

    cursor.execute("SELECT * FROM users WHERE email = %s", (user.email,))
    db_user = cursor.fetchone()
    conn.close()

    if not db_user or not verify_password(user.password, db_user["password_hash"]):
        raise HTTPException(status_code=401, detail="Invalid email or password")

    access_token = create_access_token(data={"sub": db_user["email"], "role": db_user["role"]}, expires_delta=timedelta(hours=2))
    return {"access_token": access_token, "token_type": "bearer"}

def get_current_user(request: Request):
    token = request.headers.get("Authorization")
    if not token or not token.startswith("Bearer "):
        raise HTTPException(status_code=401, detail="Invalid token")

    token = token.split(" ")[1]
    try:
        payload = jwt.decode(token, SECRET_KEY, algorithms=[ALGORITHM])
        return payload
    except jwt.ExpiredSignatureError:
        raise HTTPException(status_code=401, detail="Token expired")
    except jwt.InvalidTokenError:
        raise HTTPException(status_code=401, detail="Invalid token")

def admin_required(user=Depends(get_current_user)):
    if user.get("role") != "admin":
        raise HTTPException(status_code=403, detail="Admin access required")
    return user

@router.post("/reset-password")
def reset_password(email: str, new_password: str):
    conn = get_db_connection()
    cursor = conn.cursor()

    cursor.execute("SELECT * FROM users WHERE email = %s", (email,))
    user = cursor.fetchone()
    if not user:
        conn.close()
        raise HTTPException(status_code=404, detail="User not found")

    hashed_password = hash_password(new_password)
    cursor.execute("UPDATE users SET password_hash = %s WHERE email = %s", (hashed_password, email))
    conn.commit()
    conn.close()

    return {"message": "Password reset successfully!"}