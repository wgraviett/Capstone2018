
char ItemID[15];
int payload;
int stp;
void setup() {
  // put your setup code here, to run once:
Serial.begin(9600);
stp=0;
}

void loop() {
  // put your main code here, to run repeatedly:
if(Serial.available()>0){
   payload=(Serial.read()); //Read single character from string buffer
   stp=0; //Reset and wait for next keycode. 
}
if (payload==0x20 && stp !=1){ //Check for a space before keycode from remote unit. 
  Serial.readBytesUntil("\r\n",ItemID,15); //Read keycode until newline character
  //Serial.print(ItemID); //print out keycode array. 
  stp=1; //Allow for new codes to be read. 
}

}
