from pydantic import BaseModel

class ItemBase(BaseModel):
    name: str
    description: str
    date: str
    location: str
    image_url: str

class ItemCreate(ItemBase):
    pass

class Item(ItemBase):
    id: int
    owner_id: int

    class Config:
        orm_mode = True