import paho.mqtt.client as mqtt # MQTT Header
import time # Hearder for 'sleep()'

import MySQLdb

# Open database connection
db = MySQLdb.connect("127.0.0.1","JSY","1234","IoT_db" )

# prepare a cursor object using cursor() method
cursor = db.cursor()

# Callback funcition
# When this client receive CONNACK from Broker, Call 4 this funcition
# (Client Object, User Data, Connect Result)
def on_connect(client, userdata, rc):
        # Subscribe msg(with topic) from broker
        client.subscribe("GPS/lat")
        client.subscribe("GPS/lon")
        client.subscribe("RPi/MAC")
        client.subscribe("Temperature")
        client.subscribe("Button")
        client.subscribe("Beltcheck")

# Callback funcition
# When this client receive msg (with topic), Call this funcitions

lat = 0
lon = 0
mac = ""
temp = 0
button = ""
belt = ""

def on_message(client, userdata, msg):            
        global lat
        global lon        
        global mac
        global temp
        global button
        global belt
        
        print(msg.topic + " : " + str(msg.payload))
        
        if msg.topic == "GPS/lat" :
                lat = float(msg.payload)
                
        elif msg.topic == "GPS/lon" :
                lon = float(msg.payload)

        if msg.topic == "RPi/MAC" :
                mac = str(msg.payload)

        if msg.topic == "Temperature" :
                temp = int(msg.payload)

        if msg.topic == "Button" :
                button = str(msg.payload)

        if msg.topic == "Beltcheck" :
                belt = str(msg.payload)

        if lat !=0 and lon != 0 :
                # execute SQL query using execute() method.
                cursor.execute('insert into gps(mac,lat,lon) values("%s", "%lf", "%lf")' %\
                     (mac, lat, lon))
                lat = 0
                lon = 0

        if temp !=0 :
                # execute SQL query using execute() method.
                cursor.execute('insert into temp(mac,temp) values("%s", "%d")' %\
                     (mac, temp))

        if button !="" :
                # execute SQL query using execute() method.
                cursor.execute('insert into button(mac,button) values("%s", "%s")' %\
                     (mac, button))

        if belt !="" :
                # execute SQL query using execute() method.
                cursor.execute('insert into belt(mac,belt) values("%s", "%s")' %\
                     (mac, belt))
       
        button = ""
        belt = ""
        temp = 0


# Create client "SUB"
client = mqtt.Client("SUB")

client.on_connect = on_connect
client.on_message = on_message

# Connect this client to broker
# (Broker's Host Name or IP Addr, Port Num, Live Time)
#client.connect("192.168.0.3", 1883,60)
client.connect("192.168.0.20", 1883,60)

try :
        # Blocking function for Network loop
        # untill Call 'disconnect()'
        client.loop_forever()                

except KeyboardInterrupt: # if input 'Ctrl + C'
        print("SUB End")

        # End to subscribe(topic)
        client.unsubscribe(["GPS/lat"])
        client.unsubscribe(["GPS/lon"])
        client.unsubscribe(["RPi/MAC"])
        client.unsubscribe(["Temperature"])
        client.unsubscribe(["Button"])
        client.unsubscribe(["Beltcheck"])
        
        # Clean end to connect with broker
        client.disconnect()

        db.commit()

        # disconnect from server
        db.close()
