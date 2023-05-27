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
		$blogId= urlencode($_GET["id"]); 
		
		$q = $db -> prepare("SELECT * FROM blogContents WHERE id = ?");
		$q->execute([$blogId]);

		$result = $q->fetch();

		$d = $db -> prepare("SELECT categoryName FROM blogCategories WHERE id = ?");
		$d->execute([$result['categoryId']]);

		$category = $d->fetch();

		$date =explode("/","$result[4]");
	
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
				<div class="container py-4">
					<input type="hidden" id="blogPostId" name="blogPostId">
						<div class="row">
							<div class="col">
								<div class="blog-posts single-post">
									<article class="post post-large blog-single-post border-0 m-0 p-0">
										<div class="post-image ms-0 text-center">
											<a href="blog-post.html">
												<img src="admin/<?= $result['imagePath']?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0 width='1200' height='500'" alt="" />
											</a>
										</div>
										<div class="post-date ms-0">
											<span class="day"><?= $date[0]?></span>
											<span class="month"><?= $date[1]?></span>
										</div>
										<div class="post-content ms-0">
											<h2 class="font-weight-semi-bold"><a href="#"><?= $result['title']?></a></h2>
											<div class="post-meta">
												<span><i class="far fa-user"></i> By <a href="authorBlog.php?author=<?=$result['author']?>"><?= $result['author']?></a> </span>
												<span><i class="far fa-folder"></i> <a href="categoryBlog.php?categoryId=<?=$result['categoryId']?>"><?= $category['categoryName']?></a> </span>
											</div>
											<?= $result['description']?>
										</div>
									</article>
								</div>
							</div>
						</div>
					</div>
				</div>
				<footer class="bg-color-light border-0 pt-5 mt-0">
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
