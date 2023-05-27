<?php
session_start();
if (!$_SESSION['LOGGED']) {
	header("Location: 401.html");
	exit();
}
require("database.php");

$categoryId= urlencode($_GET["id"]);

$delete = $db->prepare("DELETE FROM blogCategories WHERE id = :id");    
$delete -> execute(array('id' => $categoryId));

header("Location: categories.php"); 
exit();
?>