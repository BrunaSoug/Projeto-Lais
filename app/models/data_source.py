from langchain_community.utilities.sql_database import SQLDatabase
from pathlib import Path

class LangchainDataSource:
    """Fonte de dados utilizada pelo LangChain para responder perguntas."""

    def __init__(self, db_path):
        db_uri = f"sqlite:///{Path(db_path).as_posix()}"
        self.db = SQLDatabase.from_uri(db_uri, include_tables=["data"], sample_rows_in_table_info=3)

    def get(self):
        return self.db
