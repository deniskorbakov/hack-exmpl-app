from typing import Union
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
app = FastAPI()

origins = [
    "http://172.16.0.2",
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)


@app.get("/")
def read_root():
    return {"item_id": "ss"}

@app.get("/items/{item_id}")
def read_item(item_id: int, q: Union[str, None] = None):
    return {"item_id": item_id, "q": q}