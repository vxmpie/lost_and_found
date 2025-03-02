import sys
import os
sys.path.append(os.path.dirname(os.path.abspath(__file__)))

from fastapi import FastAPI
from src.routes.lost_items import router as lost_items_router
from src.routes.reports import router as reports_router
from src.routes.auth import router as auth_router

app = FastAPI()

app.include_router(lost_items_router, prefix="/api")
app.include_router(reports_router, prefix="/api")
app.include_router(auth_router, prefix="/api/auth")

@app.get("/")
def home():
    return {"message": "Lost and Found API is running!"}