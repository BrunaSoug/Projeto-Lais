import sqlite3
from pathlib import Path
from app.config import CACHE_DB_PATH

class QACache:
    def __init__(self):
        self.conn = sqlite3.connect(Path(CACHE_DB_PATH).as_posix(), check_same_thread=False)

    def get_answer(self, question):
        cursor = self.conn.cursor()
        cursor.execute("SELECT answer FROM qa_cache WHERE question = ?", (question,))
        result = cursor.fetchone()
        return result[0] if result else None

    def save_answer(self, question, answer):
        cursor = self.conn.cursor()
        cursor.execute("INSERT OR IGNORE INTO qa_cache (question, answer) VALUES (?, ?)", (question, answer))
        self.conn.commit()
