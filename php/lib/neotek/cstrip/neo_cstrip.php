<?php

include('lib\neotek\cstrip\neo_frame.php');


class neo_cstrip
{
	var $id;
	var $text_no;
	var $rows;
	var $tags;
	var $fieldsArr; 
	var $framesArr;
	function neo_cstrip()
	{
	        $this->id = 0;
		$this->text_no = 1;
		$this->rows = 1;
		$this->tags = '';
		$this->fieldsArr = array(&$this->id, &$this->text_no, &$this->rows, &$this->tags);

	}	
	function get_neo_cstrip($id)
	{
		$this->id = $id;
		$cstrip = new record("neo_cstrip");
		$cstrip->get_info($this->id);
		$cstrip->updateValues($this->fieldsArr, $cstrip->recordData);
	}
	function update_cstrip($values)
	{
		$cstrip = new record("neo_cstrip");
		$cstrip->update($this->id, $values);
		$cstrip->updateValues($this->fieldsArr, $cstrip->recordData);
	}
	function insert_cstrip($values)
	{
		$cstrip = new record("neo_cstrip");
		$cstrip->insert($values);
		$cstrip->updateValues($this->fieldsArr, $cstrip->recordData);
	}	
	function delete_cstrip()
	{
		$cstrip = new record("neo_cstrip");
		$cstrip->delete($this->id);
	}
	function searchFrames()
	{
		$frames = new view("neo_frame");
		$frames->search("CstripID = $this->id order by Ordering asc");
		foreach($frames->recordsArray as $key=>$value)
		{	
			$this->framesArr[$key] = new neo_frame();
			$frames->updateValues($this->framesArr[$key]->fieldsArr, $value->recordData);
			//$this->framesArr[$key]->fieldsArr = $temporary;
		}	
	}	
	
	
}	



?>