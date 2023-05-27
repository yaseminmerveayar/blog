<?php
session_start();

if (!$_SESSION['LOGGED']) {
	header("Location: 401.html");
	exit();
}
 require("database.php");
 $message = array();
 $errors = array();

 if (isset($_FILES['blogImage']) || isset($_POST['Categories']) || isset($_POST['blogTitle']) || isset($_POST['blogText'])) {

	$fileExtensionsAllowed = ['jpeg','jpg','png'];

    $categories = htmlspecialchars($_POST['Categories'], ENT_QUOTES, 'UTF-8');
    $blogTitle = htmlspecialchars($_POST['blogTitle'], ENT_QUOTES, 'UTF-8');
    $blogText = $_POST['blogText'];
    $date = date("d/m/Y");

    $q = $db->prepare("SELECT * FROM blogCategories where categoryName=:categoryName ");
    $q->execute(array('categoryName'=>$categories));
    $db_category = $q->fetch();

	$image_path = $_FILES['blogImage'];  
        
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
					$insert = $db->prepare("INSERT INTO blogContents (imagePath, title, description, date, author) VALUES (?,?,?,?,?)");    
					$insert -> execute([$image_path_str,$blogTitle,$blogText,$date,$_SESSION['USERNAME']]);
					$message = "Blog eklendi!";
				}else{
					$insert = $db->prepare("INSERT INTO blogContents (imagePath, title, description, date, author, categoryId) VALUES (?,?,?,?,?,?)");    
					$insert -> execute([$image_path_str,$blogTitle,$blogText,$date,$_SESSION['USERNAME'],$db_category['id']]);
					$message = "Blog eklendi!";
				}
			}
        }else{
			$errors[] = "Lütfen blog resmi seçiniz";
		}
	}
?>

<!DOCTYPE html>
<html class="side-header">
	<head>
	<title>Add Blog</title>
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
			$result = $d->fetchAll();
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
			<h2>Add New Blog</h2>
				<form action="#" method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="blogImage" class="form-label">Choose blog image</label>
					<input class="form-control" type="file" name="blogImage" id="blogImage">
				</div>
				<div class="mb-3">
				<label for="Categories">Select a category</label>
                <select class="form-select " name="Categories" id="Categories">
                    <?php
					foreach($result as $key){
						echo "<option value='".$key['categoryName']."'>".$key['categoryName']."</option>";
					}
					?>
                </select>
                </div>
				<div class="mb-3">
					<label for="blogTitle" class="form-label">Enter title</label>
					<input type="text" class="form-control" name="blogTitle" id="blogTitle" >
				</div>
				<div class="mb-3">
					<label for="blogText" class="form-label">Enter blog text</label>
					<textarea id="summernote" name="blogText" id="blogText"></textarea>
				</div>
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
					<button class="btn btn-primary" type="submit">Add blog</button>
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