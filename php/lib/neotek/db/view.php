<?php

include('lib\neotek\db\record.php');

class view
{
	var $tableName;
	var $recordsArray;
	var $noRecords;
	function view($tableN)
	{
		$this->tableName = $tableN;
	}	
	function search($query)
	{
		$conn = new connection();
		$infoo = $conn->DB->Execute("select * from $this->tableName where $query");
		if($infoo == false)
			print 'error';
		$k = 0;
		$info = $infoo->FetchRow();
		while($info != false)
		{
			$this->recordsArray[$k] = new record($table);
			$this->recordsArray[$k]->loadData($info);
			$info = $infoo->FetchRow();
			$k = $k+1;
		}
		$this->noRecords = $k;
	}	
	function browse()
	{
		if($this->tableName == "neo_intltxt")
			$fieldID = "No";
		else
			$fieldID = "DataID";
		$conn = new connection();
		$infoo = $conn->DB->Execute("select * from $this->tableName order by $fieldID ASC");
		if($infoo == false)
			print 'error';
		$k = 0;
		$info = $infoo->FetchRow();
		while($info != false)
		{
			$this->recordsArray[$k] = new record($table);
			$this->recordsArray[$k]->loadData($info);
			$info = $infoo->FetchRow();
			$k = $k+1;
		}
		$this->noRecords = $k;
	}	
	function updateValues(&$fieldsArr, $recData)
	{
		foreach($fieldsArr as $key=>$value)
			$fieldsArr[$key] = $recData[$key];
	}	

}

?>