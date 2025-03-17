import asyncio
import json
import uvicorn
from fastapi import FastAPI, WebSocket, WebSocketDisconnect
from langchain_community.utilities.sql_database import SQLDatabase
from langchain_community.agent_toolkits import create_sql_agent
from langchain_groq import ChatGroq
from pathlib import Path
from translate import Translator

class ChatBot:
    def __init__(self):
        self.db = None
        self.chat_model = None
        self.agent_executor = None
        self.manager = ConnectionManager()

    def initialize(self, db_path, model_name, api_key):
        db_uri = f"sqlite:///{db_path}"
        self.db = SQLDatabase.from_uri(db_uri)
        
        self.chat_model = ChatGroq(
            temperature=0,
            model=model_name,
            api_key=api_key
        )
        
        self.agent_executor = create_sql_agent(
            self.chat_model,
            db=self.db,
            agent_type="openai-tools",
        )

    async def handle_connection(self, websocket):
        await self.manager.connect(websocket)
        try:
            while True:
                data = await websocket.receive_text()
                request = json.loads(data)
                question = request.get("question", "")
                if question:
                    print(f"Pergunta: {question}")
                    question = f"Responda em português: {question}"
                    response = await self._process_question(question)
                    print(f"Resposta: {response}")
                    await self.manager.send_message(response, websocket)
        except WebSocketDisconnect:
            ip = websocket.client.host
            print(f"Cliente desconectado. IP: {ip}")
            self.manager.disconnect(websocket)
        except Exception as e:
            print(f"Erro inesperado: {e}")
            await self.manager.send_message("Erro ao processar a consulta.", websocket)

    async def _process_question(self, question):
        result = await asyncio.to_thread(self.agent_executor.invoke, question)
        response = result.get("output")
        if response:
            translated_response = self.translate_to_portuguese(response)
            return translated_response
        return response

    def translate_to_portuguese(self, text):
        translator = Translator(to_lang="pt")
        return translator.translate(text)

class ConnectionManager:
    def __init__(self):
        self.active_connections = {}

    async def connect(self, websocket):
        await websocket.accept()
        ip = websocket.client.host
        self.active_connections[websocket] = True
        print(f"Cliente conectado. IP: {ip}")

    def disconnect(self, websocket):
        if websocket in self.active_connections:
            del self.active_connections[websocket]

    async def send_message(self, message, websocket):
        await websocket.send_text(json.dumps({"response": message}))

chat_bot = ChatBot()

app = FastAPI()

@app.websocket("/chat")
async def websocket_endpoint(websocket: WebSocket):
    db_path = Path("C:/Users/evert/Desktop/Projeto/dados.db").as_posix()
    model_name = "llama3-70b-8192"
    api_key = "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"
    
    chat_bot.initialize(db_path, model_name, api_key)
    await chat_bot.handle_connection(websocket)

if __name__ == "__main__":
    uvicorn.run(app, host="0.0.0.0", port=8000, log_level="info")
