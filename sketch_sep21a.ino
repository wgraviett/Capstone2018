void setup() {
  // put your setup code here, to run once:
Serial.begin(9600);
analogReference(EXTERNAL);
  int sensorValue;
  int door;
  float temp;
}

void loop() {
  delay(5000);
doorCheck();
tempCheck();
}

void doorCheck(){
door = digitalRead(2); // Read pin 2 for door connection.
  if (door ==HIGH){
    Serial.println("Door Open");
  }
  else {
    Serial.println("Door Closed");
  }
}

void tempCheck(){
  sensorValue = analogRead(A0); //Read ADC Value
  temp =(sensorValue-67)/1023.0*5;
  temp = temp -0.5;
  temp = temp/0.01;
  Serial.println(temp);//should print 145 sensor valie with temp of 21c
}
