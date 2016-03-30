<?php

// DATABASE SETTING

require_once('library/adodb_lite/adodb.inc.php');

$host		=	'localhost';

$username	=	'hassanho_lms';

$password	=	'hassanfblms';

$dbname		=	'hassanho_lmsdb';

$debug_db   =   '0';

$db_engine	=	'mysql';

//error
$db_error = '<br><br><br><table align="center">
					<tr bgcolor="#FFFF00"><td><b><font color="#FF0000">Oopppss, Database Down..</font></b></td></tr></table>';


//$ADODB_COUNTRECS = true;

$db = ADONewConnection();

$db->debug = $debug_db;

$db->Connect($host, $username, $password, $dbname);
if(!$db){
	echo $db_error;
}else{
	//echo 'connected to db</br>';
}
$application_folder = 'application/';

function home(){
	echo "<meta http-equiv='refresh' content='0;url=http://www.hassanhoma.com/fb-lms/index.php />";
}

function go($path){
	echo "<meta http-equiv='refresh' content='0;url=http://www.hassanhoma.com/fb-lms/index.php?menu=".$path."' />";
}



?>