<!--
Obscurity Ticket Reserver
Built by Matt Filer, Matt Filer Films
Developed in PHP, JS, HTML
-->
<head>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    <title>Obscurity VIP Ticket Reserver</title>
    <meta name="viewport" content="width=device-width, user-scalable=no">
	<style>
		body {
			font-family: 'Lato', sans-serif;	
			font-weight: normal;
			background: #3399FF;
			color: #fff;
		}
		input[type=text] {
			border-radius: 10px;
			background: #363636;
			color: #fff;
			border: 0;
			padding: 5px;
			width: 70%;
		}
		select {
			border-radius: 10px;
			background: #363636;
			color: #fff;
			border: 0;
		}
		input[type=submit] {
			color: #fff;
		}
		#centre {
			position:absolute; 
			top:50%; 
			height:200px; 
			margin-top:-120px; /* negative half of the height */
			width: 100%;
		}
		a {
			color: #fff;
		}
		a:hover {
			text-decoration: none;	
		}
	</style>
</head>
<body>
    <div id="centre" align="center">
		<?php
            include("../connections/mffdb.php");
            
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
              
                    $query = 'INSERT INTO obscurity (name,email,submitted,count,ip) VALUES ("VIP: '.$name.'","'.$email.'","'.$nowdate.'","'.$ticket.'","'.$ipaddress.'")';		
                    mysql_query($query, $mffdb) or die(mysql_error());
                    echo '
                    <h1>Reserve Obscurity Tickets</h1>
                    <p>Congratulations!</p>
                    <p>You now have Obscurity tickets reserved.</p>';
                }
                else
                {
                    echo '
                    <h1>Reserve Obscurity Tickets</h1>
                    <p>Sorry, but you seem to already be registered for Obscurity Tickets.</p>
                    <p>If this is a mistake, please <a href="mailto:matthew.filer@hotmail.co.uk">click here</a>.</p>';
                }
                                    
            mysql_close($mffdb);
        ?>
    </div>
</body>