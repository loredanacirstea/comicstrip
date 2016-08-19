<?php

include('lib\neotek\db\staticconnection.php');

class connection
{
	var $DB;
	function connection()
	{
		$staticconnectionobject = new staticconnection();
		$this->DB = staticconnection::$DB;
	}
}	

?>