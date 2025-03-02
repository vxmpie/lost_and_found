from pydantic import BaseModel
from typing import Optional
from datetime import date

class LostItem(BaseModel):
    item_name: str
    description: Optional[str] = None
    location: Optional[str] = None
    date_lost: date