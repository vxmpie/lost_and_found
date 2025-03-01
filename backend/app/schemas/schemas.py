from pydantic import BaseModel
from datetime import datetime

class UserBase(BaseModel):
    username: str

class UserCreate(UserBase):
    password: str

class UserLogin(UserBase):
    password: str

class User(UserBase):
    id: int
    role: str

    class Config:
        orm_mode: True

class ItemBase(BaseModel):
    item: str
    description: str
    location: str

class ItemCreate(ItemBase):
    user_id: int

class Item(ItemBase):
    id: int
    user_id: int
    date: datetime
    status: str

    class Config:
        orm_mode: True