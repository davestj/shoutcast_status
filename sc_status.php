<?php
////////////////////////////////////////////////////////////////////////////////
// script name: sc status
// date: 10/01/2012
// author: davestj@gmail.com
// cause: checks status of a shoutcast server and display's online or offline status
// version: 1.1 b
// platform independent
// file name: sc_status.php
////////////////////////////////////////////////////////////////////////////////
//do not get cute and monkey with anything below, unless you know what u are doing.
include ('./config.php');

// override ini settings for script execution time, we dont need a minute to decide
// if a server is up or not, 10 seconds should be sufficient.
ini_set("max_execution_time", "10");

//check config settings
if($useimage == 'yes' && $usetext == 'yes'){
	echo 'You must choose text display or image display but not both<br>
		 please edit your config.php file<br>';
	exit();
}
//lets initiate a tcp socket connection to determine whether or not the server
//is actually up.
$scp = @fsockopen($sc_ip, $sc_port, $errno, $errstr, 30);
//let me know where or not its up
	if(!$scp){
	    $sock_init = 'FALSE';
	}

//show them whether or not the server is actually up or not
	if($sock_init == 'FALSE'){
		if($useimage == 'yes'){
		    echo ''.$station_name.' <img srv='.$offline_imgurl.'>';
		}else if ($usetext == 'yes'){
		    echo ''.$station_name.' - '.$offline_text.'';
		}
	}
//check 7.html to see if dsp is connected
	if($sock_init != 'FALSE'){
         fputs($scp,"GET /7.html HTTP/1.0\r\nUser-Agent: SC Status (Mozilla Compatible)\r\n\r\n");
 		while(!feof($scp)) {
  			$sc7 .= fgets($scp, 1024);
 			}
//close it up
@fclose($scp);
//while we got the page open into memory lets bomb n parse baby.
$sc7 = preg_replace('/^\<body\>/', "", $sc7);
$sc7 = preg_replace('/^\<\/body\>/', ",", $sc7);
$sc_contents = explode(",",$sc7);
$dummy = $sc_contents[0];
$dsp_connected = $sc_contents[1];


//check dsp connection and display the status of the shoutcast server in question
//do images first
 	if($sock_init != 'FALSE'){
 	    if($dsp_connected == '1' && $useimage == 'yes'){
  		echo ''.$station_name.' <img srv='.$online_imgurl.'>';
 	}else if ($dsp_connected != '1' && $useimage == 'yes'){
        echo ''.$station_name.' <img srv='.$offline_imgurl.'>offline image';
	 }
}
 //do text if set
if($sock_init != 'FALSE'){
	if ($dsp_connected == '1' && $usetext == 'yes'){
		echo ''.$station_name.' - '.$online_text.'';
 	}else if($dsp_connected != '1' && $usetext == 'yes'){
 	    echo ''.$station_name.' - '.$offline_text.'';
 	}
  }

}//end 7.html
	
	
	




//EOF
?>

