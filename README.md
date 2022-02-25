![License GPLv3](https://img.shields.io/github/license/bmartin5692/bumper.svg?color=brightgreen)

# NFCRaspi


This is a simple project of the operation of the NFC RFID RC522.

The RFID RC522 is a very low-cost RFID (Radio-frequency identification) reader and writer that is based on the MFRC522 microcontroller.


Wiring your RFID RC522 to your Raspberry Pi is fairly simple, with it requiring you to connect just 7 of the GPIO Pins directly to the RFID reader. Follow the table below, and check out our GPIO guide to see the positions of the GPIO pins that you need to connect your RC522 to.

[![RFID RC522](https://m.media-amazon.com/images/I/61rLVXkbaJL._SL1500_.jpg)]

| DATE | GPIO pins |
| ----- | ----------------- |
| SDA | connects to Pin 24 |
| SCK | connects to Pin 23 |
| MOSI | connects to Pin 19 |
| MISO | connects to Pin 21 |
| GND | connects to Pin 6 |
| RST | connects to Pin 22 |
| 3.3v | connects to Pin 1 |
 
![GPIO Raspberry](https://pimylifeup.com/wp-content/uploads/2017/10/RFID-Fritz-v2.png)

# Flow
![NFC Register Card](./flujo.png "NFC Register Card")