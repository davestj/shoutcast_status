"""
@package sc status
@date 8/20/2010
@author davestj@gmail.com
@description checks status of a shoutcast server and display's online or offline status
@version 1.0 final
@abstract Procedural script to get data from Shoutcast D.N.A.S
@filename sc_status.py
"""

import socket

# Config settings
from config import sc_ip, sc_port, useimage, usetext, station_name, offline_imgurl, offline_text, online_imgurl, online_text

# Override ini settings for script execution time, we don't need a minute to decide
# if a server is up or not, 10 seconds should be sufficient.
import sys
sys.setrecursionlimit(10)

# Check config settings
if useimage == 'yes' and usetext == 'yes':
    print('You must choose text display or image display but not both\n'
          'please edit your config.py file')
    exit()

# Let's initiate a TCP socket connection to determine whether or not the server
# is actually up.
scp = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
scp.settimeout(10)  # Set socket timeout to 10 seconds

# Let me know whether or not it's up
try:
    scp.connect((sc_ip, sc_port))
    sock_init = True
except (socket.timeout, ConnectionRefusedError):
    sock_init = False

# Show them whether or not the server is actually up or not
if not sock_init:
    if useimage == 'yes':
        print(f'{station_name} <img srv={offline_imgurl}>')
    elif usetext == 'yes':
        print(f'{station_name} - {offline_text}')
else:
    # Check 7.html to see if DSP is connected
    scp.send(b'GET /7.html HTTP/1.0\r\nUser-Agent: SC Status (Mozilla Compatible)\r\n\r\n')
    sc7 = scp.recv(1024).decode()
    scp.close()

    # While we got the page open into memory let's parse it.
    sc7 = sc7.replace('<body>', '').replace('</body>', ',')
    sc_contents = sc7.split(',')
    dummy = sc_contents[0]
    dsp_connected = sc_contents[1]

    # Check DSP connection and display the status of the Shoutcast server in question
    # Do images first
    if dsp_connected == '1' and useimage == 'yes':
        print(f'{station_name} <img srv={online_imgurl}>')
    elif dsp_connected != '1' and useimage == 'yes':
        print(f'{station_name} <img srv={offline_imgurl}> offline image')

    # Do text if set
    if dsp_connected == '1' and usetext == 'yes':
        print(f'{station_name} - {online_text}')
    elif dsp_connected != '1' and usetext == 'yes':
        print(f'{station_name} - {offline_text}')
