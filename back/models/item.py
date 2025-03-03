from sqlalchemy import Column, Integer, String, ForeignKey
from sqlalchemy.orm import relationship
from back.database import Base

class Item(Base):
    __tablename__ = "items"

    id = Column(Integer, primary_key=True, index=True)
    name = Column(String, index=True)
    description = Column(String, index=True)
    date = Column(String, index=True)
    location = Column(String, index=True)
    image = Column(String, index=True)
    owner_id = Column(Integer, ForeignKey("users.id"))

    owner = relationship("User", back_populates="items")