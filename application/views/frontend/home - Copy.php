<?php 
  $this->load->view('frontend/_includes/header');
  $this->load->helper('custom');

?>
<style type="text/css">
body {
	font-family: "Open Sans", sans-serif;
}
h2 {
	color: #333;
	text-align: center;
	text-transform: uppercase;
	font-family: "Roboto", sans-serif;
	font-weight: bold;
	position: relative;
	margin: 30px 0 60px;
}
h2::after {
	content: "";
	width: 100px;
	position: absolute;
	margin: 0 auto;
	height: 3px;
	background: #8fbc54;
	left: 0;
	right: 0;
	bottom: -10px;
}
.col-center {
	margin: 0 auto;
	float: none !important;
}
.carousel {
	margin: 50px auto;
	padding: 0 70px;
}
.carousel .item {
	color: #999;
	font-size: 14px;
    text-align: center;
	overflow: hidden;
    min-height: 290px;
}
.carousel .item .img-box {
	width: 135px;
	height: 135px;
	margin: 0 auto;
	padding: 5px;
	border: 1px solid #ddd;
	border-radius: 50%;
}
.carousel .img-box img {
	width: 100%;
	height: 100%;
	display: block;
	border-radius: 50%;
}
.carousel .testimonial {
	padding: 30px 0 10px;
}
.carousel .overview {	
	font-style: italic;
}
.carousel .overview b {
	text-transform: uppercase;
	color: #7AA641;
}
.carousel .carousel-control {
	width: 40px;
    height: 40px;
    margin-top: -20px;
    top: 50%;
	background: none;
}
.carousel-control i {
    font-size: 68px;
	line-height: 42px;
    position: absolute;
    display: inline-block;
	color: rgba(0, 0, 0, 0.8);
    text-shadow: 0 3px 3px #e6e6e6, 0 0 0 #000;
}
.carousel .carousel-indicators {
	bottom: -40px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 10px;
	height: 10px;
	margin: 1px 3px;
	border-radius: 50%;
}
.carousel-indicators li {	
	background: #999;
	border-color: transparent;
	box-shadow: inset 0 2px 1px rgba(0,0,0,0.2);
}
.carousel-indicators li.active {	
	background: #555;		
	box-shadow: inset 0 2px 1px rgba(0,0,0,0.2);
}
@media only screen and (max-width: 420px) {
 
.videoclass{
	width:330px !important;
}
.formd{
    margin-left: 0%!important ;
   
}
.hidden-blog{
	display:none;
}

}
.formd{
    margin-left: 22%;
    margin-top: 4%;
}
.videoclass{
    width: 1170px;
}
</style>
  <!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1 item1-slick1" style="background-image: url(<?php echo assets_path; ?>img/wp2356158.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
							 
						</span>

						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
							 
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="<?php echo base_url('products'); ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item2-slick1" style="background-image: url(<?php echo assets_path; ?>img/bodybuilding.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">
							 
						</span>

						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">
							 
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<!-- Button -->
							<a href="<?php echo base_url('products'); ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>	 
			</div>
		</div>
	</section>

	<!-- Banner -->
	
	<!-- New Product -->
	<section class="newproduct bgwhite p-t-45  ">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Featured Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
								<img src="<?php echo assets_path; ?>img/slider1.jpeg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="<?php echo base_url('product-details'); ?>" class="block2-name dis-block s-text3 p-b-5">
									Whey Protein
								</a>

								<span class="block2-price m-text6 p-r-5">
									Rs 750.00
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="<?php echo assets_path; ?>img/slider1.jpeg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="<?php echo base_url('product-details'); ?>" class="block2-name dis-block s-text3 p-b-5">
									Mass Gainer
								</a>

								<span class="block2-price m-text6 p-r-5">
									Rs 920.50
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="<?php echo assets_path; ?>img/MYFUEL2.jpeg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="<?php echo base_url('product-details'); ?>" class="block2-name dis-block s-text3 p-b-5">
									Plant Based Protein
								</a>

								<span class="block2-price m-text6 p-r-5">
									Rs 1650.90
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
								<img src="<?php echo assets_path; ?>img/MYFUEL3.jpeg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="<?php echo base_url('product-details'); ?>" class="block2-name dis-block s-text3 p-b-5">
									Protein Bars
								</a>

								<span class="block2-oldprice m-text7 p-r-5">
									Rs 290.50
								</span>

								<span class="block2-newprice m-text8 p-r-5">
									Rs 150.90
								</span>
							</div>
						</div>
					</div>

					 <div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
								<img src="<?php echo assets_path; ?>img/slider1.jpeg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="<?php echo base_url('product-details'); ?>" class="block2-name dis-block s-text3 p-b-5">
									Casein Protein
								</a>

								<span class="block2-oldprice m-text7 p-r-5">
									Rs 290.50
								</span>

								<span class="block2-newprice m-text8 p-r-5">
									Rs 150.90
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

	<!-- Banner2 -->
	<section class="banner2 bg5 p-t-55  ">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
					<div class="hov-img-zoom pos-relative">
						<img src="<?php echo assets_path; ?>img/img2.jpg" alt="IMG-BANNER">

						<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15" style="    margin-left: -25%;margin-top: 17%;">
							<div class="w-size2 p-t-20" style="margin-bottom: 15%;">
						<!-- Button -->
						<button style="border-radius: 12px;" class="flex-c-m size2 bg44 bo-rad-23 hov1 m-text3 trans-0-4" style="    margin-left: 32%;">
							LEARN MORE
						</button>
					</div> 
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15" >
					<div class="hov-img-zoom pos-relative">
						<img src="<?php echo assets_path; ?>img/img1.jpg" alt="IMG-BANNER">

						<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15" >
							<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15" style="    margin-left: -25%;margin-top: 17%;">
							<div class="w-size2 p-t-20" style="margin-bottom: 15%;">
						<!-- Button -->
						<button style="border-radius: 12px;" class="flex-c-m size2 bg44 bo-rad-23 hov1 m-text3 trans-0-4" style="    margin-left: 32%;">
							LEARN MORE
						</button>
					</div> 
						</div> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- video--> 
	<section class="banner2 bg5 p-t-55 p-b-55">
		<div class="container">
		<div class="sec-title p-b-52">
				<h3 class="m-text5 t-center">
					- Videos -
				</h3>
			</div>
			<div class="row ">
			<div class="col-md-12 ">
			 
			<video class="videoclass"   controls>
			  <source src="<?php echo assets_path; ?>img/sattva15_preview.mp4" type="video/mp4">
			  <source src="mov_bbb.ogg" type="video/ogg">
			  Your browser does not support HTML5 video.
			</video>
 
			</div>
			</div>
		</div>
	</section>
	
	<section class="banner2 bg5 ">
		<div class="container">
		 
			<div class="row">
				<div class="col-md-2 hidden-blog"> 
				<a href="#"><image src="<?php echo assets_path; ?>img/altimg1.jpg" style="width: 150px;border: 1px solid;" alt="img">
				</a></div> 
				<div class="col-md-2 hidden-blog"> 
				<a href="#"><image src="<?php echo assets_path; ?>img/gym_workout_getty.jpg" style="width: 161px;border: 1px solid;" alt="img">
				</a></div> 
				<div class="col-md-2 hidden-blog"> 
				<a href="#"><image src="<?php echo assets_path; ?>img/altimg1.jpg" style="width: 150px;border: 1px solid;" alt="img">
				</a></div> 
				<div class="col-md-2 hidden-blog"> 
				<a href="#"><image src="<?php echo assets_path; ?>img/gym_workout_getty.jpg" style="width: 161px;border: 1px solid;" alt="img">
				</a></div> 
				<div class="col-md-2 hidden-blog"> 
				<a href="#"><image src="<?php echo assets_path; ?>img/altimg1.jpg" style="width: 150px;border: 1px solid;" alt="img">
				</a></div> 
				<div class="col-md-2"> 
				<button style="border-radius: 12px;margin-top: 23%;" class="flex-c-m size2 bg44 bo-rad-23 hov1 m-text3 trans-0-4" style="    margin-left: 32%;">
				 MORE VIDEOS
				</button>
				</div> 
				
			</div>
		</div>
	</section>
	<!-- Blog -->
	
	<section class="banner2 bg5 p-t-55  ">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
					<div class="hov-img-zoom pos-relative">
						<img src="<?php echo assets_path; ?>img/supportus_becomeapartner.jpg" style="height:420px" alt="IMG-BANNER">

						 
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
					<div class="bgwhite hov-img-zoom pos-relative p-b-20per-ssm"  style="border: 1px solid silver;">
						 <form>
						 <br>
						 <br>
						 <br>
						 <h3 class="text-center" style="color:#843b62">BECOME A PATNER</h3>
						 <div class="col-md-7 formd" >
					<div class="  w-size9 text-center">
					<br>
						<div class="form-group">
						<input style="border: 1px solid #989898 !important;" class="form-control" type="text" name="email" placeholder=" Enter Your Name">
						</div> 
						<div class="form-group">
						<input style="border: 1px solid #989898 !important;" class="form-control" type="text" name="email" placeholder="Enter Your Contact Details ">
						</div>
						<div class="form-group">
						<input style="border: 1px solid #989898 !important;" class="form-control" type="text" name="email" placeholder="Enter Your Email Id ">
					  </div>
					</div>

					<div class="w-size2 p-t-20" style="margin-bottom: 15%;">
						<!-- Button -->
						<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4" style="    margin-left: 32%;">
							Submit
						</button>
					</div>
					</div>

				</form>
						 
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="banner2 bg5 p-t-55 p-b-55">
		<div class="container">
		<div class="sec-title p-b-52">
				<h3 class="m-text5 t-center">
					- Blog -
				</h3>
			</div>
			<div class="row">
				<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
					<div class="hov-img-zoom pos-relative">
						<img src="<?php echo assets_path; ?>img/food.jpg" alt="IMG-BANNER">

						<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15">
							<span class="m-text9 p-t-45 fs-20-sm">
								Cheesecake Banana Bread
							</span>
 

							<a href="#" class="s-text4 hov2 p-t-20 " style="font-weight: 600;">
								Make post-workout meals even sweeter <br>with our quick-and-easy recipe
							</a>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
					<div class="bgwhite hov-img-zoom pos-relative p-b-20per-ssm">
						<img src="<?php echo assets_path; ?>img/Untitled_design-091514.png" alt="IMG-BANNER">

						<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15">
							<span class="m-text9 p-t-45 fs-20-sm">
								Outdoor HIIT Workout
							</span>
 

							<a href="#" class="s-text4 hov2 p-t-20 " style="font-weight: 600;">
								Try These 10 minute HIIT Workout you <br>can try anytime, any day at any place
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="banner2 bg5 ">
		<div class="container">
			<div class="row">
				<div class="col-md-2 hidden-blog"> 
				<a href="#"><image src="<?php echo assets_path; ?>img/altimg1.jpg" style="width: 150px;border: 1px solid;" alt="img">
				</a></div> 
				<div class="col-md-2 hidden-blog"> 
				<a href="#"><image src="<?php echo assets_path; ?>img/gym_workout_getty.jpg" style="width: 161px;border: 1px solid;" alt="img">
				</a></div> 
				<div class="col-md-2 hidden-blog"> 
				<a href="#"><image src="<?php echo assets_path; ?>img/altimg1.jpg" style="width: 150px;border: 1px solid;" alt="img">
				</a></div> 
				<div class="col-md-2 hidden-blog"> 
				<a href="#"><image src="<?php echo assets_path; ?>img/gym_workout_getty.jpg" style="width: 161px;border: 1px solid;" alt="img">
				</a></div> 
				<div class="col-md-2 hidden-blog"> 
				<a href="#"><image src="<?php echo assets_path; ?>img/altimg1.jpg" style="width: 150px;border: 1px solid;" alt="img">
				</a></div> 
				<div class="col-md-2"> 
				<button style="border-radius: 12px;margin-top: 23%;" class="flex-c-m size2 bg44 bo-rad-23 hov1 m-text3 trans-0-4" style="    margin-left: 32%;">
				 MORE BLOG
				</button>
				</div> 
			</div>
		</div>
	</section>
	
	<section class="blog bgwhite p-t-94 p-b-65">
		<div class="container">
			<div class="sec-title  ">
				<h3 class="m-text5 t-center">
					- Testimonials -
				</h3>
			</div>

			<div class=" ">
				<div class="col-md-12 col-center m-auto">
			 
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Carousel indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>   
				<!-- Wrapper for carousel items -->
				<div class="carousel-inner">
					<div class="item carousel-item active">
						<div class="img-box"><img src="<?php echo assets_path; ?>img/user.png" alt=""></div>
						<p class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Idac bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet.</p>
						<p class="overview"><b>Paula Wilson</b>, Media Analyst</p>
					</div>
					<div class="item carousel-item">
						<div class="img-box"><img src="<?php echo assets_path; ?>img/user.png" alt=""></div>
						<p class="testimonial">Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget nisi a mi suscipit tincidunt. Utmtc tempus dictum risus. Pellentesque viverra sagittis quam at mattis. Suspendisse potenti. Aliquam sit amet gravida nibh, facilisis gravida odio.</p>
						<p class="overview"><b>Antonio Moreno</b>, Web Developer</p>
					</div>
					<div class="item carousel-item">
						<div class="img-box"><img src="<?php echo assets_path; ?>img/user.png" alt=""></div>
						<p class="testimonial">Phasellus vitae suscipit justo. Mauris pharetra feugiat ante id lacinia. Etiam faucibus mauris id tempor egestas. Duis luctus turpis at accumsan tincidunt. Phasellus risus risus, volutpat vel tellus ac, tincidunt fringilla massa. Etiam hendrerit dolor eget rutrum.</p>
						<p class="overview"><b>Michael Holz</b>, Seo Analyst</p>
					</div>
				</div>
				<!-- Carousel controls -->
				<a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</div> 

		</div>
		</div>
	</section>

	
<?php 
	$this->load->view('frontend/_includes/footer');
?>
