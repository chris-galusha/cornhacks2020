import requests
import argparse



def addHeaders(token):
    return {'Accept': 'application/json', "Authorization" : "Bearer " + token}

def io_control(ioStatus, name):

    ioDicitonary = {"off" : {"colorCode": "0x000000", "light": name},
    "on" : {"colorCode": "0xFFFFFF", "light" : name}}
    resp = requests.post(url, json=ioDictionary[ioStatus], headers=addHeaders(checkToken()))
    print('turned LEDs {}'.format(resp.json()))

def color_control(color, light):


    colorDictionary = {"red" : {"color": "0xFF0000", "light": light},
    "blue" : {"color": "0x0000FF", "light": light},
    "green" : {"color": "0x00FF00", "light": light},
    "orange" : {"color": "0xFFA500", "light": light},
    "yellow" : {"color": "0xFFFF00", "light": light},
    "white" : {"color": "0xFFFFFF", "light": light}}
    resp = requests.post(url, json=colorDictionary[color], headers=addHeaders(checkToken()))
    print('turned LEDs {}'.format(resp.json()))

def pattern_control(pattern, light):

    jsonPattern = {"animation": pattern, "light": light}
    resp = requests.post(url, json=jsonPattern, headers=addHeaders(checkToken()))
    print('{}'.format(pattern))


def checkToken():
    file = open("userToken.txt", "r")
    token = file.readline()
    file.close
    if(len(token) != 80):
        print("token not set! \nto recieve your authentication token \nplease login in using \"lightsLogin.py [username] [password]\"")
        exit(0)
    else:
        return token


url = 'http://192.168.0.100:8002/api/animations/play'

parser = argparse.ArgumentParser(description='token needed to authenticate')
parser.add_argument('--io', action="store", metavar='io', nargs='?',
                    help='turn lights [on] or [off] ')
parser.add_argument('--c', action="store", metavar='C', nargs='?',
                    help='change colors of lights')
parser.add_argument('--p', action="store", metavar='P', nargs='?',
                    help='change pattern of lights')
parser.add_argument('--l', action="store", metavar='L', nargs='?', required=True, help='name of light')

args = parser.parse_args()

checkToken()
if(args.io != None):
    io_control(args.io, args.l)
elif(args.c != None):
    color_control(args.c, args.l)
elif(args.p != None):
    pattern_control(args.p, args.l)
else:
    print("please use \"consoleLightControlMain.py -h\" for help")
    exit(0)
