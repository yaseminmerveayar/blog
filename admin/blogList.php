<?php
session_start();
if (!$_SESSION['LOGGED']) {
	header("Location: 401.html");
	exit();
}
 require("database.php");
?>

<!DOCTYPE html>
<html class="side-header">
	<head>
	<title>Blog List</title>
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
				<div class="m-5 ">
				<h2>Edit Blog</h2>
						<div>
						<button name="addSubmit" type="button" class="btn btn-dark m-3 float-end" onclick="location.href='addBlog.php'">Add New Blog</button>
						</div>
					<div>
					<table class="table table-striped table-hover">
						<tbody>
						
							<?php
							$d = $db -> prepare("SELECT * FROM blogContents");
							$d->execute();
							$results = $d->fetchAll();

							foreach ($results as $key) {
								$a =explode(">","$key[3]");
								$safeText = htmlspecialchars($a[1], ENT_QUOTES, 'UTF-8');
								$desc = substr($safeText, 0 , 25); 
								echo "<div><tr><th scope='row'>".$key["id"]."</th>
								<td>".$key["title"]."</td>
								<td>".$desc."...</td>
								<td>".$key["date"]."</td>
								<td>".$key["author"]."</td>
								<input type='hidden' id='blogSeeImagePath' name='blogSeeImagePath' value='".$key["imagePath"]."'>
								
								<td><div class='float-end' >
								<button class='btn btn-outline-dark btn-sm mx-1' id='seeSubmit' type='button' title='See' onclick=location.href='../blog-post.php?id=".$key['id']."'>
								<i class='fa-solid fa-eye'></i>
								</button>
									<button class='btn btn-outline-dark btn-sm mx-1' id='editSubmit' type='button' title='Edit'  onclick=location.href='editBlog.php?id=".$key['id']."'>
								<i class='fa-solid fa-pen'></i>
								</button>
								<button class='btn btn-outline-dark btn-sm mx-1' id='deleteSubmit' type='button' title='Sil' onclick=location.href='deleteBlog.php?id=".$key['id']."' >
									<i class='far fa-trash-alt' ></i>
								</button></div>
								</td></tr></div>";
							}
							?>
						
						</tbody> 
					</table>
					</div>
			  </div>
		</div>
	</body>
</html>