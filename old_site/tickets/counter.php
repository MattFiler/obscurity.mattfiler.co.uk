<head>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="refresh" content="0; url=http://obscurity.mattfilerfilms.co.uk">
    <title>Obscurity Ticket Counter</title>
	<style>
		body {
			font-family: 'Lato', sans-serif;	
		}
		
	</style>
    <script type="text/javascript">
	function my_fun(j){
	var chkbox ="ckb" + j;
	var my_span ="my_span" + j;
	var msg = chkbox + " " + my_span;
	if(document.getElementById(chkbox).checked){ 
	document.getElementById(my_span).style.textDecoration='line-through';
	}else{
	document.getElementById(my_span).style.textDecoration='none';
	}
	}
	</script>
</head>
<body>
<?php
	include("connections/mffdb.php");
	
	mysql_select_db($database_mffdb, $mffdb);
	
		$query = 'SELECT * FROM obscurity';		
		$result = mysql_query($query, $mffdb) or die(mysql_error());
		
		$totalRows = mysql_num_rows($result);
		
		$spanno = 0;
		
?>

<div id="page">
   <div id="content_container">
       <div id="content" align="center">
       		<h1>Obscurity Ticket Reservations</h1>
            <p>Please note, if you refresh the page the items set to strikethrough will clear.</p>
            <br>
            <form>
           <?php
		   					while($totalRows-- > 0)
							{
								$row = mysql_fetch_assoc($result);
								$spanno = $spanno + 1;
								echo "<label for=ckb".$spanno."><input type=checkbox id=ckb".$spanno." value=".$spanno." onclick=my_fun(".$spanno."); style=display:none;><span id='my_span".$spanno."'><p><b>" . $row['name'] . "</b> - " . $row['count'] . " ticket(s) reserved.</p></span></label>";
							}
							mysql_close($mffdb);
		   ?>
           </form>
           	<br><br>
       </div>
   </div>
</div>

</body>