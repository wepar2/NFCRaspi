#!/usr/bin/env python

# Proyecto          : iLock 
# Descripcion       : Raspberry Pi - Acceso con la iCard
# Lenguaje          : Python
# autor:            : Fernando Durán Torres

# Librerias
import RPi.GPIO as GPIO
import mysql.connector

from mfrc522 import SimpleMFRC522
from releOFF import releApaOFF
import datetime
import time
import signal
import lcddriver

# GPIO PARA LOS LED
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(26, GPIO.OUT)        # led azul
GPIO.setup(13, GPIO.OUT)        # led rojo
GPIO.setup(19, GPIO.OUT)        # led Verde
GPIO.setup(20, GPIO.OUT)        # Rele

# Variable para la LCD
lcd = lcddriver.lcd()

# Variable para la conexion con la libreria MFRC522
reader = SimpleMFRC522()

# Carga de la BaseDatos
datoDB = {
    'user':'xxxxxxxxxxxx',
    'password':'xxxxxxxxxxxx',
    'database':'xxxxxxxxxxxx',
    'host':'xxxxxxxxxxxx'
}



# Variable global para controlar el ciclo principal
bucle = True


def main():

        releApaOFF()

        # Enlaza SIGINT (teclas Ctrl+C) con la funcion end_read()
        signal.signal(signal.SIGINT, finalizar)

        while bucle:
                print("\n")
                consulta(datoDB)

           

# Consulta Base datos , comprueba que la tarjeta no este dado de alta
def consulta(datoDB):
    lcd.lcd_clear()
    lcd.lcd_display_string("Ponga la tarjeta",1)
    lcd.lcd_display_string("sobre el lector",2)
        
    print("\n################################")
    print("Ponga la tarjeta sobre el lector")
    print("################################\n")
 
    idcard = reader.read_id()
    
    print("El codigo leido es: ",idcard)

    co = str(idcard)
    lcd.lcd_clear()
    lcd.lcd_display_string("Codigo: ",1)
    lcd.lcd_display_string(co,2)
    time.sleep(5)

    conexion = mysql.connector.connect(** datoDB)

    cursor = conexion.cursor()

    sql = "SELECT * FROM personal WHERE uid='" + str(idcard) + "'"


    # Ejecuta el sql
    cursor.execute(sql)

    # Filas obtenidas como respuesta a la consulta
    filas = cursor.fetchall()

    if filas == []:
        print("Acceso denegado")
        lcd.lcd_clear()
        lcd.lcd_display_string("Acceso denegado",1)
        time.sleep(5)
        lcd.lcd_clear()
        lcd.lcd_backlight("off")
        ledRojo(13)

    else:

        conexion = mysql.connector.connect(** datoDB)

        cursor = conexion.cursor()

        activosql = "SELECT activo FROM personal WHERE uid='" + str(idcard) + "'"
        
        cursor.execute(activosql)

        filasActivo = cursor.fetchall()

        for x in filasActivo:

                if x == (1,):

                    print("Acceso Permitido")
                    
                    lcd.lcd_clear()
                    lcd.lcd_display_string("Acceso Permitido",1)
                    time.sleep(5)
                    
                    ledVerde(19)
                    rele(20)
                    a = nombre(datoDB, idcard)
                    registroDB(a,idcard, datoDB)
                
                else:
                     
                    print("Tarjeta no activada, Acceso denegado")
                    
                    lcd.lcd_clear()
                    lcd.lcd_display_string("Acceso denegado",1)
                    lcd.lcd_display_string("Card no activada",2)
                    time.sleep(5)
                    
                    ledRojo(13)     

       
    conexion.close()
    
def nombre(datoDB, idcard):

        conexion = mysql.connector.connect(** datoDB)

        cursor = conexion.cursor()

        try:
                activosql = "SELECT nombre FROM personal WHERE uid='" + str(idcard) + "'"
                
                cursor.execute(activosql)

                filasActivo = cursor.fetchall()

                for row in filasActivo:
                        return row[0]
                   
        except:
            print("Error al cargar el nombre")
            
        conexion.close() 

# Insertar datos en la base datos.
def registroDB(a, b, datoDB):

    # Fecha y hora para insertarlo en la base datos
    x = datetime.datetime.now()

    conexion = mysql.connector.connect(** datoDB)

    cursor = conexion.cursor()

    try:
            query = "INSERT INTO acceso (nombre,  uid, fechaEntrada) VALUES (%s, %s, %s);"
            cursor.execute(query, (a, b, x))
            conexion.commit()
            print("Registro Guardado")
            ledAzul(26)
            
    except:
            print("Error, no se inserto ningun dato")
            ledRojo(13)           

    conexion.close()
       
        
# Led estado informacion(azul)
def ledAzul(pin):
        GPIO.output(26, True)
        time.sleep(2)
        GPIO.output(26, False)
        time.sleep(1)

def ledRojo(pin):
    GPIO.output(13, True)
    time.sleep(4)
    GPIO.output(13, False)
    time.sleep(2)

def ledVerde(pin):
    GPIO.output(19, True)
    time.sleep(4)
    GPIO.output(19, False)
    time.sleep(2)


def rele(pin):
    # Activa relay
    GPIO.output(20,False)
    print ("Relay activado.")
    time.sleep(3)

    # Desactiva relay
    GPIO.output(20,True)
    print ("Relay desactivado.")

   
# Captura Ctrl+C y termina el ciclo infinito para terminar el programa
def finalizar(signal,frame):
    global bucle

    print ("Ctrl+C presionado, programa finalizado.")
    bucle = False
    GPIO.cleanup()
    exit()


if __name__ == "__main__":
        main()

