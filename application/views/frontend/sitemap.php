<?php 
	$this->load->view('frontend/_includes/header');
?>
<style>
 
	 
	h3 {
		margin: auto;
		padding: 10px;
		max-width: 600px;
		color: #666;
	}

	h3 span {
		float: right;
	}

	h3 a {
		font-weight: normal;
		display: block;
	}

	a:hover {
		color: #666;
	}


	#footer {
		padding: 10px;
		text-align: center;
	}

	ul {
    	margin: 0px;

    	padding: 0px;
    	list-style: none;
	}
	li {
		margin: 0px;
	}
	li ul {
		margin-left: 20px;
	}

	.lhead {
		background: #ddd;
		padding: 10px;
    	margin: 10px 0px;
	}

	.lcount {
		padding: 0px 10px;
	}

	.lpage {
		border-bottom: #ddd 1px solid;
		padding: 5px;
	}
	.last-page {
		border: none;
	}
@media (max-width: 1200px) {
	.container {
		max-width: 95%;
	}
}	
</style>

    <!--================Header Menu Area =================-->

   <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/myFuelO2.png);">
		<!--<h2 class="l-text2 t-center">
			Sitemap
		</h2>-->
	</section>
	
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
			Sitemap
		</span>
	</div>

	<!-- content page -->
	<section class="bgwhite p-b-60 abt-bck" >
		<div class="container">
			<div class="row">
			<div class="col-md-12" >
			
				<h2 class="m-text5 t-center">
					Sitemap
				</h2>
				<hr>
				<div class="row">
				<div class="col-sm-12 col-md-1 col-lg-1">
					<div class="leftbar p-r-20 p-r-0-sm">
						
					</div>
				</div>

				<div class="col-sm-12 col-md-10 col-lg-10 " >
	 
		<ul class="level-0">

            
<li class="lpage"><a href="http://myfuel.co.in/" title="MyFuel | Home">MyFuel | Home</a></li>
<li class="lpage"><a href="http://myfuel.co.in/products" title="http://myfuel.co.in/products">MyFuel | Products</a></li>
<li class="lpage"><a href="http://myfuel.co.in/authenticate" title="MyFuel | Authenticate">MyFuel | Authenticate</a></li>
<li class="lpage"><a href="http://myfuel.co.in/blogs" title="MyFuel | Blogs">MyFuel | Blogs</a></li>
<li class="lpage"><a href="http://myfuel.co.in/contact-us" title="MyFuel | Contact Us">MyFuel | Contact Us</a></li>
<li class="lpage"><a href="http://myfuel.co.in/about-us" title="MyFuel | About">MyFuel | About</a></li>
<li class="lpage"><a href="http://myfuel.co.in/login" title="MyFuel | Login">MyFuel | Login</a></li>
<li class="lpage"><a href="http://myfuel.co.in/registration" title="MyFuel | Registration">MyFuel | Registration</a></li>
<li class="lpage"><a href="http://myfuel.co.in/cart" title="MyFuel | My Cart">MyFuel | My Cart</a></li>
<li class="lpage"><a href="http://myfuel.co.in/checkout" title="MyFuel | Check Out">MyFuel | Check Out</a></li>
<li class="lpage"><a href="http://myfuel.co.in/videos" title="http://myfuel.co.in/videos">MyFuel | Videos</a></li>
<li class="lpage"><a href="http://myfuel.co.in/help" title="MyFuel | Help">MyFuel | Help</a></li>
<li class="lpage"><a href="http://myfuel.co.in/sitemap" title="MyFuel | Sitemap">MyFuel | Sitemap</a></li>
<li class="lpage"><a href="http://myfuel.co.in/privacy-policy" title="MyFuel | Privacy Policy">MyFuel | Privacy Policy</a></li>
<li class="lpage"><a href="http://myfuel.co.in/terms-conditions" title="MyFuel | Terms &amp; Conditions">MyFuel | Terms & Conditions</a></li>
<li class="lpage last-page"><a href="http://myfuel.co.in/forgot_password" title="Reset Password">Reset Password</a></li>
<li>
<ul class="level-1">
	<li><ul class="level-2">
	<li class="lhead">Blog-Details</li>
	<li class=" "><a href="http://myfuel.co.in/frontend/blog_details/3" title="MyFuel | Blogs">MyFuel | Blogs</a></li>
	</ul>
	<ul class="level-2">

<li class="lhead">Products</li>
<li class="lpage last-page"><a href="http://myfuel.co.in/frontend/filter_products/3/0/1/0" title="Protein">Protein</a></li>
             
<li class="lpage last-page"><a href="http://myfuel.co.in/frontend/filter_products/4/0/1/0" title="Strength &amp; Endurance">Strength & Endurance</a></li>
 
<li class="lpage last-page"><a href="http://myfuel.co.in/frontend/filter_products/5/0/1/0" title="Health">Health</a></li>

<li class="lhead">Product-Details</li>
            
<li class=" "><a href="http://myfuel.co.in/product-details/4" title="Product Details">Product Details</a></li>

</ul></li>
</ul>

	</div>
	</div>
			</div>
			</div>
		</div>
	
	</section>
	
<?php 
	$this->load->view('frontend/_includes/footer');
?>