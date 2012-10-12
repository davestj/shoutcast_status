<?php
////////////////////////////////////////////////////////////////////////////////
// script name: sc status
// date: 8/20/2010
// author: davestj@gmail.com
// cause: checks status of a shoutcast server and display's online or offline status
// version: 1.0 final
// platform independant
// filename: config.php
////////////////////////////////////////////////////////////////////////////////

//configuration, please edit options below to fit your webcasting setup.
$sc_ip              = '127.0.0.1'; //static ip address of server, do not use dns names (static ip is faster)
$sc_port            = '8000'; //port number of shoutcast server

//station info
$station_name       = 'My Radio'; //name of your station

//display options
//image settings
$useimage           = 'no'; //set to yes if using image and make sure $usetext below is set to no
$online_imgurl      = 'http://yourdomain.com/images/online.gif'; //full url to your online image
$offline_imgurl     = 'http://yourdomain.com/images/offline.gif'; //full url to your offline image

//text settings
$usetext            = 'yes'; //set to yes if using text and make sure $useimage above is set to no
$online_text        = 'online'; //enter whatever you want to display for online message
$offline_text       = 'offline'; //enter whatever you want to display offline message

//EOF

?>

