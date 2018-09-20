const int thermistorPin = 1;
void setup() {
  // put your setup code here, to run once:
pinMode(thermistorPin,INPUT);

}

void loop() {
  // put your main code here, to run repeatedly:
float ThermometerReading;
ThermometerReading= analogRead(ThermistorPin); // read ADC Value directly.
Reading = (1023/ThermometerReading)-1; 
ThermometerReading = ResistorValue / ThermometerReading;
Serial.println(ThermometerReading);
}
