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
    <title>Contact Messages</title>
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
                <h2>Contact Messages</h2>
                    <div class="todo-list">
                        <table class="table table-striped table-hover">
                        <tbody>
                                <?php
                                $d = $db -> prepare("SELECT * FROM contactMessages");
                                $d->execute();
                                $result = $d->fetchAll();
                                foreach ($result as $key) {
                                    
                                    echo "<div><tr><th scope='row'>".$key["id"]."</th>
                                    <td>".$key["name"]."</td>
                                    <td>".$key["phoneNumber"]."</td>
                                    <td>".$key["mail"]."</td>
                                    <td>".$key["message"]."</td>";
                                }
                                ?>
                            
                        </tbody> 
                        </table>
                    </div>
                </div>
            </div>
			  
		</div>



	</body>
</html>