/* C++ Libraries */
#include <string.h>
#include <stdlib.h>

/* ESP8266 WiFi Libraries */
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>

/* Other Required Libraries */
#include <ArduinoJson.h>
#include <FastLED.h>

// Number of LEDs in your LED strip
#define NUM_LEDS 151
// LED Control Pins
#define DATA_PIN 4
#define CLK_PIN 5
#define ANIMATION_SIZE 1024

// Your WiFi network name and password
#define WIFISSID "Ben"
#define WIFIPASSWORD "communism"

// RGB Variables
CRGB leds[NUM_LEDS];

CRGB ANIMATION[ANIMATION_SIZE];
int ANIMATION_LEN = 0;

uint16_t BASIS = 2;
uint16_t RATE = 2000;

// Wifi Variables
WiFiServer httpserver(80);

void setup() {
  // Open Serial for commands
  Serial.begin(115200);
  // Enable the indicator light
  pinMode(0, OUTPUT);

  WiFi.begin(WIFISSID, WIFIPASSWORD);
  while (WiFi.status() != WL_CONNECTED)
  {
     delay(500);
     Serial.print("*");
  }
  
  /* Print IP and MAC address */
  byte mac[6];
  WiFi.macAddress(mac);
  Serial.println();
  Serial.print("Hardware MAC: ");
  Serial.print(mac[5], HEX);
  Serial.print(":");
  Serial.print(mac[4], HEX);
  Serial.print(":");
  Serial.print(mac[3], HEX);
  Serial.print(":");
  Serial.print(mac[2], HEX);
  Serial.print(":");
  Serial.print(mac[1], HEX);
  Serial.print(":");
  Serial.println(mac[0], HEX);
  IPAddress ip = WiFi.localIP();
  Serial.print("IP Address: ");
  Serial.println(ip);
  
  httpserver.begin();

  // Pray to RNGesus
  randomSeed(analogRead(0));

  // Initialize the LED library
  FastLED.addLeds<APA102, DATA_PIN, CLK_PIN, BGR>(leds, NUM_LEDS);

  // Set brightness
  FastLED.setBrightness(8);

  ANIMATION[0].r = 255;
  ANIMATION[0].g = 0;
  ANIMATION[0].b = 0;

  ANIMATION[1].r = 0;
  ANIMATION[1].g = 255;
  ANIMATION[1].b = 0;

  ANIMATION[2].r = 0;
  ANIMATION[2].g = 0;
  ANIMATION[2].b = 255;

  ANIMATION[3].r = 255;
  ANIMATION[3].g = 0;
  ANIMATION[3].b = 255;

  ANIMATION[4].r = 0;
  ANIMATION[4].g = 255;
  ANIMATION[4].b = 255;

  ANIMATION[5].r = 255;
  ANIMATION[5].g = 255;
  ANIMATION[5].b = 0;

  ANIMATION_LEN = 6;
}

/*
****************************************************
****************** LOOP FUNCTION *******************
****************************************************
*/

void loop() {
  // Check for incoming HTTP requests
  WiFiClient client = httpserver.available();

  if (client) {
    delay(300);
    if (client.available() > 0) {
      Serial.println("Got a request");
      int data_so_far = client.available();
      do {
        delay(100);
        data_so_far = client.available();
        Serial.println("*");
      } while (client.available() > data_so_far);
      handleHTTPRequest(client);
      delay(10);
      client.stop();
    } else {
      Serial.println("Empty client...");
      client.stop();
    }
  }

  // Update the LED animations
  updateLeds();
}


static int ANIM_INDEX = 0;
static int LAST_UPDATE = millis();

void updateLeds() {
  unsigned long now = millis();
  if (now - LAST_UPDATE < RATE) {
    return;
  }

  for (int i = 0; i < NUM_LEDS; i++) {
    leds[i].r = ANIMATION[ANIM_INDEX + (i % BASIS)].r;
    leds[i].g = ANIMATION[ANIM_INDEX + (i % BASIS)].g;
    leds[i].b = ANIMATION[ANIM_INDEX + (i % BASIS)].b;
  }

  /* update the display and set our LAST_UPDATE time */
  FastLED.show();
  LAST_UPDATE = millis();

  ANIM_INDEX += BASIS;
  if (ANIM_INDEX >= ANIMATION_LEN) {
    ANIM_INDEX = 0;
  }
}


void handleHTTPRequest(WiFiClient client) {
  String body = client.readString();
  Serial.println(body);
  
  if (body.indexOf("PUT /api/animate") >= 0) {
    int throwaway = body.indexOf("\r\n\r\n");
    body.remove(0, throwaway + 4);

    uint16_t dab = body[0];
    dab = dab << 8;
    dab = dab | body[1];

    Serial.print("dab:");
    Serial.println(dab);
    
    if (dab != 0xADAB) {
      sendBadRequestResponse(client, "That's an error, bro");
      return;
    }
    
    BASIS = body[2];
    BASIS <<= 8;
    BASIS |= body[3];

    Serial.print("basis:");
    Serial.println(BASIS);
    
    
    RATE = body[4];
    RATE <<= 8;
    RATE |= body[5];

    Serial.print("rate:");
    Serial.println(RATE);

    body.remove(0, 6);

    ANIMATION_LEN = body.length() / 3;
    ANIM_INDEX = 0;
    Serial.print("body:");
    Serial.println(body);

    for (int i = 0; i < body.length(); i++) {
      int j = i/3;
      if (i % 3 == 0) {
        ANIMATION[j].r = (uint8_t)body[i];
      }
      if (i % 3 == 1) {
        ANIMATION[j].g = (uint8_t)body[i];
      }
      if (i % 3 == 2) {
        ANIMATION[j].b = (uint8_t)body[i];
      }
    }

    Serial.print(ANIMATION[0].r);
    Serial.print(ANIMATION[0].g);
    Serial.print(ANIMATION[0].b); 

    Serial.print(ANIMATION[1].r);
    Serial.print(ANIMATION[1].g);
    Serial.print(ANIMATION[1].b);

    Serial.print(ANIMATION[2].r);
    Serial.print(ANIMATION[2].g);
    Serial.print(ANIMATION[2].b);
          
    sendOKResponse(client);
  } else {
    sendBadRequestResponse(client, "Failed, sorry");
  }
  return;
}

/*
****************************************************
*************** JSON HTTP RESPONSES ****************
****************************************************
*/

void sendBadRequestResponse(WiFiClient client, char* errmsg) {
  String response = "HTTP/1.1 400 Bad Request\r\nContent-Type: text/html\r\n\r\n";
  response += errmsg;
  client.print(response);
  delay(1);
}

void sendBadRequestResponse(WiFiClient client, String errmsg) {
  String response = "HTTP/1.1 400 Bad Request\r\nContent-Type: text/html\r\n\r\n";
  response += errmsg;
  client.print(response);
  delay(1);
}

void sendJSONDataResponse(WiFiClient client, char *jsonobj) {
  String response = "HTTP/1.1 200 OK\r\nContent-Type: application/json\r\n\r\n";
  response += jsonobj;
  client.print(response);
  delay(1);
}

void sendJSONDataResponse(WiFiClient client, String jsonobj) {
  String response = "HTTP/1.1 200 OK\r\nContent-Type: application/json\r\n\r\n";
  response += jsonobj;
  client.print(response);
  delay(1);
}

void sendOKResponse(WiFiClient client) {
  String response = "HTTP/1.1 200 OK\r\n\r\n";
  client.print(response);
  delay(1);
}
