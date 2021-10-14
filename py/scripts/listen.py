import sys
import os
import mariadb
import paho.mqtt.client as mqtt
import time

conn = mariadb.connect(
    user=os.environ.get('DB_USER'),
    password=os.environ.get('DB_PASSWORD'),
    host=os.environ.get('DB_HOST'),
    port=int(os.environ.get('DB_PORT')),
    database=os.environ.get('DB_NAME'),
)
conn.autocommit = True
cursor = conn.cursor()


# MQTT Settings
MQTT_Broker = os.environ.get('MQTT_Broker')
MQTT_Port = os.environ.get('MQTT_Port')
MQTT_Topic = os.environ.get('MQTT_Topic')
Keep_Alive_Interval = os.environ.get('MQTT_Keep')

#Subscribe to all Sensors at Base Topic
def on_connect(mosq, obj, rc, t):
        mqttc.subscribe(MQTT_Topic, 0)
        print('on_connect')

#Save Data into DB Table
def on_message(mosq, obj, msg):
        Message = msg.payload
        Topic = msg.topic.replace('/', '__')
        cursor.execute("CREATE TABLE IF NOT EXISTS test_" + Topic + " (ID INT NOT NULL AUTO_INCREMENT, MESSAGE TEXT, DATE_INSERT TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (ID))")
        cursor.execute("INSERT INTO test_" + Topic + "  (MESSAGE) VALUES (?)", [Message])

def on_subscribe(mosq, obj, mid, granted_qos):
    print('on_subscribe')

mqttc = mqtt.Client()

# Assign event callbacks
mqttc.on_message = on_message
mqttc.on_connect = on_connect
mqttc.on_subscribe = on_subscribe

# Connect
mqttc.username_pw_set('user', 'qwer1234')
mqttc.connect(MQTT_Broker, int(MQTT_Port), int(Keep_Alive_Interval))

# Continue the network loop
mqttc.loop_forever()
print('on_end')
