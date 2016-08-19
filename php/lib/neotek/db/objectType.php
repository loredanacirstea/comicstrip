<?php


class objectType
{
	var $tableName;
	var $recordFields;
	var $noFields;
	function objectType($tableN)
	{
		$this->tableName = $tableN;
	}
	function getFields()
	{
		if($this->tableName == "neo_intltxt")
		{
			$this->recordFields[0] =  "No";
			$this->recordFields[1] = "Localization";
			$this->recordFields[2] = "Title";
			$this->recordFields[3] = "Txt";
			$this->noFields = 4;
		}
                if($this->tableName == "neo_sballoon")
		{
			$this->recordFields[0] = "DataID";
			$this->recordFields[1] = "Ordering";
			$this->recordFields[2] = "FrameID";
			$this->recordFields[3] = "Type";
			$this->recordFields[4] = "IntlTxtNo";
			$this->recordFields[5] = "SrcX";
			$this->recordFields[6] = "SrcY";
			$this->recordFields[7] = "PosX";
			$this->recordFields[8] = "PosY";
			$this->noFields = 9;
		}
		if($this->tableName == "neo_frame")
		{
			$this->recordFields[0] = "DataID";
			$this->recordFields[1] = "Row";
			$this->recordFields[2] = "Ordering";
			$this->recordFields[3] = "URL";
			$this->recordFields[4] = "CacheLoc";
			$this->recordFields[5] = "CacheBal";
			$this->recordFields[6] = "IntlTxtNo";
			$this->recordFields[7] = "CstripID";
			$this->noFields = 8;
		}
		if($this->tableName== "neo_cstrip")
		{
			$this->recordFields[0] = "DataID";
			$this->recordFields[1] = "IntlTxtNo";
			$this->recordFields[2] = "Rows";
			$this->recordFields[3] = "Tags";
			$this->noFields = 4;
		}	
        }

}




?>