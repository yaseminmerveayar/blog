<?php
session_start();
if (!$_SESSION['LOGGED']) {
	header("Location: 401.html");
	exit();
}
 require("database.php");
 $message = array();
 $errors = array();
 
 $blogId= urlencode($_GET["id"]); 
 if (isset($_FILES['eBlogImage']) || isset($_POST['eCategories']) || isset($_POST['eBlogTitle']) || isset($_POST['eBlogText'])) {

	$fileExtensionsAllowed = ['jpeg','jpg','png'];

    $categories = $_POST['eCategories'];
    $blogTitle = htmlspecialchars($_POST['eBlogTitle'], ENT_QUOTES, 'UTF-8');
    $blogText = $_POST['eBlogText'];

    $q = $db->prepare("SELECT * FROM blogCategories where categoryName=:categoryName ");
    $q->execute(array('categoryName'=>$categories));
    $db_category = $q->fetch();

	$image_path = $_FILES['eBlogImage'];  
        
        $target_dir = "image/";
        $tmp_name = $image_path['tmp_name'];
        $file_name = $image_path['name'];
		$file_size = $image_path['size'];
		$tmp = explode('.',$file_name);
		$fileExtension = strtolower(end($tmp));

        if(!empty($file_name))
        {
            if(!file_exists($target_dir))
            {
                mkdir($target_dir);
            }
			if (! in_array($fileExtension,$fileExtensionsAllowed)) {
				$errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
			}
		
			if ($file_size > 4000000) {
				$errors[] = "File exceeds maximum size (4MB)";
			}
			if (empty($errors)) {

				$uploadPath = $target_dir. $file_name;
				$image_path_str = "image/" . $file_name;

				@move_uploaded_file($tmp_name, $uploadPath);

				if ($categories == null) {
					$update = $db->prepare("UPDATE blogContents SET imagePath=?, title=?,description=?,author=? WHERE id = ?");    
					$update -> execute([$image_path_str,$blogTitle,$blogText,"admin",$blogId]);
					$message = "Blog güncellendi!";
				}else{
					$update = $db->prepare("UPDATE blogContents SET imagePath=?, title=?,description=?,author=?,categoryId=? WHERE id = ?");    
					$update -> execute([$image_path_str,$blogTitle,$blogText,"admin",$db_category['id'],$blogId]);
					$message = "Blog güncellendi!";
				}
			}
        }else{
			$update = $db->prepare("UPDATE blogContents SET title=?,description=?,author=?,categoryId=? WHERE id = ?");    
			$update -> execute([$blogTitle,$blogText,"admin",$db_category['id'],$blogId]);
			$message = "Blog güncellendi!";
		}
	}
 $q = $db -> prepare("SELECT * FROM blogContents WHERE id = ?");
 $q->execute([$blogId]);

 $result = $q->fetch();

 $d = $db -> prepare("SELECT categoryName FROM blogCategories WHERE id = ?");
 $d->execute([$result['categoryId']]);

 $category = $d->fetch();
 
?>

<!DOCTYPE html>
<html class="side-header">
	<head>
	<title>Edit Blog</title>
	<?php
		include("head.html");
	?>
	</head>
	<body data-plugin-page-transition>
		<div class="body">
			<?php
			include("header.php");

			$d = $db -> prepare("SELECT * FROM blogCategories");
			$d->execute();
			$categories = $d->fetchAll();
			?>

			<div role="main" class="main">
				<div class="m-5">
				<?php  
					if (!empty($errors)) {
						echo "<div class='alert alert-danger text-center' role='alert'>
							$errors[0]
							</div>";
					}
					if (!empty($message)) {
						echo "<div class='alert alert-success text-center' role='alert'>
							$message
							</div>";
					}
                ?>
					<h2>Edit Blog</h2>
						<form method="post" enctype="multipart/form-data">
							<div class="mb-3 text-center" >
								<img src="<?= $result['imagePath'] ?>" alt="" style="max-width: 500px;">
							</div>
							<div class="mb-3">
								<label for="eBlogImage" class="form-label">Choose new blog image</label>
								<input class="form-control" type="file" name="eBlogImage" id="eBlogImage">
							</div>
							<div class="mb-3">
							<label for="eCategories">Change category</label>
							<select class="form-select " name="eCategories" id="eCategories">
								<option value="<?= $category['categoryName'] ?>"><?= $category['categoryName'] ?></option>
								<?php
								foreach($categories as $key){
									echo "<option value='".$key['categoryName']."'>".$key['categoryName']."</option>";
								}
								?>
							</select>
							</div>
							<div class="mb-3">
								<label for="eBlogTitle" class="form-label">Update title</label>
								<input type="text" class="form-control" name="eBlogTitle" id="eBlogTitle" value="<?= $result['title'] ?>" >
							</div>
							<div class="mb-3">
								<label for="eBlogText" class="form-label">Update blog text</label>
								<textarea id="summernote" name="eBlogText" id="eBlogText"><?= $result['description'] ?></textarea>
							</div>
							<div class="d-grid gap-2 d-md-flex justify-content-md-end">
								<button class="btn btn-primary" type="submit">Update blog</button>
							</div>							
						</form>
				</div>
		</div>

		<script>
            $(document).ready(function() {
                $('#summernote').summernote();
            });
        </script>
	</body>
</html>