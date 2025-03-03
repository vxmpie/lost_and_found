from pydantic import BaseModel

class UserLogin(BaseModel):
    username: str
    password: str

class UserBase(BaseModel):
    username: str
    email: str

class UserCreate(UserBase):
    password: str

class User(UserBase):
    id: int

    class Config:
        orm_mode = True
        
class Item(BaseModel):
    name: str
    description: str
    price: float
    tax: float = None