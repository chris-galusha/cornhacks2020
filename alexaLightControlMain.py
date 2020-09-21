from flask import Flask
from flask_ask import Ask, statement, question, convert_errors
from colorschemes import colorschemes
from driver import apa102
import time
import requests
#import RPi.GPIO as GPIO
import logging



app = Flask(__name__)
ask = Ask(app, '/')

url = 'http://192.168.43.101:8002/api/animations/play'

logging.getLogger("flask_ask").setLevel(logging.DEBUG)

def addHeaders(token):
    return {'Accept': 'application/json', "Authorization" : "Bearer " + token}

def checkToken():
    file = open("userToken.txt", "r")
    token = file.readline()
    file.close
    if(len(token) != 80):
        print("token not set! \nto recieve your authentication token \nplease login in using \"lightsLogin.py [username] [password]\"")
        exit(0)
    else:
        return token

@app.route('/')
def homepage():
    return "hi there, how ya doin?"

@ask.launch
def start_skill():
    welcome_message = "Welcome to corn hacks"
    return question(welcome_message)

@ask.intent('ioIntent', mapping={'ioStatus': 'ioStatus', 'light': 'light'})
def io_control(ioStatus, light):
    checkToken()

    if (ioStatus == "on"):
        on = {"color": "0xFFFFFF", "light": light}
        resp = requests.post(url, json=on, headers=addHeaders(checkToken()))

    elif (ioStatus == "off"):
        off = {"color": "0x000000", "light": light}
        resp = requests.post(url, json=off, headers=addHeaders(checkToken()))
    else:
        return statement('That command is unrecongizable')

    return statement('{}'.format(ioStatus))

@ask.intent('colorIntent', mapping={'color': 'color', 'light': 'light'})
def color_control(color, light):

    checkToken()
    #light = {"light": light}
    colorDictionary = {"red" : {"color": "0xFF0000", "light": light},
    "blue" : {"color": "0x0000FF", "light": light},
    "green" : {"color": "0x00FF00", "light": light},
    "orange" : {"color": "0xFFA500", "light": light},
    "yellow" : {"color": "0xFFFF00", "light": light},
    "white" : {"color": "0xFFFFFF", "light": light}}
    resp = requests.post(url, json=colorDictionary[color], headers=addHeaders(checkToken()))
    return  statement('turning lights {}'.format(color))

@ask.intent('patternIntent', mapping={'pattern': 'pattern', 'light': 'light'})
def pattern_control(pattern, light):

    checkToken()
    jsonPattern = {"pattern" : pattern, "light": light}
    resp = requests.post(url, json=jsonPattern, headers=addHeaders(checkToken()))

    return statement('perfroming {} animation' .format(pattern))

if __name__ == '__main__':
    app.run(debug=True)
