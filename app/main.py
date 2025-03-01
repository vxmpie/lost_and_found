# ไฟล์หลัก FastAPI  

from fastapi import FastAPI
from app.routers import items, users

app = FastAPI()

app.include_router(users.router, prefix="/api")
app.include_router(items.router, prefix="/api")

