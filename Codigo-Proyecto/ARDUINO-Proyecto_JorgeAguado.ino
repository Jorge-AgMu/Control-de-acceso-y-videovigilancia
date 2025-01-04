// LIBRERIAS INCLUIDAS
#include <WiFi.h>
#include <HTTPClient.h>
#include <Arduino_JSON.h>
// - - - - - - - - - -

// DEFINIR VARIABLES
#define PIR_01 33
#define PIR_02 14
#define PIR_03 13
#define PIR_04 12

String postData = "";
String payload = "";
// - - - - - - - - - -

// VARIABLES PARA LA CONEXIÓN
const char* ssid = "nombre del wifi";
const char* password = "password del wifi";
// - - - - - - - - - -

// ESTABLECER CONEXIÓN
void setup() {
  Serial.begin(115200);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
// - - - - - - - - - - - - - - 

// ESTABLECER LOS SENSORES COMO ENTRADA DE INFORMACIÓN
  pinMode(PIR_01,INPUT);
  pinMode(PIR_02,INPUT);
  pinMode(PIR_03,INPUT);
  pinMode(PIR_04,INPUT);
}
// - - - - - - - - - - - - - - 

void loop() {
  // - - - - - - - - - - - - - -
    if(WiFi.status()== WL_CONNECTED) {
      HTTPClient http;
      int httpCode;
  // - - - - - - - - - - - - - -  

  // MANDAR ID DE LA ESP
    postData = "id=esp32_01";
    payload = "";
  
    http.begin("http://192.168.1.100/Proyecto/prueba_2/sensores.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
   
    httpCode = http.POST(postData);
    payload = http.getString();
    
    http.end();
  // - - - - - - - - - - - - - 
  
  // ENVIO POST
    delay(750);

    String mov_01 ="";
    String mov_02 ="";
    String mov_03 ="";
    String mov_04 ="";

    if (digitalRead(PIR_01) > 0) mov_01 = "Movimiento detectado";
    if (digitalRead(PIR_01) == 0) mov_01 = "Sin movimiento";
   
    if (digitalRead(PIR_02) > 0) mov_02 = "Movimiento detectado";
    if (digitalRead(PIR_02) == 0) mov_02 = "Sin movimiento";

    if (digitalRead(PIR_03) > 0) mov_03 = "Movimiento detectado";
    if (digitalRead(PIR_03) == 0) mov_03 = "Sin movimiento";

    if (digitalRead(PIR_04) > 0) mov_04 = "Movimiento detectado";
    if (digitalRead(PIR_04) == 0) mov_04 = "Sin movimiento";
    
    postData = "id=esp32_01";
    postData += "&pir_01=" + mov_01;
    postData += "&pir_02=" + mov_02;
    postData += "&pir_03=" + mov_03;
    postData += "&pir_04=" + mov_04;
    payload = "";
  
    http.begin("http://192.168.1.100/Proyecto/prueba_2/actualizar.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
   
    httpCode = http.POST(postData);
    payload = http.getString();
    
    http.end();
    delay(750);
  }
}