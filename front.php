<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="E-Shopper">
<meta name="author" content="DRIMTIM">
<link href="<?php echo __ROOT_CSS . 'bootstrap.min.css'?>" rel="stylesheet">
<link href="<?php echo __ROOT_CSS . 'font-awesome.min.css'?>" rel="stylesheet">
<link href="<?php echo __ROOT_CSS . 'prettyPhoto.css'?>" rel="stylesheet">
<link href="<?php echo __ROOT_CSS . 'price-range.css'?>" rel="stylesheet">
<link href="<?php echo __ROOT_CSS . 'animate.css'?>" rel="stylesheet">
<link href="<?php echo __ROOT_CSS . 'main.css'?>" rel="stylesheet">
<link href="<?php echo __ROOT_CSS . 'responsive.css'?>" rel="stylesheet">
<link href="<?php echo __ROOT_CSS . 'jquery-ui-timepicker-addon.css'?>" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="<?php echo __ROOT_CSS . 'jquery.mCustomScrollbar.css'?>" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo __ROOT_IMG . 'ico/favicon.ico'?>">
<style type="text/css">
	.search_box input {
	  background: #F0F0E9;
	  border: medium none;
	  color: #B2B2B2;
	  font-family: 'roboto';
	  font-size: 12px;
	  font-weight: 300;
	  height: 35px;
	  outline: medium none;
	  padding-left: 10px;
	  width: 155px;
	  background-image: <?php echo 'url(' . __ROOT_IMG . 'home/searchicon.png)';?>;
	  background-repeat: no-repeat;
	  background-position: 130px;
	}
</style>
<link href="<?php echo __ROOT_CSS . 'style.css'?>" rel="stylesheet">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo __ROOT_IMG . 'ico/apple-touch-icon-144-precomposed.png'?>">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo __ROOT_IMG . 'ico/apple-touch-icon-114-precomposed.png'?>">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo __ROOT_IMG . 'ico/apple-touch-icon-72-precomposed.png'?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo __ROOT_IMG . 'ico/apple-touch-icon-57-precomposed.png'?>">
<script type="text/javascript">
	var __ROOT = "<?php echo __ROOT; ?>";
</script>
<script src="<?php echo __ROOT_JS . 'jquery-2.1.3.js'?>"></script>
<script src="<?php echo __ROOT_JS . 'bootstrap.js'?>"></script>
<script src="<?php echo __ROOT_JS . 'jquery.scrollUp.min.js'?>"></script>
<script src="<?php echo __ROOT_JS . 'price-range.js'?>"></script>
<script src="<?php echo __ROOT_JS . 'jquery.prettyPhoto.js'?>"></script>
<script src="<?php echo __ROOT_JS . 'main.js'?>"></script>
<script src="<?php echo __ROOT_JS . 'jquery.easyModal.js'?>"></script>
<script src="<?php echo __ROOT_JS . 'jquery.mCustomScrollbar.js'?>"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo __ROOT_JS . 'jquery-ui-timepicker-addon.js'?>"></script>
<script src="<?php echo __ROOT_JS . 'utils.js'?>"></script>
<script src="<?php echo __ROOT_JS . 'jquery.countdown.js'?>"></script>
<script src="<?php echo __ROOT_JS . 'ajaxRequesters.js'?>"></script>
<title>Inicio | DT-Market</title>
</head>
<body>	
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><h6>DrimTim Develop Team</h6></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="<?php echo __ROOT;?>"><img src="<?php echo __ROOT_IMG . 'home/logo.png'?>" alt="" /></a>
						</div>
					</div>
					<div id="__navBar" class="col-sm-8"></div>
				</div>
			</div>
		</div><!--/header-middle-->	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?php echo __ROOT;?>" class="active">Inicio</a></li>
								<li><a href="">Contacto</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->	
	<?php $registry->router->loader(); ?>
	<?php 
		include 'includes/navBar.php';
		include 'includes/timeZone.php';
		include 'includes/countDown.php'; 
	?>
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>DT</span>-Market</h2>
							<p>Una plataforma de compras online hecha a tu medida.</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="<?php echo __ROOT_IMG . 'avatars/nacho.jpg'?>" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Ignacio Tejeira</p>
								<h2>4.166.165-9</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="<?php echo __ROOT_IMG . 'avatars/diego.jpg'?>" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Diego Estela</p>
								<h2>4.855.051-6</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="<?php echo __ROOT_IMG . 'avatars/jona.jpg'?>" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Jonathan Franco</p>
								<h2>4.566.354-8</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="<?php echo __ROOT_IMG . 'home/map.png'?>" alt="" />
							<p>Make by DRIMTIM Develop Team</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About DRIMTIM</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Nuestro Equipo</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Market</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Tu email..." />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Dejanos tu opinion sobre nuestro sitio...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2015 DT-MARKET Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a href="#">DrimTim</a></span> base on template of <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->
</body>
</html>
