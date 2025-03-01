import requests

# ทดสอบการลงทะเบียน (Register)
response = requests.post("http://localhost:8000/api/register", json={
    "username": "testuser",
    "password": "testpassword"
})
print("Register Response:", response.json())

# ทดสอบการเข้าสู่ระบบ (Login)
response = requests.post("http://localhost:8000/api/login", json={
    "username": "testuser",
    "password": "testpassword"
})
print("Login Response:", response.json())