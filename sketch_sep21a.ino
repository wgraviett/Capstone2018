void setup() {
  // put your setup code here, to run once:
Serial.begin(9600);
analogReference(EXTERNAL);
  int sensorValue;
  int door;
  float temp;
  int zigbeestatus=0; //Returns 1 if both receivers are talking
  const int RemoteZigbeeStatusPin=41;
  const int DoorStatusPin = 2;
  const int ThermisterPin =A0;
}

void loop() {
  delay(5000);
doorCheck();
tempCheck();
}

void doorCheck(){
door = digitalRead(DoorStatusPin); // Read pin 2 for door connection.
  if (door ==HIGH){
    Serial.println("Door Open");
  }
  else {
    Serial.println("Door Closed");
  }
}

void tempCheck(){
  sensorValue = analogRead(ThermisterPin); //Read ADC Value
  temp =(sensorValue-67)/1023.0*5;
  temp = temp -0.5;
  temp = temp/0.01;
  Serial.println(temp);//should print 145 sensor valie with temp of 21c
}


 int Remote_Connection_Receiver(){
  // Using Digi Pin 8 connected to 5v. When zigbee on, 5v is being 
    //provided to pin 8, which is replicated to other zigbee and used at arduino.  
    //So If base zigbee shows zero then check power of other zigbee/comm channels. 
    
  
  if (digitalRead(RemoteZigbeeStatusPin) == HIGH)
     {
    
    zigbeestatus =1; 
    
     }
    else zigbeestatus=0;
  return zigbeestatus;
  } 
