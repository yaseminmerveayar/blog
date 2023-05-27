<?php
session_start();
if (!$_SESSION['LOGGED']) {
	header("Location: 401.html");
	exit();
}
 require("database.php");

 if (isset($_POST['contactMeTitle']) || isset($_POST['contactMeDescription'])) {
    $title = htmlspecialchars($_POST['contactMeTitle'], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST['contactMeDescription'], ENT_QUOTES, 'UTF-8');

    $key = "contactMe";
    $value = "".$title."','".$description."";

    $update = $db->prepare("UPDATE homeContents SET key=?, value=? WHERE id = 4");    
    $update -> execute([$key,$value]);
 }
?>

<!DOCTYPE html>
<html class="side-header">
	<head>
	<title>Contact Me</title>
	<?php
		include("head.html");
	?>

	</head>
	<body data-plugin-page-transition>
		<div class="body">
			<?php
			include("header.php");

            $q = $db -> prepare("SELECT value FROM homeContents where key = :key");
            $q->execute(array('key'=>'contactMe'));
            
            $result = $q->fetch();
            $a =explode("','","$result[0]");
			?>
			
			<div role="main" class="main">
				<div class="container my-3">
					<div class="row pt-4">
						<h2>About Me</h2>
						<div class="col">				
							<form action="#" method="POST">
								<div class="mb-3">
									<label for="aboutMeTitle" class="form-label">Enter title</label>
									<input type="text" class="form-control" name="contactMeTitle" id="contactMeTitle" value="<?= $a[0] ?>" >
								</div>
								<div class="mb-3">
									<label for="aboutMeDescription" class="form-label">Enter description</label>
									<textarea type="text" class="form-control" name="contactMeDescription" id="contactMeDescription"><?= $a[1] ?></textarea>
								</div>  
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
									<button class="btn btn-primary" type="submit">Save Changes</button>
								</div>
							</form>
						</div>
					</div>					
				</div>			
			</div>
		</div>
