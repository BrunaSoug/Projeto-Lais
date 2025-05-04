from fastapi import WebSocket
import json

class ConnectionManager:
    """Gerencia conexões WebSocket."""

    def __init__(self):
        self.connections = {}

    async def connect(self, websocket):
        await websocket.accept()
        client_ip = websocket.client.host
        self.connections[websocket] = True
        print(f"Cliente conectado: {client_ip}")

    def disconnect(self, websocket):
        if websocket in self.connections:
            del self.connections[websocket]

    async def send_message(self, message, websocket):
        await websocket.send_text(json.dumps({"response": message}))
