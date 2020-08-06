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
			border: 0;
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
			margin-top:-200px; /* negative half of the height */
			width: 100%;
		}
	</style>
	<script>
     function validateForm()
        {
        if (document.contact.name.value=="") 
          {
          alert("Please enter your name.");
          return false;
          }
          
        var x=document.forms["contact"]["email"].value;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
          {
          alert("Please enter a valid e-mail address.");
          return false;
          }
		  
		}
    </script>
</head>
<?php
	include("../connections/mffdb.php");
	
	mysql_select_db($database_mffdb, $mffdb);
	
		$query = 'SELECT count FROM obscurity';		
		$result = mysql_query($query, $mffdb) or die(mysql_error());
		
		$totalRows = mysql_num_rows($result);
		
		while($row = mysql_fetch_assoc($result)) {
			$total = $total + $row['count'];
		}
		
		$remain = 150 - $total;
							
	mysql_close($mffdb);
?>
<body>
	<div id="centre" align="center">
        <h1>Reserve Obscurity VIP Tickets</h1>
        <br>
        <p>To reserve VIP tickets to the showing of Obscurity on Friday 7th February 2014 at Priory Community School, please fill out this form.</p>
        <br>
        <form name="contact" onSubmit="return validateForm();" action="process.php">
            <p>Your Name/Organisation:</p>
            <p><input type="text" name="name"></p>
            <p>Your Email:</p>
            <p><input type="text" name="email"></p>
            <p>Number of tickets required:
            <select name="ticket">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="1">5</option>
                <option value="2">6</option>
                <option value="3">7</option>
                <option value="4">8</option>
                <option value="1">9</option>
                <option value="2">10</option>
            </select></p>
            <p><input type="submit" style="color: black;" value="Reserve"></p>
        </form>
        <br>
    </div>
</body>