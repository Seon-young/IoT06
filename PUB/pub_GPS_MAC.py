import paho.mqtt.client as mqtt # MQTT Header
import time # Hearder for 'sleep()'
import gps

session = gps.gps("localhost", "2947") # Listen port 2947(gpsd)
session = gps.gps(mode=1)

myMAC = open('/sys/class/net/eth0/address').read()

# Create client "DHT11_pub"
client = mqtt.Client("pub_GPS")

# Connect this client to broker
# (Broker's Host Name or IP Addr, Port Num, Live Time)
client.connect("localhost",1883,60)

# Start background thread
client.loop_start()


while True: # Infinite loop
    try :
            report = session.next()

            print "GPS/lat : ", report['lat']
            print "GPS/lon : ", report['lon']
            print "RPi/MAC : ", myMAC
            
            lat = report['lat']
            lon = report['lon']
                                
            # Publish msg to broker
            # (Topic, (string)Payload)
            client.publish("GPS/lat", lat)
            client.publish("GPS/lon", lon)
            client.publish("RPi/MAC", myMAC)

            time.sleep(10) # term                

    except KeyboardInterrupt: # if input 'Ctrl + C'
        print("pub_GPS End")

        # End background thread
        client.loop_stop()

        # Clean end to connect with broker
        client.disconnect()
        
        break

    except Exception as e:
        print 'Nothing'
        print e


    
