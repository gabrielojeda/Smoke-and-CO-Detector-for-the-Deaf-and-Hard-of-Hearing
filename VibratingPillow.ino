#include <LiquidCrystal.h>

LiquidCrystal lcd(12, 11, 5, 4, 3, 2);

const int MIN_VOLT = 0;
const int MAX_VOLT = 5;
int MOTORPIN = 13; 
int STATE = 0;

void setup() {
  pinMode(MOTORPIN, OUTPUT);
  digitalWrite(MOTORPIN, LOW);
  
  Serial.begin(9600);
  lcd.begin(16, 2);
}

void loop() {
  int PERCENTAGE = 0;
  int SENS_READ = analogRead(A0);
  float AN_VOLT = SENS_READ * (5.0 / 1023.0);
  
  int TOT_VOLT = MAX_VOLT - MIN_VOLT;
  float VOLTAGE = AN_VOLT / TOT_VOLT; 
  PERCENTAGE = VOLTAGE * 100;
  
  if(Serial.available() > 0){
    STATE = Serial.read();
  }
  
  if (STATE == '0') {
    digitalWrite(MOTORPIN, LOW);

  }
  
  else if (STATE == '1') {
    digitalWrite(MOTORPIN, HIGH);   // turn the LED on (HIGH is the voltage level)
    delay(1000);               // wait for a second
    digitalWrite(MOTORPIN, LOW);    // turn the LED off by making the voltage LOW
    delay(100);               // wait for a second
  }

  lcd.setCursor(0, 0);
  lcd.print("BATTERY LEFT:");
  
  lcd.setCursor(0,1);
  lcd.print(PERCENTAGE);
  lcd.print("%");
  
  /*Serial.println(PERCENTAGE);
  delay(1000);*/
}
