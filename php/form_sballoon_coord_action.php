<?

include('lib\neotek\db\connection.php');

$x = $_GET["form_image.x"];
$y = $_GET["form_image.y"];
$BalID = $_GET["BalID"];
$id = $_GET["id"];
$for = $_GET["for"];

$conn = new connection();
if($for == "source")
{
	$update = $conn->DB->Execute("update neo_sballoon set SrcX = $x, SrcY = $y where DataID = $BalID");
	header("Location: http://localhost/cstrip/php/form_sballoon_coord.php?id=$id&BalID=$BalID&for=center");
		exit();
}
if($for == "center")
{
	$update = $conn->DB->Execute("update neo_sballoon set PosX = $x, PosY = $y where DataID = $BalID");
	header("Location: http://localhost/cstrip/php/display_record.php?table=neo_sballoon&id=$BalID");
		exit();
}


?>