<?

include('lib\neotek\db\record.php');

function delete_record($table,$id)
{
	print("<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
		<html>
		<head>
		<link rel=\"stylesheet\" href=\"css/style1.css\">
		<meta content=\"text/html; charset=ISO-8859-1\"
		http-equiv=\"content-type\">
		<title>delete_record.php</title>
		</head>
		<body>
		<form style=\"height: 197px;\" method=\"get\"
		action=\"delete_record.php\" name=\"delete_record.php\">
		<br>
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp;<input name=\"DELETE\" value=\"DELETE\"
		type=\"submit\">
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<input name=\"table\" value=\"$table\" type=\"hidden\">
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<input name=\"id\" value=\"$id\" type=\"hidden\">
		<br>
		<br>
		</form>
		</body>
		</html> ");	
	
}

$ip = $_SERVER["SERVER_ADDR"];
$table = $_GET["table"];
$id = $_GET["id"];
if($_GET["DELETE"] == "DELETE")
{	
	$record = new record($table);
	$record->delete($id);
	header("Location: http://$ip/cstrip/php/browse_table.php?table=$table");
	exit();
}

delete_record($table,$id);




?>