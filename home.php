<div id="home" class="owl-carousel owl-carousel-light owl-carousel-light-init-fadeIn owl-theme manual dots-inside dots-horizontal-center show-dots-hover nav-inside nav-inside-plus nav-dark nav-md nav-font-size-md show-nav-hover mb-0" data-plugin-options="{'autoplayTimeout': 7000}" style="height: 100vh;">
	<div class="owl-stage-outer">
		<div class="owl-stage">

			<?php
				$q = $db -> prepare("SELECT value FROM homeContents where key = :key");
				$q->execute(array('key'=>'slider1'));
				
				$result = $q->fetch();
				$a =explode("','","$result[0]");

				$q2 = $db -> prepare("SELECT value FROM homeContents where key = :key");
				$q2->execute(array('key'=>'slider2'));
				
				$result2 = $q2->fetch();
				$b =explode("','","$result2[0]");

				echo "<div class='owl-item position-relative overlay overlay-show overlay-op-8 pt-5' style='background-image: url(admin/".$a[0]."); background-size: cover; background-position: center;'>
					<div class='container position-relative z-index-3 h-100'>
						<div class='row justify-content-center align-items-center h-100'>
							<div class='col-lg-6'>
								<div class='d-flex flex-column align-items-center'>
									<h3 class='position-relative text-color-light text-5 line-height-5 font-weight-medium px-4 mb-2 appear-animation' data-appear-animation='fadeInDownShorterPlus' data-plugin-options='{'minWindowWidth': 0}'>
										<span class='position-absolute right-100pct top-50pct transform3dy-n50 opacity-3'>
											<img src='admin/image/slides/slide-title-border.png' class='w-auto appear-animation' data-appear-animation='fadeInRightShorter' data-appear-animation-delay='250' data-plugin-options='{'minWindowWidth': 0}' alt='' />
										</span>
										".$a[1]."
										<span class='position-absolute left-100pct top-50pct transform3dy-n50 opacity-3'>
											<img src='admin/image/slides/slide-title-border.png' class='w-auto appear-animation' data-appear-animation='fadeInLeftShorter' data-appear-animation-delay='250' data-plugin-options='{'minWindowWidth': 0}' alt='' />
										</span>
									</h3>
									<h2 class='text-color-light font-weight-extra-bold text-12 mb-3 appear-animation' data-appear-animation='blurIn' data-appear-animation-delay='500' data-plugin-options='{'minWindowWidth': 0}'>".$a[2]."</h2>
									<p class='text-4 text-color-light font-weight-light opacity-7 text-center mb-0' data-plugin-animated-letters data-plugin-options='{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 25}'>".$a[3]."</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class='owl-item position-relative overlay overlay-show overlay-op-8 pt-5' style='background-image: url(admin/".$b[0]."); background-size: cover; background-position: center;'>
					<div class='container position-relative z-index-3 h-100'>
						<div class='row justify-content-center align-items-center h-100'>
							<div class='col-lg-6'>
								<div class='d-flex flex-column align-items-center'>
									<h3 class='position-relative text-color-light text-4 line-height-5 font-weight-medium px-4 mb-2 appear-animation' data-appear-animation='fadeInDownShorterPlus' data-plugin-options='{'minWindowWidth': 0}'>
										<span class='position-absolute right-100pct top-50pct transform3dy-n50 opacity-3'>
											<img src='admin/image/slides/slide-title-border.png' class='w-auto appear-animation' data-appear-animation='fadeInRightShorter' data-appear-animation-delay='250' data-plugin-options='{'minWindowWidth': 0}' alt='' />
										</span>
										".$b[1]."
										<span class='position-absolute left-100pct top-50pct transform3dy-n50 opacity-3'>
											<img src='admin/image/slides/slide-title-border.png' class='w-auto appear-animation' data-appear-animation='fadeInLeftShorter' data-appear-animation-delay='250' data-plugin-options='{'minWindowWidth': 0}' alt='' />
										</span>
									</h3>
									<h2 class='porto-big-title text-color-light font-weight-extra-bold mb-3' data-plugin-animated-letters data-plugin-options='{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 250, 'animationName': 'fadeInRightShorterOpacity', 'letterClass': 'd-inline-block'}'>".$b[2]."</h2>
									<p class='text-4 text-color-light font-weight-light text-center mb-0' data-plugin-animated-letters data-plugin-options='{'startDelay': 2000, 'minWindowWidth': 0}'>".$b[3]."</p>
								</div>
							</div>
						</div>
					</div>
				</div>";			
			?>

		</div>
	</div>
	<div class="owl-nav">
		<button type="button" role="presentation" class="owl-prev"></button>
		<button type="button" role="presentation" class="owl-next"></button>
	</div>
	<div class="owl-dots mb-5">
		<button role="button" class="owl-dot active"><span></span></button>
		<button role="button" class="owl-dot"><span></span></button>
	</div>
</div>