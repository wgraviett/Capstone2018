
char ItemID[15];
char ItemIDParsed[17];
char ItemIDPrevious[15];
int payload;
int stp;

String HOST = "192.168.137.1";
String PORT = "80";
String field = "field1";
String strItemID="";
int countTrueCommand;
int countTimeCommand; 
boolean found = false; 
int valSensor = 1;
int sendtowifi;
unsigned long time;
int ContinueRun;
void setup() {
  // put your setup code here, to run once:
Serial2.begin(9600);
Serial.begin(115200);
  //sendCommand("AT",5,"OK");
 // sendCommand("AT+CIPMUX=1",5,"OK");
stp=0;
}

void loop() {
  time = millis();
//--------------------------------------------------------ItemID
  // put your main code here, to run repeatedly:
if(Serial2.available()>0){
   payload=(Serial2.read()); //Read single character from string buffer
   stp=0; //Reset and wait for next keycode. 
}
if (payload==0x20 && stp !=1){ //Check for a space before keycode from remote unit. 
  Serial2.readBytesUntil("\r\n",ItemID,15); //Read keycode until newline character
  ItemID[11]='\0';

  ItemIDParsed[0]=ItemID[0];
  ItemIDParsed[1]=ItemID[1];
  ItemIDParsed[2]='%';
  ItemIDParsed[3]='2';
  ItemIDParsed[4]='0';
  ItemIDParsed[5]= ItemID[3];
  ItemIDParsed[6]=ItemID[4];
  ItemIDParsed[7]='%';
  ItemIDParsed[8]='2';
  ItemIDParsed[9]='0';
  ItemIDParsed[10]=ItemID[6];
  ItemIDParsed[11]=ItemID[7];
  ItemIDParsed[12]='%';
  ItemIDParsed[13]='2';
  ItemIDParsed[14]='0';
  ItemIDParsed[15]=ItemID[9];
  ItemIDParsed[16]=ItemID[10];
  ItemIDParsed[17]='\0';
  
 // Serial.print(ItemID); //print out keycode array. 
  sendtowifi=1;
  stp=1; //Allow for new codes to be read. 
}

//-----------------------------Wifi - Send Item
if (sendtowifi==1){
  //Indicates that a new item has arrived, so send it to database. 
strItemID =String(ItemIDParsed);
Serial.print("in");
String getData = "GET /ItemInsert.php?itemid="+strItemID+" HTTP/1.1\r\nHost: 192.168.137.1\r\nConnection: close\r\n";
 sendCommand("AT+CIPSTART=0,\"TCP\",\""+ HOST +"\","+ PORT,15,"OK");
 sendCommand("AT+CIPSEND=0," +String(getData.length()+2),4,">");
 Serial.println(getData);delay(1500);countTrueCommand++;
 sendCommand("AT+CIPCLOSE=0",5,"OK");
// delay(4000);
sendtowifi=0;
}
//------------------------------------------------------------------------Wifi - Send Temp
if (time%120000==0||ContinueRun==1){
  ContinueRun=1;
valSensor = getSensorData();
 String getData = "GET /ESPDemoCode.php?temp="+String(valSensor)+"&door=1 HTTP/1.1\r\nHost: 192.168.137.1\r\nConnection: close\r\n";

 sendCommand("AT+CIPSTART=0,\"TCP\",\""+ HOST +"\","+ PORT,15,"OK");
 sendCommand("AT+CIPSEND=0," +String(getData.length()+2),4,">");
 
 //sendCommand("AT+CIPSEND=0,92",4,">"); not used
 Serial.println(getData);delay(1500);countTrueCommand++;
 sendCommand("AT+CIPCLOSE=0",5,"OK");
 //delay(4000);
 ContinueRun=0;
}





 
} //Loop Close 


//--------------------------------------------------------------------------------
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
