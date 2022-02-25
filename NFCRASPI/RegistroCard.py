#!/usr/bin/env python

# Proyecto          : iLock 
# Descripcion       : Raspberry Pi - Registro de la iCard
# Lenguaje          : Python
# autor:            : Fernando Durán Torres

# Librerias
import RPi.GPIO as GPIO
import mysql.connector

from mfrc522 import SimpleMFRC522
from releOFF import releApaOFF
import datetime
import time
import lcddriver


# GPIO PARA LOS LED
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(26, GPIO.OUT)        # led azul
GPIO.setup(13, GPIO.OUT)        # led rojo
GPIO.setup(19, GPIO.OUT)        # led Verde

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



def main():

    consulta(datoDB)
    
    
# Consulta Base datos , comprueba que la tarjeta no este dado de alta
def consulta(datoDB):

    lcd.lcd_clear()
    lcd.lcd_display_string("Ponga la tarjeta",1)
    lcd.lcd_display_string("sobre el lector",2)

    print("\n################################")
    print("Ponga la tarjeta sobre el lector")
    print("\n################################")
    
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
        print("\nTarjeta Vacia")
        lcd.lcd_clear()
        lcd.lcd_display_string("Tarjeta Vacia: ",1)
        ledVerde(17)
        escrituraCard(datoDB, idcard)
        GPIO.cleanup()
    else:
        print("\nTarjeta ya registrada")
        lcd.lcd_clear()
        lcd.lcd_display_string("    Tarjeta  ",1)
        lcd.lcd_display_string(" ya registrada",2)
        ledRojo(13)
        renuevo(idcard)

    conexion.close()

def renuevo(idcard):

    lcd.lcd_clear()
    lcd.lcd_display_string("   Registrar",1)
    lcd.lcd_display_string("  nuevamente?",2)
    op = input('¿Quieres volver a registrar esta tarjeta de nuevo?(s/n): ')

    if op == "s":
        borrarRegistro(datosDB, idcard)
        
        escrituraCard(datoDB, idcard)                

    else:
        print("adios!")
        lcd.lcd_clear()
        lcd.lcd_display_string("adios!",1)
        time.sleep(6)
        lcd.lcd_clear()
        GPIO.cleanup()



# Funcion escritura de la tarjeta
def escrituraCard(datoDB, idcard):
                
    try:
        lcd.lcd_clear()
        lcd.lcd_display_string("  Nombre para",1)
        lcd.lcd_display_string("     iCard   ",2)
        nombre = input('\nNombre para la iCard: ')
        
        print("Escritura Realizada")
        print("Los datos son: ")

        print("Codigo: ",idcard)
        print("Nombre: ",nombre)
        lcd.lcd_clear()
        lcd.lcd_display_string("Nombre:",1)
        lcd.lcd_display_string(nombre,2)
        time.sleep(4)

        a = nombre
        b = idcard
                        
        datosDB(a, b, datoDB, idcard)
            
    finally:
        GPIO.cleanup()

# Insertar datos en la base datos.
def datosDB(a, b, datoDB, idcard):

        # Fecha y hora para insertarlo en la base datos
        x = datetime.datetime.now()
         
        conexion = mysql.connector.connect(** datoDB)

        cursor = conexion.cursor()


        try:
                query = "INSERT INTO personal (nombre,  uid, fechaRegistro) VALUES (%s, %s, %s);"
                cursor.execute(query, (a, b, x))
                conexion.commit()
                print("Se insertaron de forma correcta")
                lcd.lcd_clear()
                lcd.lcd_display_string("Datos insertados",1)
                lcd.lcd_display_string("En la Base Datos",2)
                time.sleep(4)
                ledAzul(26)
                
                print("\n############################################################")
                print("Se recomienda ir a ilockpanel.tk para añadir una foto al perfil")
                print("############################################################\n")

                lcd.lcd_clear()
                lcd.lcd_display_string("Se recomienda ir",1)
                lcd.lcd_display_string(" ilockpanel.tk  ",2)
                time.sleep(5)

                lcd.lcd_clear()
                lcd.lcd_display_string(" ¿Activar Ahora?",1)
                lcd.lcd_display_string("      (s/n)     ",2)
                ac = input('Quieres activar la tarjeta ahora(s/n): ')
                
                if ac == "s":
                        activarCard(datoDB, idcard)
                else:
                        print("Puedes activarla mas tarde entrando en ilockpanel.tk")
                        lcd.lcd_clear()
                        lcd.lcd_display_string("  Para activar  ",1)
                        lcd.lcd_display_string(" ilockpanel.tk  ",2)
                        time.sleep(5)
                        GPIO.cleanup()
                
                
        except:
                print("Error, no se inserto ningun dato")
                ledRojo(13)           

        conexion.close()


#activa la card en la base datos y permitira el acceso
def activarCard(datoDB, idcard):

        conexion = mysql.connector.connect(** datoDB)
        
        cursor = conexion.cursor()
        
        icard = "UPDATE personal SET activo = %s WHERE uid = %s"

        val = ("1",(idcard))       
        
        
        try:
                cursor.execute(icard, val)
                conexion.commit()
                print("Tarjeta Activada, Esta Lista para usarse\n\n")
                lcd.lcd_clear()
                lcd.lcd_display_string("Tarjeta Activada",1)
                time.sleep(5)
                lcd.lcd_clear()
                GPIO.cleanup()
                
        except:
                print("No se ha podido activar la tarjeta")
        
        conexion.close()

def borrarRegistro(datosDB, idcard):
    
        conexion = mysql.connector.connect(** datoDB)
        
        cursor = conexion.cursor()
        
        icardelete = "DELETE FROM personal WHERE uid = %s"

        val = ((idcard),)       
        
        
        try:
                cursor.execute(icardelete, val)
                conexion.commit()
                print("\nDatos borrados, esta lista para ser registrada\n")
                lcd.lcd_clear()
                lcd.lcd_display_string("Datos Borrados",1)
                time.sleep(5)
                lcd.lcd_clear()                
                
        except:
                print("No se ha podido borrar la tarjeta")
        
        conexion.close()


# Led estado informacion(azul)
def ledAzul(pin):
        GPIO.output(26, True)
        time.sleep(2)
        GPIO.output(26, False)
        time.sleep(1)

def ledRojo(pin):
        GPIO.output(13, True)
        time.sleep(3)
        GPIO.output(13, False)
        time.sleep(3)

def ledVerde(pin):
        GPIO.output(19, True)
        time.sleep(4)
        GPIO.output(19, False)
        time.sleep(2)


if __name__ == "__main__":
        main()

