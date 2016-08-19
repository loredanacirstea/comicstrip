<?php
  
 
function form_record($table,$id)
{
	$ip = $_SERVER["SERVER_ADDR"];
	$forwarded = $_GET["forwarded"];
	$forwID = $_GET["forwID"];
	$forfield = $_GET["forfield"];
	$forfield = explode(",",$forfield);
	if($table != "neo_intltxt")
		if($forfield[1] != "IntlTxtNo")
		{	
			$forfield = implode(",",$forfield);
			if($table == "neo_cstrip")
			{
				header("Location: http://$ip/cstrip/php/form_record.php?table=neo_intltxt&id=$id&forwarded=$table ");
				exit();
			}
			else
			{
				header("Location: http://$ip/cstrip/php/form_record.php?table=neo_intltxt&id=$id&forwarded=$table&forwID=$forwID&forfield=$forfield ");
				exit();
			}
		}
			
	include('lib\neotek\cstrip\neo_cstrip.php');
	
	$conn = new connection();
	$FieldPropr = $conn->DB->MetaColumns($table,true);
	if($table == "neo_cstrip")
	{
		$labels = array("ROWS","TAGS");
		$fields = array("Rows","Tags");
	}	
	if($table == "neo_frame")
	{
		$labels = array("URL","ORDER","ROW");
		$fields = array("URL","Ordering","Row");
	}	
	if($table == "neo_sballoon")
	{
		$labels = array("TYPE","ORDER");
		$fields = array("Type","Ordering");
	}
	if($table == "neo_intltxt")
	{
		$labels = array("LANGUAGE","TITLE","TEXT");
		$fields = array("Localization","Title","Txt");
	}
	
	$Mlength = array();
	foreach($labels as $key=>$value)
		$Mlength[$value] = $FieldPropr[$fields[$key]]->max_length;
	
	if($id != "new")
		if($table == "neo_intltxt")
		{
			$Tid = $conn->DB->Execute("select IntlTxtNo from $forwarded where DataID=$id");
			$TxtID = $Tid->FetchRow();
			$Record = new record($table);
			$Record->get_info($TxtID[IntlTxtNo]);
			$values = array($Record->recordData[Localization],$Record->recordData[Title],$Record->recordData[Txt]);
		}
		else
		{
			$Record = new record($table);
			$Record->get_info($id);
			$k = 0;
			foreach($fields as $value)
				$values[$k++] = $Record->recordData[$value];
		}
	  
	print("<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
	<html>
	<head>
	<meta content=\"text/html; charset=ISO-8859-1\"
	http-equiv=\"content-type\">
	<title>form_record.php</title>
	<link rel=\"stylesheet\" href=\"css/style1.css\">
	</head>
	<body>
	<form style=\"height: 197px;\" method=\"get\"
	action=\"form_record_action.php\" name=\"form_record.php\"><br> ");
	$k = 0;
	foreach($labels as $value)
		if($id == "new")
			print("<br>
				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label>$value</label>
				&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
				<input maxlength = \"$Mlength[$value]\"  name=\"$value\"> ");
		else
		{
			print("<br>
				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label>$value</label>
				&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
				<input maxlength = \"$Mlength[$value]\"  name=\"$value\" value=\"$values[$k]\">");
			$k++;
		}	
	print("<br>
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp;<input name=\"CONTINUE\" value=\"CONTINUE\"
		type=\"submit\">
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<input name=\"table\" value=\"$table\" type=\"hidden\">
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<input name=\"id\" value=\"$id\" type=\"hidden\">
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<input name=\"forwarded\" value=\"$forwarded\" type=\"hidden\">
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<input name=\"forwID\" value=\"$forwID\" type=\"hidden\">
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<input name=\"forfield\" value=\"$forfield\" type=\"hidden\">
		<br>
		<br>
		</form>
		</body>
		</html> ");	
}
	
$table = $_GET["table"];
$id = $_GET["id"];
form_record($table,$id);
	
	
?>