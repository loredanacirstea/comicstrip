<?

include('lib\neotek\db\connection.php');

function form_sballoon_coord($BalID)
{
	$id = $_GET["id"];
	$for = $_GET["for"];
	var_dump($BalID);
	$conn = new connection();
	$Frameid = $conn->DB->Execute("select FrameID from neo_sballoon where DataID = $BalID");
	if($Frameid == false)
		print 'error';
	$FrameID = $frameid->FetchRow();
	$Frameurl = $conn->DB>Execute("select URL from neo_frame where DataID = $FrameID");
	if($Frameurl == false)
		print 'error';
	$FrameURL = $Frameurl->FetchRow();
	$URL = $FrameURL[URL];
	
	print("<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
		<html>
		<head>
		<meta content=\"text/html; charset=ISO-8859-1\"
		http-equiv=\"content-type\">
		<title></title>
		</head>
		<body>
		<form style=\"height: 252px;\" method=\"get\"
		action=\"form_sballoon_coord_action.php\"
		name=\"form_sballoon_coord.php\"><br>
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input
		name=\"form_image\" alt=\"The image could not be found\"
		src=\"$URL\" style=\"border: medium none ; height=\"350\" type=\"image\">
		<br>
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<input name=\"BalID\" value=\"$BalID\" type=\"hidden\">
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<input name=\"for\" value=\"$for\" type=\"hidden\">");
	if($id == "new")
		print("<br>
			&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
			<input name=\"id\" value=\"$id\" type=\"hidden\">");
	print("</form>
		</body>
		</html>");
	
}

print "aaa";
exit();
$BalID = $_GET["BalID"];
var_dump($BalID);
exit();
form_sballoon_coord($BalID]);

	




?>