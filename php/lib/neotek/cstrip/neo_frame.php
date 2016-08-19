<?php

include('lib\neotek\cstrip\neo_sballoon.php');

class neo_frame
{
	var $id;
	var $row;
	var $order;
	var $URL;
	var $cacheloc;
	var $cachebal;
	var $text_no;
	var $cstrip_id;
	var $fieldsArr;
	var $balloonsArr;
	function neo_frame()
	{
	        $this->id = 0;
		$this->row = 1;
		$this->order = 1;
		$this->URL = '';
		$this->cacheloc = '';
		$this->cachebal = '';
		$this->text_no = 1;
		$this->cstrip_id = 0;
		$this->fieldsArr = array(&$this->id, &$this->row, &$this->order, &$this->URL, &$this->cacheloc, &$this->cachebal, &$this->text_no, &$this->cstrip_id);
	}	
	function get_neo_frame($id)
	{
		$this->id = $id;
		$frame = new record("neo_frame");
		$frame->get_info($this->id);
		$frame->updateValues($this->fieldsArr, $frame->recordData);
	}
	function update_frame($id, $values)
	{
		$this->id = $id;
		$frame = new record("neo_frame");
		$frame->update($this->id, $values);
		$frame->updateValues($this->fieldsArr, $frame->recordData);
	}
	function insert_frame($values)
	{
		$frame = new record("neo_frame");
		$frame->insert($values);
		$frame->updateValues($this->fieldsArr, $frame->recordData);		
	}
	function delete_frame()
	{
		$frame = new record("neo_frame");
		$frame->delete($this->id);
	}
	function searchBalloons()
	{
		$balloons = new view("neo_sballoon");
		$balloons->search("FrameID = $this->id order by Ordering asc");
		foreach($balloons->recordsArray as $key=>$value)
		{	
			$this->balloonsArr[$key] = new neo_sballoon();
			//$temporary = array();
			$balloons->updateValues($this->balloonsArr[$key]->fieldsArr, $value->recordData);
			//$this->balloonsArr[$key]->fieldsArr = $temporary;
		}	
	}	
}	


?>