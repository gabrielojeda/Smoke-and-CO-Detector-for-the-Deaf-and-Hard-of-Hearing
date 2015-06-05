int MOTORPIN = 13; 
int STATE = 0;

void setup() {
  pinMode(MOTORPIN, OUTPUT);
  digitalWrite(MOTORPIN, LOW);
  
  Serial.begin(9600);
}

void loop() {
  if(Serial.available() > 0){
    STATE = Serial.read();
  }
  
  if (STATE == '1') {
    digitalWrite(MOTORPIN, HIGH);   // turn Vibrating Motor on (HIGH is the voltage level)
    delay(1000);                    // wait for a second
    digitalWrite(MOTORPIN, LOW);    // turn Vibrating Motor off by making the voltage LOW
    delay(100);                     // wait for 100 millisecond

  }
  
  else {
    digitalWrite(MOTORPIN, LOW);
  }
}
