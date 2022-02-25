# Librerias
import RPi.GPIO as GPIO
import time
import lcddriver

#inicializar

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(20, GPIO.OUT)     # Rele
GPIO.setup(16, GPIO.OUT)     # Rele
lcd = lcddriver.lcd()


# GPIO PARA LOS LED
def releApaOFF():

        GPIO.output(20,True)
        GPIO.output(16,True)
        lcd.lcd_clear()
        lcd.lcd_display_string("Reles Apagado",1)
        time.sleep(6)
        lcd.lcd_clear()


if __name__ == "__main__":
        releApaOFF()
