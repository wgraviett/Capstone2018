const int thermistorPin = 1; //analog Pin
const int ResistorValue=10000; //resistor in line with thermister. 
const int RemoteZigbeeStatusPin=41;
const int DoorStatusPin = 6;

void setup() {
  // put your setup code here, to run once:
pinMode(thermistorPin,INPUT);

}

void loop() {
  // put your main code here, to run repeatedly:

}

int Remote_Connection_Receiver(){
  // Using Digi Pin 8 connected to 5v. When zigbee on, 5v is being 
    //provided to pin 8, which is replicated to other zigbee and used at arduino.  
    //So If base zigbee shows zero then check power of other zigbee/comm channels. 
    
  int zigbeestatus=0; //Returns 1 if both receivers are talking
  if (digitalRead(RemoteZigbeeStatusPin) == HIGH)
     {
    
    zigbeestatus =1; 
    
     }
    else zigbeestatus=0;
  return zigbeestatus;
  }

float TempSensorStatus(){
    //Read temperature from thermister. 
    float ThermometerReading;
    ThermometerReading= analogRead(thermistorPin); // read ADC Value directly.
    float Reading = (1023/ThermometerReading)-1; 
    ThermometerReading = ResistorValue / Reading;
    Serial.println(ThermometerReading);
    return ThermometerReading;
}

int DoorStatusCollect(){
  //Reads door status of refridgeration. If high, Door is closed. 
  int Doorstatus =0; 
  Doorstatus = digitalRead(DoorStatusPin);
  return Doorstatus;
}



