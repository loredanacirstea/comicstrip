<?php

include('lib\adodb\adodb.inc.php');

class staticconnection
{
	static $DB;
	function staticconnection()
	{
		self::$DB = &ADONewConnection('mysql');
		self::$DB->PConnect('localhost','root','root','cstrip');
		self::$DB->debug = false;
	}
}


?>