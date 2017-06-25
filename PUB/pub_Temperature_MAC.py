import RPi.GPIO as gpio
import dht11
import paho.mqtt.client as mqtt
import time

# initialize GPIO
temperature = 0

gpio.setmode(gpio.BCM)
gpio.setwarnings(False)
gpio.cleanup()

# read data using pin 5
instance = dht11.DHT11(pin = 5)

myMAC = open('/sys/class/net/eth0/address').read()

client = mqtt.Client()
client.connect("localhost")
  
try:
    while True:
        result = instance.read()
        if result.is_valid():
                print("Temperature: %d C" % result.temperature)
                print "RPi/MAC : ", myMAC
                client.publish("Temperature", result.temperature)
                client.publish("RPi/MAC", myMAC)
        else:
                print("Temperature Check Error")
        time.sleep(60)
        client.loop()
        
except KeyboardInterrupt:
    gpio.cleanup()
    client.disconnect()
