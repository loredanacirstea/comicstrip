<?php

include('lib\neotek\db\table.php');

class neo_intltxt
{
	var $no;
	var $localization;
	var $title;
	var $txt;
	var $fieldsArr;
	function neo_intltxt()
	{
	        $this->no= 1 ;
		$this->localization = "en";
		$this->title = '';
		$this->txt = '';
		$this->fieldsArr = array(&$this->no, &$this->localization, &$this->title, &$this->txt);

	}	
	function get_neo_intltxt($no)
	{
		$this->no = $no;
		$text = new record("neo_intltxt");
		$text->get_info($this->no);
		$text->updateValues($this->fieldsArr, $text->recordData);
	}
	function update_txt($values)
	{
		$text = new record("neo_intltxt");
		$text->update($this->no, $values);
		$text->updateValues($this->fieldsArr, $text->recordData);
	}
	function insert_txt($values)
	{
		$text = new record("neo_intltxt");
		$text->insert($values);
		$text->updateValues($this->fieldsArr, $text->recordData);
	}
	function delete_txt()
	{
		$text = new record("neo_intltxt");
		$text->delete($this->no);
	}
}




?>