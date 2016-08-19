<?php

include('lib\neotek\db\view.php');

class table
{
	var $tableName;
	var $recordsArray;
	var $noRecords;
	function table($tableN)
	{
		$this->tableName = $tableN;
	}	
}

?>