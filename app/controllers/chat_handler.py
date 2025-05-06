import asyncio
import json
from fastapi import WebSocket, WebSocketDisconnect
from app.services.agent import Agent
from app.services.translator import Translator
from app.services.qa_cache import QACache
from app.models.data_source import LangchainDataSource
from app.controllers.connection_manager import ConnectionManager

class ChatHandler:
    """Gerencia a comunicação via WebSocket para o chat."""

    def __init__(self, db_path, model_name, api_key):
        self.cache = QACache()
        self.db = LangchainDataSource(db_path).get()
        self.agent = Agent(self.db, model_name, api_key)
        self.translator = Translator()
        self.connection_manager = ConnectionManager()

    async def handle(self, websocket: WebSocket):
        await self.connection_manager.connect(websocket)

        try:
            while True:
                raw_data = await websocket.receive_text()
                data = json.loads(raw_data)
                question = data.get("question", "")
                if question:
                    print(f"[Pergunta] {question}")
                    translated_response = await self._generate_response(question.lower())
                    print(f"[Resposta] {translated_response}")
                    await self.connection_manager.send_message(translated_response, websocket)
        except WebSocketDisconnect:
            client_ip = websocket.client.host
            print(f"Desconectado: {client_ip}")
            self.connection_manager.disconnect(websocket)
        except Exception as e:
            print(f"Erro: {e}")
            await self.connection_manager.send_message("Erro ao processar a consulta.", websocket)

    async def _generate_response(self, question):
        cached = self.cache.get_answer(question)
        if cached:
            return cached

        response = await asyncio.to_thread(self.agent.answer, question)
        translated = self.translator.translate(response)
        self.cache.save_answer(question, translated)
        return translated
