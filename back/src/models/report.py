from pydantic import BaseModel
from typing import Literal

class Report(BaseModel):
    lost_item_id: int
    reason: str
    status: Literal["pending", "reviewed"] = "pending"

