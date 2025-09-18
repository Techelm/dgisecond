
from datetime import datetime
from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()

class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    password = db.Column(db.String(120), nullable=False)
    position = db.Column(db.String(200), default="member")
    email = db.Column(db.String(200), nullable=False)
    img_url = db.Column(db.String(200), default="/static/sample.jpg")
    year = db.Column(db.String(200), default="1")
    confirmed = db.Column(db.String(10), default="no")

class Message(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    title = db.Column(db.String(80), unique=True, nullable=False)
    body = db.Column(db.String(120), nullable=False)
    datecreated = db.Column(db.DateTime, default=datetime.utcnow)
    creator = db.Column(db.String(200), nullable=False)

class Events(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    title = db.Column(db.String(200), nullable=False)
    content = db.Column(db.Text, nullable=False)
    date = db.Column(db.String(200), nullable=False)

class Votes(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    voter = db.Column(db.String(200), nullable=False)
    candidate = db.Column(db.String(200), nullable=False)
    datevoted = db.Column(db.DateTime, default=datetime.utcnow)
