<?php
session_start();
if (!$_SESSION['LOGGED']) {
	header("Location: login.php");
	exit();
}
 require("database.php");
?>

<!DOCTYPE html>
<html class="side-header">
	<head>
	<title>Admin Board</title>
	<?php
		include("head.html");
	?>
	</head>
	<body data-plugin-page-transition>
		<div class="body">
		<?php
			include("header.php");	
		?>
		<div role="main" class="main">
			<div class="m-5">
				<h1 class="text-center text-uppercase">WELCOME TO the ADMIN BOARD</h1>
			</div>
			<div class="row justify-content-center m-5">
				<img src="image/dance.gif" alt="">
			</div>		
		</div>
	</body>
</html>