<?php
session_start();
if (!$_SESSION['LOGGED']) {
	header("Location: 401.html");
	exit();
}
require("database.php");

$blogId= urlencode($_GET["id"]);

$delete = $db->prepare("DELETE FROM blogContents WHERE id = :id");    
$delete -> execute(array('id' => $blogId));

header("Location: blogList.php"); 
exit();
?>