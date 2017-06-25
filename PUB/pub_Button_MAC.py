import  RPi.GPIO as GPIO
import time
import paho.mqtt.client as mqtt

GPIO.setmode(GPIO.BCM)
GPIO.setup(18, GPIO.IN,pull_up_down=GPIO.PUD_UP)

myMAC = open('/sys/class/net/eth0/address').read()
	
client = mqtt.Client()
client.connect("localhost")

try:
        while True:
                inputValue = GPIO.input(18)
                if (inputValue == False):
                        print("Button press")
                        print "RPi/MAC : ", myMAC
                        client.publish("Button","On")
                        client.publish("RPi/MAC", myMAC)
                #else :
                #        print("Button not pressed")
                #        print "RPi/MAC : ", myMAC
                #        client.publish("Button","Off")
                #        client.publish("RPi/MAC", myMAC)                
                
                time.sleep(1)

except KeyboardInterrupt:
    GPIO.cleanup()
    client.disconnect()       	

