import requests
import argparse

def verifyToken(token):
    if(len(token) != 80):
        file = open("userToken.txt", "w")
        file.write("")
        file.close
        print("username or password incorrect")
        exit(0)

def setToken(token):
    verifyToken(token)
    f = open("userToken.txt", "w")
    f.write(token)
    f.close



parser = argparse.ArgumentParser(description='username and password for cornhacks lights')
parser.add_argument('email', metavar='email', nargs='?',
                    help='username to login')
parser.add_argument('password', metavar='pass', nargs='?', help='password to login')
parser.add_argument('name', metavar='name', nargs='?', help='name of device')
args = parser.parse_args()

account = {"email": args.email, "password": args.password, "name": args.name}
resp = requests.post('http://192.168.43.101:8002/api/tokens/request', json=account)
if(resp.status_code != 200):
    setToken("5")
#adds token to userToken.txt
setToken(resp.json()["token"])

print(resp.json()["token"] + "is your api token and has been added to userToken.txt")
