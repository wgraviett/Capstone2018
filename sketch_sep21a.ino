void setup() {
  // put your setup code here, to run once:
Serial.begin(9600);
analogReference(EXTERNAL);
}

void loop() {
  delay(5000);
  // put your main code here, to run repeatedly:
int sensorValue = analogRead(A0);
int door = digitalRead(2);
if (door == HIGH) {
  Serial.println("Door Open");
}
float temp = (sensorValue-67)/1023.0 *5;
temp=temp -0.5;
temp = temp/0.01;
Serial.println(temp); //should print 145 sensor valie with temp of 21c
}
