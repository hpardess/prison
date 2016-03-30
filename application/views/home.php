<html>
	<head>
		<?php $this->load->view('meta'); ?>
	</head>
	<body dir="<?=$this->session->userdata('direction') ?>">
		<?php $this->load->view('menu_bar'); ?>

		<!-- Full Page Image Background Carousel Header -->
		<header id="myCarousel" class="carousel slide">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>

			<!-- Wrapper for Slides -->
			<div class="carousel-inner">

				<?php $picsArray= array();
				$picsArray[0] = array("url"=> base_url('assets/images/newimage.jpg'), "caption"=> "Female Prison");
				$picsArray[1] = array("url"=> base_url('assets/images/imagetwo.jpg'), "caption"=> "We bring justice.");
				$picsArray[2] = array("url"=> base_url('assets/images/imageone.jpg'), "caption"=> "We defend human rights.");
				foreach ($picsArray as $key => $value) { 
					if($key == 0) { ?>
					<div class="item active">
					<?php } else { ?>
					<div class="item">
					<?php } ?>
						<!-- Set the first background image using inline CSS below. -->
						<div class="fill" style="background-image:url('<?php echo $value['url']; ?>');"></div>
						<div class="carousel-caption">
							<h2><?php echo $value['caption']; ?></h2>
						</div>
					</div>
				<?php } ?>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="icon-prev"></span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="icon-next"></span>
			</a>

		</header>

		<!-- <div class="container">
		    <h1 style="color: green", align="center">Welcome to Badam Bagh Prison Database</h1>
		</div> -->

		<script type= 'text/javascript'>
            $(document).ready(function () {
            	$("li#home", ".navbar-nav").addClass("active");

				$('#myCarousel').carousel({
					interval: 5000 //changes the speed
				});
            });
        </script>
		<?php $this->load->view('footer'); ?>
	</body>
</html>
