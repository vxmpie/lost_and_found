# ระบบ Authentication  สำหรับการเข้าสู่ระบบ
# from sqlalchemy.orm import create_engine

from sqlalchemy import create_engine

class Auth():
    def __init__(self, db_host, db_user, db_pass, db_database):
        self.engine = None
        self.db_host = db_host
        self.db_user = db_user
        self.db_pass = db_pass
        self.db_db = db_database

    def connector(self):
        self.engine = create_engine(
            f"mysql+pymysql://{self.db_user}:{self.db_pass}@{self.db_host}/{self.db_db}?charset=utf8mb4"
        )

        try:
            with self.engine.connect() as connection:
                print("Connected to the database successfully!")
        except Exception as e:
            print(f"Error: {e}")


        # print("Connected to the database successfully!")


sql = Auth("89.213.177.80", "toon", "toon1234", "lostnfound")
sql.connector()