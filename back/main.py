from fastapi import FastAPI
from back.routes import search, add, auth 
from back.database import engine, Base  

Base.metadata.create_all(bind=engine)

app = FastAPI()

app.include_router(search.router, prefix="/api")
app.include_router(add.router, prefix="/api")
app.include_router(auth.router, prefix="/api")

@app.get("/")
def home():
    return {"message": "Lost & Found API"}
