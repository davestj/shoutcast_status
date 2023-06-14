# Shoutcast Server Status Checker

This script checks the status of a Shoutcast server and displays whether it is online or offline.

## Script Details

- Package: sc status
- Date: 8/20/2010
- Author: davestj@gmail.com
- Description: This script checks the status of a Shoutcast server and displays whether it is online or offline.
- Version: 1.0 final
- Abstract: Procedural script to get data from Shoutcast D.N.A.S
- Filename: sc_status.py

## Prerequisites

- Python 3.x
- Shoutcast server

## Installation

1. Clone the repository or download the script file: `sc_status.py`.
2. Install the required dependencies by running the following command:
   ```bash
   pip install socket
   ```
3. Update the `config.py` file with your Shoutcast server details and display preferences.

## Usage

1. Run the script using the following command:
   ```bash
   python sc_status.py
   ```
2. The script will check the status of the Shoutcast server and display the result based on the configured preferences.

## Configuration

Update the `config.py` file with the following settings:

- `sc_ip`: IP address of the Shoutcast server
- `sc_port`: Port number of the Shoutcast server
- `useimage`: Display status using image (`'yes'` or `'no'`)
- `usetext`: Display status using text (`'yes'` or `'no'`)
- `station_name`: Name of the Shoutcast station
- `offline_imgurl`: URL of the offline image
- `offline_text`: Text to display when the server is offline
- `online_imgurl`: URL of the online image
- `online_text`: Text to display when the server is online

## Limitations

- This script assumes that the Shoutcast server is accessible and running.
- It is recommended to configure the script execution time limit based on your requirements.

For more information, please refer to the [Shoutcast website](https://www.shoutcast.com/).

**Note:** This script is for demonstration purposes only and may require additional modifications to work with your specific setup.
