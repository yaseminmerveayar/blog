<?php
session_start();

if (!$_SESSION['LOGGED']) {
	header("Location: 401.html");
	exit();
}

require("database.php");
$errors= array();

if (isset($_POST['aboutMeTitle']) || isset($_POST["aboutMeSubTitle"]) || isset($_POST["aboutMeDescription"]) || isset($_POST["aboutMeSubDescription"]) || isset($_FILES["CvUrl"]) || isset($_FILES["aboutImage"])) {

	$fileExtensionsAllowed = ['jpeg','jpg','png'];
	$cvfileExtensionsAllowed = ['pdf','png'];
    $key = "aboutMe";
	
    $title = htmlspecialchars($_POST['aboutMeTitle'], ENT_QUOTES, 'UTF-8');
    $subTitle = htmlspecialchars($_POST['aboutMeSubTitle'], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST['aboutMeDescription'], ENT_QUOTES, 'UTF-8');
    $subDescription = htmlspecialchars($_POST['aboutMeSubDescription'], ENT_QUOTES, 'UTF-8');

    $cv_path_str = $_POST['aboutMeCvPath'];
    $image_path_str = $_POST['aboutMeImagePath'];

    $image_path = $_FILES['aboutImage'];  
    $cv_path = $_FILES['CvUrl']; 
        
        $target_dir = "image/";
        $tmp_name = $image_path['tmp_name'];
        $file_name = $image_path['name'];
		$file_size = $image_path['size'];
		$tmp = explode('.',$file_name);
		$fileExtension = strtolower(end($tmp));
       
        $cv_target_dir = "Download Files/";
        $cv_tmp_name = $cv_path['tmp_name'];
        $cv_file_name = $cv_path['name'];
		$cv_file_size = $cv_path['size'];
		$tmp = explode('.',$cv_file_name);
		$cvFileExtension = strtolower(end($tmp));

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

				$value = "".$title."','".$subTitle."','".$description."','".$subDescription."','".$image_path_str."','".$cv_path_str."";

				$update = $db->prepare("UPDATE homeContents SET key=?, value=? WHERE id = 3");    
				$update -> execute([$key,$value]);
			}

            if(!empty($cv_file_name))
            {
                if(!file_exists($cv_target_dir))
                {
                    mkdir($cv_target_dir);
                }
				if (! in_array($cvFileExtension,$cvfileExtensionsAllowed)) {
					$errors[] = "This file extension is not allowed. Please upload a PDF or PNG file";
				}
			
				if ($cv_file_size > 4000000) {
					$errors[] = "File exceeds maximum size (4MB)";
				}
			
				if (empty($errors)) 
				{
                $cv_uploadPath = $cv_target_dir. $cv_file_name;
                $cv_path_str = "Download Files/" . $cv_file_name;
    
                @move_uploaded_file($cv_tmp_name, $cv_uploadPath);
    
                $value = "".$title."','".$subTitle."','".$description."','".$subDescription."','".$image_path_str."','".$cv_path_str."";
    
                $update = $db->prepare("UPDATE homeContents SET key=?, value=? WHERE id = 3");    
                $update -> execute([$key,$value]);
				}
            }
        }elseif(!empty($cv_file_name))
        {
            if(!file_exists($cv_target_dir))
            {
                mkdir($cv_target_dir);
            }
			if (! in_array($cvFileExtension,$cvfileExtensionsAllowed)) {
				$errors[] = "This file extension is not allowed. Please upload a PDF or PNG file";
			}
		
			if ($cv_file_size > 4000000) {
				$errors[] = "File exceeds maximum size (4MB)";
			}
		
			if (empty($errors)) {

				$cv_uploadPath = $cv_target_dir. $cv_file_name;
				$cv_path_str = "Download Files/" . $cv_file_name;

				@move_uploaded_file($cv_tmp_name, $cv_uploadPath);

				$value = "".$title."','".$subTitle."','".$description."','".$subDescription."','".$image_path_str."','".$cv_path_str."";


				$update = $db->prepare("UPDATE homeContents SET key=?, value=? WHERE id = 3");    
				$update -> execute([$key,$value]);
			}
            
        }else{

            $value = "".$title."','".$subTitle."','".$description."','".$subDescription."','".$image_path_str."','".$cv_path_str."";

            $update = $db->prepare("UPDATE homeContents SET key=?, value=? WHERE id = 3");    
            $update -> execute([$key,$value]);
        }
}
?>
<!DOCTYPE html>
<html class="side-header">
	<head>
	<title>About Me</title>
	<?php
		include("head.html");
	?>

	</head>
	<body data-plugin-page-transition>
		<div class="body">
			<?php
			include("header.php");

            $q = $db -> prepare("SELECT value FROM homeContents where key = :key");
            $q->execute(array('key'=>'aboutMe'));
            
            $result = $q->fetch();
            $a =explode("','","$result[0]");
			?>
			
			<div role="main" class="main">
				<div class="container my-3">
				<?php  
					if (!empty($errors)) {
						echo "
						<div class='alert alert-danger text-center' role='alert'>
							$errors[0]
						</div>";
						
						if (!empty($errors[1])) {
							echo "
							<div class='alert alert-danger text-center' role='alert'>
								$errors[1]
							</div>";
						}
					}
				?>
					<div class="row pt-4">
						<h2>About Me</h2>
						<div class="col-md-7">				
							<form action="#" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="aboutMeImagePath" id="aboutMeImagePath" value="<?= $a[4] ?>">
                                <input type="hidden" name="aboutMeCvPath" id="aboutMeCvPath" value="<?= $a[5] ?>">
								<div class="mb-3">
									<label for="aboutMeTitle" class="form-label">Enter title</label>
									<input type="text" class="form-control" name="aboutMeTitle" id="aboutMeTitle" value="<?= $a[0] ?>" >
								</div>
								<div class="mb-3">
									<label for="aboutMeSubTitle" class="form-label">Enter subtitle</label>
									<input type="text" class="form-control" name="aboutMeSubTitle" id="aboutMeSubTitle" value="<?= $a[1] ?>">
								</div>
								<div class="mb-3">
									<label for="aboutMeDescription" class="form-label">Enter description</label>
									<textarea type="text" class="form-control" name="aboutMeDescription" id="aboutMeDescription"><?= $a[2] ?></textarea>
								</div>  
								<div class="mb-3">
									<label for="aboutMeSubDescription" class="form-label">Enter subdescription</label>
									<textarea type="text" class="form-control" name="aboutMeSubDescription" id="aboutMeSubDescription"><?= $a[3] ?></textarea>
								</div> 
								<div class="mb-3">
									<label for="aboutImage" class="form-label">Choose about me image</label>
									<input class="form-control" type="file" name="aboutImage" id="aboutImage">
								</div>
                                <div class="mb-3">
									<label for="CvUrl" class="form-label">Choose downloaded file</label>
									<input class="form-control" type="file" name="CvUrl" id="CvUrl">
								</div>
						</div>
							<div class="col-md-5 order-md-2 mt-5 mb-lg-0">
								<img src="<?= $a[4] ?>" class="img-fluid mb-2" alt="">
                                <p class="font-weight-bold mt-4">Download File Name: <?php $path =explode("/","$a[5]"); echo $path[1];  ?></p>
							</div>
					</div>
								<div class="d-grid gap-2 d-md-flex justify-content-md-end">
									<button class="btn btn-primary" type="submit">Save Changes</button>
								</div>
							</form>
				</div>			
			</div>
		</div>


	</body>
</html>