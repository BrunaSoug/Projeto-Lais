import uvicorn
from fastapi import FastAPI
from app.views.routes import router as websocket_router

app = FastAPI()
app.include_router(websocket_router)

if __name__ == "__main__":
    uvicorn.run("main:app", host="0.0.0.0", port=8000, log_level="info", use_colors=False)
