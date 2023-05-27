<?php
 require("database.php");
?>
<!DOCTYPE html>
<html>
	<head>

		<?php
		include("head.html");
		?>

	</head>
	<?php 
		$categoryId= urlencode($_GET["categoryId"]); 
		
		$q = $db -> prepare("SELECT * FROM blogContents WHERE categoryId = ?");
		$q->execute([$categoryId]);

		$results = $q->fetchAll();
	?>
	
	<body data-plugin-page-transition>

		<div class="body">
		<header id="header">
			<div class="header-body border-top-0 bg-dark box-shadow-none">
				<div class="header-container container">
					<div class="header-row">
						<div class="header-column">
							<div class="header-row">
								<div class="header-logo">
									<a href="index.php">
										<img alt="YMA" width="82" height="30" src="admin/image/logo.png">
									</a>
								</div>
							</div>
						</div>
						<div class="header-column justify-content-end">
							<div class="header-row">
								<div class="header-nav header-nav-links header-nav-dropdowns-dark header-nav-light-text order-2 order-lg-1">
									<div class="header-nav-main header-nav-main-font-lg header-nav-main-font-lg-upper-2 header-nav-main-mobile-dark header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
										<nav class="collapse">
											<ul class="nav nav-pills" id="mainNav">
												<li>
													<a data-hash class="nav-link" href="index.php">
														Home
													</a>
												</li>
											</ul>
										</nav>
									</div>
									<button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
										<i class="fas fa-bars"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
			<div role="main" class="main">
				<div class="container ">
					<div class="row">
						<div class="col">
							<div class="blog-posts overflow-hidden">
								<div class="row">
								<?php
									if (isset($results[0])) {
										foreach($results as $key){
											$select = $db -> prepare("SELECT * FROM blogCategories WHERE id = ?");
											$select->execute([$key['categoryId']]);
									
											$category = $select->fetch();

											$a =explode(">","$key[3]");
											$safeText = htmlspecialchars($a[1], ENT_QUOTES, 'UTF-8');
											$desc = substr($safeText, 0 , 500);

											echo "
											<div class='col-md-12'>
											<article>
												<div class='card border-0 border-radius-0 p-1' >
													<div class='card-body p-3 z-index-1'>
														<a href='blog-post.php' class='d-block opacity-hover-8'>
															<img class='card-img-top border-radius-0 mb-2' width='1200' height='500' src='admin/".$key['imagePath']."' alt='Card Image'>
														</a>
														
														<p class='text-uppercase text-color-default text-1 my-2 pb-1'>
															<time pubdate datetime='2022-01-10'>".$key['date']."</time> 
															<span class='opacity-3 d-inline-block px-2'>|</span> 
															".$key['author']."
															<span class='opacity-3 d-inline-block px-2'>|</span> 
															".$category['categoryName']."

														</p>
														<div class='card-body p-0'>
															<h4 class='card-title text-5 font-weight-bold pb-2 mb-2'><a class='text-color-dark text-color-hover-primary text-decoration-none' href='blog-post.php?id=".$key['id']."'>".$key['title']."</a></h4>
															<p class='card-text mb-2'>".$desc."[...]</p>
															<a href='blog-post.php?id=".$key['id']."' class='btn btn-link font-weight-semibold text-decoration-none text-2 ps-0 pb-1 mb-2'>VIEW MORE</a>
														</div>
													</div>
												</div>
											</article>
										</div>";
										}
									}
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer id="footer" class="bg-color-light border-0 pt-5 mt-0">
				<div class="footer-copyright curved-border curved-border-top d-flex align-items-center">
					<div class="container py-2">
						<div class="row py-4">
							<div class="col text-center">
								<p class="text-3">2022 © <strong class="font-weight-normal text-color-light opacity-7">YMA</strong> - Copyright. All Rights Reserved.</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</body>
</html>
