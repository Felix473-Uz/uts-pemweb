
<!DOCTYPE HTML>
<html>
	<head>
	<title>SNEAKERS JAKARTA STORE</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rokkitt:100,300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('assets_customer/css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('assets_customer/css/icomoon.css') }}">
	<!-- Ion Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('assets_customer/css/ionicons.min.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ asset('assets_customer/css/bootstrap.min.css') }}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{ asset('assets_customer/css/magnific-popup.css') }}">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="{{ asset('assets_customer/css/flexslider.css') }}">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="{{ asset('assets_customer/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets_customer/css/owl.theme.default.min.css') }}">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{ asset('assets_customer/css/bootstrap-datepicker.css') }}">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="{{ asset('assets_customer/fonts/flaticon/font/flaticon.css') }}">

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{ asset('assets_customer/css/style.css') }}">

	</head>
	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page">
		<nav class="colorlib-nav" role="navigation">
      <div class="top-menu">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-sm-3 col-md-3">
				<div id="colorlib-logo" style="display: flex; align-items: center; gap: 8px;">
					<img src="{{ asset('assets_customer/images/logo.png') }}" style="height: 40px;">
					<a href="index.html" style="text-decoration: none; font-weight: bold; color: black;font-size:14px">SNEAKERS JAKARTA STORE</a>
				</div>

            </div>
            <div class="col-sm-9 col-md-9 text-left menu-1 d-flex justify-content-end">
              <ul class="list-unstyled mb-0 d-flex align-items-center">
                <li class="<?php if($title=="Homepage") {?>active<?php }?>" style="margin-right:15px;"><a href="{{route('homepage')}}">Home</a></li>
                <li class="<?php if($title=="About") {?>active<?php }?>" style="margin-right:15px;"><a href="{{route('about')}}">About</a></li>
                <li class="<?php if($title=="Produk") {?>active<?php }?>" style="margin-right:15px;"><a href="{{route('produk_customer')}}">Produk</a></li>

                @auth
                  <li class="cart <?php if($title=="Cart") {?>active<?php }?>" style="margin-right:15px;"><a href="{{route('checkout')}}">Cart [{{ $cart }}]</a></li>
                  <li class="cart <?php if($title=="History") {?>active<?php }?>" style="margin-right:15px;"><a href="{{route('history')}}">History</a></li>
                  <li class="cart <?php if($title=="Logout") {?>active<?php }?>" style="margin-right:15px;"><a href="{{route('logout')}}">Logout</a></li>
                @endauth

                @guest
                  <li class="cart <?php if($title=="Login") {?>active<?php }?>">
                    <a class="btn btn-primary text-white" style="background-color:#FE3810; border:0;" href="{{route('login')}}">Login</a>
                  </li>
                @endguest
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>

		@yield('content')


		<footer id="colorlib-footer" role="contentinfo">
			<div class="container">
				<div class="row row-pb-md">
					<!-- Our Store -->
					<div class="col footer-col colorlib-widget">
						<h4>Our Store</h4>
						<p>OPEN EVERYDAY<br>11:00 WIB – 20:00 WIB</p>
						<p>
							Jl. KH. Ahmad Dahlan Kby. No.30, RT.3/RW.3, Kramat Pela,<br>
							Kec. Kby. Baru, Kota Jakarta Selatan, DKI Jakarta 12130
						</p>
						<ul class="colorlib-footer-links">
							<li><a href="mailto:support@boomboom.id">support@boomboom.id</a></li>
							<li><a href="tel:+628119292596">+62 811 9292 596</a></li>
						</ul>
					</div>

					<!-- Shop -->
					<div class="col footer-col colorlib-widget">
						<h4>Shop</h4>
						<ul class="colorlib-footer-links">
							<li><a href="#">Catalog</a></li>
							<li><a href="#">Sizing Chart</a></li>
							<li><a href="#">Term & Conditions</a></li>
						</ul>
					</div>

					<!-- Support -->
					<div class="col footer-col colorlib-widget">
						<h4>Support</h4>
						<ul class="colorlib-footer-links">
							<li><a href="#">Help</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="#">Order Tracking</a></li>
						</ul>
					</div>

					<!-- Join our list -->
					<div class="col footer-col colorlib-widget">
						<h4>Join our list</h4>
						<p>Signup to be the first to hear about exclusive deals, special offers and upcoming collections</p>
						<form class="form-inline" action="#" method="post">
							<div class="form-group">
								<input type="email" class="form-control" placeholder="Your email address">
								<button type="submit" class="btn btn-primary">Subscribe</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="copy">
				<div class="row">
					<div class="col-sm-12 text-center">
						<p>
							<span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span> 
							<span class="block">Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a> , <a href="http://pexels.com/" target="_blank">Pexels.com</a></span>
						</p>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="{{ asset('assets_customer/js/jquery.min.js') }}"></script>
   <!-- popper -->
   <script src="{{ asset('assets_customer/js/popper.min.js') }}"></script>
   <!-- bootstrap 4.1 -->
   <script src="{{ asset('assets_customer/js/bootstrap.min.js') }}"></script>
   <!-- jQuery easing -->
   <script src="{{ asset('assets_customer/js/jquery.easing.1.3.js') }}"></script>
	<!-- Waypoints -->
	<script src="{{ asset('assets_customer/js/jquery.waypoints.min.js') }}"></script>
	<!-- Flexslider -->
	<script src="{{ asset('assets_customer/js/jquery.flexslider-min.js') }}"></script>
	<!-- Owl carousel -->
	<script src="{{ asset('assets_customer/js/owl.carousel.min.js') }}"></script>
	<!-- Magnific Popup -->
	<script src="{{ asset('assets_customer/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('assets_customer/js/magnific-popup-options.js') }}"></script>
	<!-- Date Picker -->
	<script src="{{ asset('assets_customer/js/bootstrap-datepicker.js') }}"></script>
	<!-- Stellar Parallax -->
	<script src="{{ asset('assets_customer/js/jquery.stellar.min.js') }}"></script>
	<!-- Main -->
	<script src="{{ asset('assets_customer/js/main.js') }}"></script>
  @yield('scripts')
	</body>
</html>

