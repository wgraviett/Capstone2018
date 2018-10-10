#include <SoftwareSerial.h>


String HOST = "192.168.137.1";
String PORT = "80";
String field = "field1";

int countTrueCommand;
int countTimeCommand; 
boolean found = false; 
int valSensor = 1;

 
  
void setup() {
  Serial.begin(115200);
  sendCommand("AT",5,"OK");
  sendCommand("AT+CIPMUX=1",5,"OK");
  //sendCommand("AT+CWMODE=1",5,"OK");
 // sendCommand("AT+CWJAP=\""+ AP +"\",\""+ PASS +"\"",20,"OK");
}

void loop() {
 valSensor = getSensorData();
 String getData = "GET /ESPDemoCode.php?temp="+String(valSensor)+"&door=1 HTTP/1.1\r\nHost: 192.168.137.1\r\nConnection: close\r\n";

 sendCommand("AT+CIPSTART=0,\"TCP\",\""+ HOST +"\","+ PORT,15,"OK");
 sendCommand("AT+CIPSEND=0," +String(getData.length()+2),4,">");
 //sendCommand("AT+CIPSEND=0,92",4,">");
 Serial.println(getData);delay(1500);countTrueCommand++;
 sendCommand("AT+CIPCLOSE=0",5,"OK");
 delay(60000);
}

int getSensorData(){
  return random(1000); // Replace with 
}

void sendCommand(String command, int maxTime, char readReplay[]) {
  //Serial.print(countTrueCommand);
  //Serial.print(". at command => ");
  //Serial.print(command);
  //Serial.print(" ");
  while(countTimeCommand < (maxTime*1))
  {
    Serial.println(command);//at+cipsend
    if(Serial.find(readReplay))//ok
    {
      found = true;
      break;
    }
  
    countTimeCommand++;
  }
  
  if(found == true)
  {
    //Serial.println("OYI");
    countTrueCommand++;
    countTimeCommand = 0;
  }
  
  if(found == false)
  {
    Serial.println("Fail");
    countTrueCommand = 0;
    countTimeCommand = 0;
  }
  
  found = false;
 }
