<!--
Obscurity Ticket Reserver
Built by Matt Filer, Matt Filer Films
Developed in PHP, JS, HTML
-->
<head>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    <title>Obscurity Ticket Reserver</title>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="refresh" content="0; url=http://obscurity.mattfilerfilms.co.uk">
	<style>
		body {
			font-family: 'Lato', sans-serif;	
			font-weight: normal;
		}
	</style>
</head>
<body>
   <div align="center">
		<?php
            include("connections/mffdb.php");
            
            mysql_select_db($database_mffdb, $mffdb);
                
                $ipaddress = $_SERVER["REMOTE_ADDR"];
                
                $checker = "SELECT ip from obscurity WHERE ip='".$ipaddress."'";
        
                $result = mysql_query($checker, $mffdb) or die(mysql_error());
                $totalRows = mysql_num_rows($result);
                $count = $totalRows;
                
                if ($count == 0) {
                    date_default_timezone_set('Europe/London');
                    $nowdate =  date("d/m/y",time());
                    
                    $name = $_GET['name'];
                    $email = $_GET['email'];
                    $ticket = $_GET['ticket'];
              
                    $query = 'INSERT INTO obscurity (name,email,submitted,count,ip) VALUES ("'.$name.'","'.$email.'","'.$nowdate.'","'.$ticket.'","'.$ipaddress.'")';		
                    mysql_query($query, $mffdb) or die(mysql_error());
                    echo '
                    <h1>Reserve Obscurity Tickets</h1>
                    <p>Congratulations!</p>
                    <p>You now have Obscurity tickets reserved.</p>
					<p>If you need to cancel your ticket, please use <a href="mailto:matthew.filer@hotmail.co.uk">this email</a>.</p>';
                }
                else
                {
                    echo '
                    <h1>Reserve Obscurity Tickets</h1>
                    <p>Sorry, but you seem to already be registered.</p>
                    <p>If this is a mistake, please <a href="mailto:matthew.filer@hotmail.co.uk">click here</a>.</p>
					<p>If you are visiting this site on a public network (a school, company, etc...) you may see this message. In which case, try again when you are at home.</p>';
                }
                                    
            mysql_close($mffdb);
        ?>
        <br>
        <p>Don't forget where Obscurity is showing!</p>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&v=3.exp"></script>
		<script src="js/jquery.min.js"></script>
        <script src="js/jquery.gmap.min.js"></script>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("#responsive_map").gMap({
                 maptype: google.maps.MapTypeId.SATELLITE, 
                 zoom: 16, 
                 markers: [{
                     latitude: 51.3634333, 
                     longitude: -2.9091333, 
                     html: "Obsurity Showing Location", 
                     popup: true, 
                     flat: true, 
                     icon: { 
                         image: "icons/cinema.png", 
                         iconsize: [32, 37], 
                         iconanchor: [15, 30], 
                         shadow: "icons/icon-shadow.png", 
                         shadowsize: [32, 37], 
                         shadowanchor: null}
                        } 
                    ], 
                 panControl: false, 
                 zoomControl: false, 
                 mapTypeControl: false, 
                 scaleControl: false, 
                 streetViewControl: false, 
                 scrollwheel: false, 
                 styles: [ { "stylers": [ { "hue": "#01080f" }, { "gamma": 1.58 } ] } ], 
                 onComplete: function() {
                     // Resize and re-center the map on window resize event
                     var gmap = $("#responsive_map").data('gmap').gmap;
                     window.onresize = function(){
                         google.maps.event.trigger(gmap, 'resize');
                         $("#responsive_map").gMap('fixAfterResize');
                     };
                }
            });
        });
        </script>
        <div id="responsive_map"></div>
        <style type="text/css">
        #responsive_map {height: 360px; width: 70%;}
        #responsive_map div {-webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px;}
        .gm-style-iw {max-width: none !important; min-width: none !important; max-height: none !important; min-height: none !important; overflow-y: hidden !important; overflow-x: hidden !important; line-height: normal !important; padding: 5px !important; }
        </style>
   </div>
</body>