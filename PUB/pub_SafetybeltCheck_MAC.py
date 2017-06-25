import paho.mqtt.client as mqtt
import RPi.GPIO as GPIO
import time


touchPin = 26 # D0 connected to D26
touchInvPin = 27 # A0 connected to D27
metal = 0

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(17, GPIO.IN)
GPIO.setup(touchPin, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)

def on_connect(client, userdata, rc):
	print("SafetybeltCheck sensing ...")
        client.subscribe("Beltcheck")
        
def on_message(client, userdata, msg):
    print("Topic:" + msg.topic + " Message: On")
    
def on_publish(client, userdata, mid):
	print("message published")

def eventTouchSensor(e):
        if(e == 26) :
                global metal
                metal = 1

    
client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message
client.on_publish = on_publish
client.connect("localhost")

GPIO.add_event_detect(touchPin, GPIO.RISING, bouncetime = 200, callback = eventTouchSensor)
try:
        while True:
                global status
                if(metal == 1): # metaltouch sensing is on
                    if(GPIO.input(17) == 0) : # Breakbeam sensing is on
                            status = 3
                            client.publish("Beltcheck","On")
                    else:
                            status = 1
                            client.publish("Beltcheck","Off")
                elif(metal == 0):
                        if(GPIO.input(17) == 0) : # Breakbeam sensing is on
                           status = 2

                time.sleep(5)
            
except KeyboardInterrupt:
    GPIO.cleanup()
    client.unsubscribe(["Beltcheck"])
    client.disconnect()       	

