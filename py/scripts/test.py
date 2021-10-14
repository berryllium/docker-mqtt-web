# Module Imports
import mariadb
import sys
import os

# Connect to MariaDB Platform
try:
    conn = mariadb.connect(
        user=os.environ.get('DB_USER'),
        password=os.environ.get('DB_PASSWORD'),
        host=os.environ.get('DB_HOST'),
        port=int(os.environ.get('DB_PORT')),
        database=os.environ.get('DB_NAME'),
    )
    print("Success")
except mariadb.Error as e:
    print(f"Error connecting to MariaDB Platform: {e}")
    sys.exit(1)

# Get Cursor
cur = conn.cursor()