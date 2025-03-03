import os
from mysql.connector import pooling
from dotenv import load_dotenv

load_dotenv()

db_config = {
    "host": os.getenv("DB_HOST"),
    "user": os.getenv("DB_USER"),
    "password": os.getenv("DB_PASS"),
    "database": os.getenv("DB_NAME"),
    "charset": "utf8mb4",
    "collation": "utf8mb4_general_ci"
}

connection_pool = pooling.MySQLConnectionPool(pool_name="mypool", pool_size=10, **db_config)

def get_db_connection():
    return connection_pool.get_connection()

def execute_query(query, values=None):
    with get_db_connection() as conn:
        with conn.cursor() as cursor:
            cursor.execute(query, values)
            conn.commit()

def fetch_one(query, values=None):
    with get_db_connection() as conn:
        with conn.cursor(dictionary=True) as cursor:
            cursor.execute(query, values)
            return cursor.fetchone()

def fetch_all(query, values=None):
    with get_db_connection() as conn:
        with conn.cursor(dictionary=True) as cursor:
            cursor.execute(query, values)
            return cursor.fetchall()