from fastapi import FastAPI
from back.routers import user, item, report

app = FastAPI()

app.include_router(user.router)
app.include_router(item.router)
app.include_router(report.router)

@app.get("/")
def read_root():
    return {"message": "Welcome to Lost and Found API"}