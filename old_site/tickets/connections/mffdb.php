<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_mffdb = "localhost";
$database_mffdb = "MattFilerFilms";
$username_mffdb = "root";
$password_mffdb = "west0ncamman";
$mffdb = mysql_pconnect($hostname_mffdb, $username_mffdb, $password_mffdb) or die(mysql_error());
?>