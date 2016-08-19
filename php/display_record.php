<?

include('lib\neotek\cstrip\neo_cstrip.php');

function display_record($table,$id)
{
	print("<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
		<html>
		<head>
		<meta content=\"text/html; charset=ISO-8859-1\"
		http-equiv=\"content-type\">
		<title>DISPLAY</title>
		</head>
		<body>
		<form style=\"height: 372px;\" method=\"get\"
		action=\"display_record.php\" name=\"display_record.php\"><br>
		<br>&nbsp; &nbsp; &nbsp; &nbsp;");
	$conn = new connection();	
	if($table == "neo_frame")		
	{	
		$frame = new neo_frame();
		$frame->get_neo_frame($id);
		$frameName = $conn->DB->Execute("select Txt from neo_intltxt where No = $frame->text_no");
		$name = $frameName->FetchRow();
		print("<input name=\"$name[Txt]\"
			alt=\"Image could not be displayed\"
			src=\"http://localhost/cstrip/php/frametest.php?id=$id\"
			value=\"\" height=\"300\" type=\"image\">");
	}		
	if($table == "neo_cstrip")
	{
		$cstrip = new neo_cstrip();
		$cstrip->get_neo_cstrip($id);
		$cstrip->searchFrames();
		foreach($cstrip->framesArr as $value)
		{
			$frameName = $conn->DB->Execute("select Txt from neo_intltxt where No = $value->text_no");
			$name = $frameName->FetchRow();
			print("<input name=\"$name[Txt]\"
			alt=\"Image could not be displayed\"
			src=\"http://localhost/cstrip/php/frametest.php?id=$value->id\"
			value=\"\" height=\"300\" type=\"image\">");
		}
	}	
	print("&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp;<input name=\"CONTINUE\" value=\"CONTINUE\"
		type=\"submit\">
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<input name=\"table\" value=\"$table\" type=\"hidden\">
		<br>
		</form>
		</body>
		</html>");
		
	
	
}

$table = $_GET["table"];
$id = $_GET["id"];
if($_GET["CONTINUE"] == "CONTINUE")
{
	header("Location: http://localhost/cstrip/php/browse_table.php?table=$table");
	exit();
}	
display_record($table, $id);

?>