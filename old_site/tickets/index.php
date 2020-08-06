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
	include("connections/mffdb.php");
	
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
   <div align="center">
        <h1>Reserve Obscurity Tickets</h1>
        <?php
            if ($total > 150) {
                echo '
                    <p>Sorry, but your too late!</p>
                    <p>Only 150 tickets were able to be reserved for Obscurity, and that limit has been reached.</p>
                    <p>This means you cannot come to see the film at the showing.</p>
                    <p>However, if you still wish to view the feature, the film will be released on the 9eight Films YouTube channel on February 10th 2014.</p>';
            }
            else
            {
                echo '
                    <p>Obscurity will be showing at <a href="http://bit.ly/MEA6zS">Priory Community School</a> on Friday 7th February 2014 from 5PM onwards.</p>
                    <p>A maximum of 150 people will be aloud at the showing, and <u>all of these guests will have to have seats reserved</u>.</p>
                    <p>To reserve your seat for Obscurity, please fill out the form below. This will confirm your place.</p>
                    <p><b>Please note, the charge for entering the Obscurity Showing is two pounds, in which all profits will be going to charity. You will be charged this on the night at the door.</p>
                    <p>Please also note that there may be a high media presence on the day, so by completing this form you are also agreeing to possibly be used in publicity photographs.</b></p>
					<br>
					<p>Currently only ' . $remain . ' tickets left.</p>
                    <br>
                    <form name="contact" onSubmit="return validateForm();" action="process.php">
                        <p>Your Name:
                        <input type="text" name="name"></p>
                        <p>Your Email:
                        <input type="text" name="email"></p>
						<p>Number of tickets required:
                        <select name="ticket">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select></p>
                        <p><input type="submit" style="color: black;" value="Reserve"></p>
                    </form>
					<br>';
            }
        ?>
   </div>
</body>