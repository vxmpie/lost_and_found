from sqlalchemy import Column, Integer, String, ForeignKey
from sqlalchemy.orm import relationship
from back.database import Base

class Report(Base):
    __tablename__ = "reports"

    id = Column(Integer, primary_key=True, index=True)
    issue_type = Column(String, index=True)
    description = Column(String)
    user_id = Column(Integer, ForeignKey("users.id"))

    user = relationship("User", back_populates="reports")