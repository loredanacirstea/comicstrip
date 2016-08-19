<?php

include('lib\neotek\cstrip\neo_cstrip.php');

$table = $_GET["table"];
$id = $_GET["id"];

if($table == "neo_intltxt")
{
	$fieldID = "No";
	$values = array($id, $_GET["LANGUAGE"], $_GET["TITLE"], $_GET["TEXT"]);
}	
else
	$fieldID = "DataID";
if($table == "neo_sballoon")
	$values = array($id, $_GET["ORDER"], $_GET["FrameID"], $_GET["TYPE"], $_GET["TextNo"],"","","","");
if($table == "neo_frame")
	$values = array($id, $_GET["ROW"], $_GET["ORDER"], $_GET["URL"], "","", $_GET["TextNo"], $_GET["CstripID"]);
if($table == "neo_cstrip")
	$values = array($id, $_GET["TextNo"], $_GET["ROWS"], $_GET["TAGS"]);

if($id == "new")
{
	$conn = new connection();
	$lastRecord = $conn->DB->Execute("select * from $table order by $fieldID desc limit 1");
	if($conn->DB->Execute("select * from $table order by $fieldID desc limit 1") == false)
		print 'error';
	$LastRec = $lastRecord->FetchRow();		
	$newID = $LastRec[$fieldID]+1;
	$values[0] = $newID;
	$Record = new record($table);
	$Record->insert($values);
}
else
{
	$Record = new record($table);
	$Record->update($id,$values);
}	







/*
if($table == "neo_cstrip")
{
	if($id == "new")
	{
		$conn = new connection();
		$lastRecord = $conn->DB->Execute("select * from $table order by DataID desc limit 1");
		if($conn->DB->Execute("select * from $table order by DataID desc limit 1") == false)
			print 'error';
		$LastRec = $LastRecord->FetchRow();		
		$id = $lastRec[DataID]+1;
		$Record = new neo_cstrip();
		$Record->insert($id, $_GET["TextNo"], $_GET["ROWS"], $_GET["TAGS"]);
	}
	else
	{
		$Record = new neo_cstrip();
		$Record->update($_GET["id"], $_GET["TextNo"], $_GET["ROWS"], $_GET["TAGS"]);
	}
}
if($table == "neo_frame")
{
	if($id == "new")
	{
		$conn = new connection();
		$lastRecord = $conn->DB->Execute("select * from $table order by DataID desc limit 1");
		if($conn->DB->Execute("select * from $table order by DataID desc limit 1") == false)
			print 'error';
		$LastRec = $LastRecord->FetchRow();		
		$id = $lastRec[DataID]+1;
		$Record = new neo_frame();
		$Record->insert($id, $_GET["ROW"], $_GET["ORDER"], $_GET["URL"], $_GET["TextNo"], $_GET["CstripID"]);
	}
	else
	{
		$Record = new neo_frame();
		$Record->update($_GET["id"], $_GET["ROW"], $_GET["ORDER"], $_GET["URL"], $_GET["TextNo"], $_GET["CstripID"]);
	}
}
if($table == "neo_sballoon")
{
	if($id == "new")
	{
		$conn = new connection();
		$lastRecord = $conn->DB->Execute("select * from $table order by DataID desc limit 1");
		if($conn->DB->Execute("select * from $table order by DataID desc limit 1") == false)
			print 'error';
		$LastRec = $lastRecord->FetchRow();		
		$id = $lastRec[DataID]+1;
		$Record = new neo_sballoon();
		$Record->insert($id, $_GET["ROW"], $_GET["ORDER"], $_GET["URL"], $_GET["TextNo"], $_GET["CstripID"]);
	}
	else
	{
		$Record = new neo_sballoon();
		$Record->update($_GET["id"], $_GET["ROW"], $_GET["ORDER"], $_GET["URL"], $_GET["TextNo"], $_GET["CstripID"]);
	}
}
if($table == "neo_intltxt")
{
	if($id == "new")
	{
		$conn = new connection();
		$lastRecord = $conn->DB->Execute("select * from $table order by No desc limit 1");
		if($conn->DB->Execute("select * from $table order by No desc limit 1") == false)
			print 'error';
		$LastRec = $lastRecord->FetchRow();
		$id = $LastRec[No]+1;
		$Record = new neo_intltxt();
		$values = array($id, $_GET["LANGUAGE"], $_GET["TITLE"], $_GET["TEXT"]);
		$Record->insert_txt($values);
	}
	else
	{
		$Record = new neo_sballoon();
		$Record->update($_GET["NO"], $_GET["LANGUAGE"], $_GET["TITLE"], $_GET["TEXT"]);
	}
}
*/

?>