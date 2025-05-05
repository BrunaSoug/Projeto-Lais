import os

# Função para carregar variáveis do .env manualmente
def load_env_file(path="app/.env"):
    if not os.path.exists(path):
        raise FileNotFoundError(f"Arquivo {path} não encontrado.")
    
    with open(path) as f:
        for line in f:
            line = line.strip()
            if not line or line.startswith("#"):
                continue  # pula linhas vazias ou comentários
            key, value = line.split("=", 1)
            key = key.strip()
            value = value.strip().strip('"').strip("'")  # remove aspas se houver
            os.environ[key] = value

# Carrega as variáveis
load_env_file()

# Usa as variáveis
DB_PATH = os.environ.get("DB_PATH")
API_KEY = os.environ.get("API_KEY")
MODEL_NAME = "llama3-70b-8192"
