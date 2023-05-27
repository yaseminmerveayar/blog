<?php
session_start();
if (!$_SESSION['LOGGED']) {
	header("Location: 401.html");
	exit();
}
 require("database.php");
 include("modal.php");
 
 if (isset($_POST['AddCategoryName'])) {
	$categoryName = htmlspecialchars($_POST['AddCategoryName'], ENT_QUOTES, 'UTF-8');

	$data = substr($categoryName, 0, 2).rand(0,100);
	$insert = $db->prepare("INSERT INTO blogCategories (categoryName,filterId) VALUES (?,?)");    
    $insert -> execute([$categoryName,$data]);
 }

 if (isset($_POST['EditCategoryName'])) {
	$categoryName = $_POST['EditCategoryName'];
	$categoryId = $_POST['CategoryId'];

	$data = substr($categoryName, 0, 2).$categoryId;
	$update = $db->prepare("UPDATE blogCategories SET categoryName=? filterId=? WHERE id = $categoryId");    
    $update -> execute([$categoryName,$data]);
 }
?>

<!DOCTYPE html>
<html class="side-header">
	<head>
	<title>Categories</title>
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
					<h2>Categories</h2>
							<div>
							<button name="addSubmit" type="button" class="btn btn-dark m-3 float-end" data-bs-toggle="modal" data-bs-target="#myCategoryModal" >Add New Category</button>
							</div>
						<div>
						<table class="table table-striped table-hover">
							<tbody>
									<?php
									$d = $db -> prepare("SELECT * FROM blogCategories");
									$d->execute();
									$Result = $d->fetchAll();
									foreach ($Result as $key) {
										
										echo "<div><tr><th scope='row'>".$key["id"]."</th>
										<td>".$key["categoryName"]."</td>
										
										<td><div class='float-end' style='margin-right: 20px;'>
											<button class='btn btn-outline-dark btn-sm' id='editSubmit' type='button' title='Edit' data-bs-toggle='modal' data-bs-target='#myCategoryEditModal' onmouseenter='getCurrentCategoryId(this)'>
										<i class='fa-solid fa-pen'></i>
										</button>
										<button class='btn btn-outline-dark btn-sm' style='margin-left: 40px;' id='deleteSubmit' type='button' title='Sil' onclick=location.href='deleteCategory.php?id=".$key['id']."' >
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
		</div>
	<script>
		function getCurrentCategoryId(event) {
		document.getElementById("EditCategoryName").value = event.parentNode.parentNode.parentNode.children[1].innerText;
		document.getElementById("CategoryId").value = event.parentNode.parentNode.parentNode.children[0].innerText;
		}

	</script>					
	</body>
</html>