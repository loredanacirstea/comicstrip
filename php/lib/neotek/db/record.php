<?php

include('lib\neotek\db\objectType.php');
include('lib\neotek\db\connection.php');

class record
{
	var $recordData;
	var $tableName;
	var $recordFields;
	var $noFields;
	function record($tableN)
	{
		$this->tableName = $tableN;
		$objType = new objectType($tableN);
		$objType->getFields();
		$this->recordFields = $objType->recordFields;
		
	}
	function get_info($id)
	{
		$conn = new connection();
		$field = $this->recordFields[0];
		$Infoo = $conn->DB->Execute("select * from $this->tableName where $field = $id");
		if($Infoo == false)
			print 'error';
		$info = $Infoo->FetchRow();
		foreach($this->recordFields as $value)
			$this->recordData[$value] = $info[$value];
	}
	function update($id, $values)
	{
		$conn = new connection();
		$k = 0;
		$IDfield = $this->recordFields[0];
		foreach($this->recordFields as $value)
		{
			if(gettype($values[$k]) == "string")
				$update = $conn->DB->Execute("update $this->tableName set $value = \"$values[$k]\" where $IDfield = $id");
			else
				$update = $conn->DB->Execute("update $this->tableName set $value = $values[$k] where $IDfield = $id");
			if($update == false)
				print 'error';
			$this->recordData[$value] = $values[$k];
			$k = $k+1;
		}	
	}
	function insert($values)
	{
		$conn = new connection();
		$Ifields = "";
		foreach($this->recordFields as $value)
			$Ifields = $Ifields . (string)$value . ",";
		$fields = rtrim($Ifields,",");	
		
		$EqValue = "";
		foreach($values as $value)
			if(gettype($value) == "string")
				$EqValue = $EqValue . "\"".$value."\",";                   
			else
				$EqValue = $EqValue . $value.",";                       
		$EqValues = rtrim($EqValue, ",");		
		
		$insert = $conn->DB->Execute("insert into $this->tableName ($fields) values (".$EqValues.")");
		if($insert == false)
			print 'error';
					
		$this->recordData = $values;
		
	}
	function delete($id)
	{
		$conn = new connection();
		$field = $this->recordFields[0];
		$delete = $conn->DB->Execute("delete from $this->tableName where $field = $id limit 1");
		if($delete == false)
			print 'error';
		//if($conn->DB->Execute("select * from $this->tableName where $this->recordFields[0] = $id") == NULL)
			//print 'Record deleted';	
	}	
	function updateValues(&$fieldsArr, $recData)
	{
		$k = 0;
		foreach($recData as $value)
		{	
			$fieldsArr[$k] = $value;
			$k = $k+1;
		}	
		
	}	
	function loadData($array)
	{
		$this->recordData = $array;
	}	

}	
	
	

?>