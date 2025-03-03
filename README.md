# Lost and Found Backend

## Introduction

This is the backend for the Lost and Found application, built with FastAPI and connected to a MySQL database.

## Setup

1. Clone the repository:

```bash
git clone https://github.com/vxmpie/lost_and_found_backend.git
cd lost_and_found_backend
```

2. Create a virtual environment and activate it:

```bash
python -m venv venv
source venv/bin/activate
```

3. Install the dependencies:

```bash
pip install -r requirements.txt
```

4. Create a `.env` file and add your database URL:

```env
DATABASE_URL=mysql://user:password@89.213.177.80:8120/lostnfound
```

5. Run the database migrations:

```bash
alembic upgrade head
```

6. Start the FastAPI server:

```bash
uvicorn app.main:app --reload
```

## Endpoints

- `/users`: User management endpoints
- `/items`: Item management endpoints
- `/reports`: Report management endpoints

## Database Models

- `User`: Stores user information
- `Item`: Stores item information
- `Report`: Stores report information

## License

This project is licensed under the MIT License.