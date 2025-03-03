from sqlalchemy import Column, Integer, String, Text, Date, TIMESTAMP
from database import Base

class User(Base):
    __tablename__ = "users"
    
    id = Column(Integer, primary_key=True, index=True)
    username = Column(String(50), unique=True, nullable=False)
    password = Column(String(255), nullable=False)
    created_at = Column(TIMESTAMP, nullable=False)

class Item(Base):
    __tablename__ = "items"
    
    id = Column(Integer, primary_key=True, index=True)
    name = Column(String(100), nullable=False)
    image = Column(String(255), nullable=False)
    description = Column(Text)
    date_found = Column(Date, nullable=False)
    location = Column(String(255), nullable=False)
    created_at = Column(TIMESTAMP, nullable=False)
