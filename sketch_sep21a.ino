void setup() {
  // put your setup code here, to run once:
Serial.begin(9600);
}

void loop() {
  // put your main code here, to run repeatedly:
int sensorValue = analogRead(A0);
float temp = sensorValue*5/1024.0;
temp=temp -0.5;
temp = temp/0.01;
Serial.println(sensorValue);
}
