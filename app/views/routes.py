from fastapi import APIRouter, WebSocket
from app.config import DB_PATH, MODEL_NAME, API_KEY
from app.controllers.chat_handler import ChatHandler

router = APIRouter()

@router.websocket("/chat")
async def websocket_chat(websocket: WebSocket):
    handler = ChatHandler(DB_PATH, MODEL_NAME, API_KEY)
    await handler.handle(websocket)
