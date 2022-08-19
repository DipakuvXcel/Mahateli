<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="<?php echo assets_path; ?>images/favicon.png" type="image/png" />
  <title><?= $page_title; ?></title>
  <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo assets_path; ?>vendor/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>fonts/themify/themify-icons.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>fonts/elegant-font/html-css/style.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>vendor/animate/animate.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>vendor/css-hamburgers/hamburgers.min.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>vendor/animsition/css/animsition.min.css" />
	<!--<link rel="stylesheet" href="<?php echo assets_path; ?>vendor/select2/select2.min.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>vendor/daterangepicker/daterangepicker.css" />-->
	<link rel="stylesheet" href="<?php echo assets_path; ?>vendor/noui/nouislider.min.css">
	<link rel="stylesheet" href="<?php echo assets_path; ?>vendor/slick/slick.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>vendor/lightbox2/css/lightbox.min.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>css/util.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>css/main.css" />

</head>
<style>
.back_color:hover {
	color:#e65540;
}
.hamburger {
	padding: 0px 15px !important;
}
.hamburger-inner, .hamburger-inner:after, .hamburger-inner:before {
	background-color: #ecf0f1;
}
/* .header-icons{
	right: 120px;
} */

@media screen and (max-width: 600px) {
	.sub_menu {
		width: 100%;
		height: auto;
	}
}
</style>

<body>

	<!-- Header -->
	<header class="header1 fixed-header">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="topbar">
				<!--<div class="topbar-social" >
                    <a class="stores-link" href="#" title="Locate Stores">
						<a href="findStroreModal"    data-toggle="modal" data-target="#findStroreModal">
						<i class="fa fa-map-marker" aria-hidden="true"></i><span>  Find a Store</span></a>
                    </a>
                </div> 

				<span class="topbar-child1">
					Lorem ipsum sit amet, consectetur adipiscing elit aliqua. 	  	
				</span>

				<div class="topbar-child2">
					<span class="topbar-child1">
						<a href="mailto:care@myfuel.co.in" > care@myfuel.co.in </a>/  	
					</span>&nbsp;
					<span class="topbar-child1">
						<a href="tel:9999999999" > +91 9999999999 </a> 	  	
					</span>
				 
				</div>-->
			</div>
			
			<!-- 2nd top banner -->
			<div class="wrap_header" style="z-index: -1;">
				<!-- Logo -->
				<a href="<?php echo base_url(''); ?>" class="logo">
					<img style="max-height: 65px;" src="<?php echo assets_path; ?>img/logo.png" class=" header-icon1" alt="ICON">
				</a>
				    <?php  $cat_id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;?>
					<?php  $scat_id = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;?>
					<?php  $fev_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;?>
					<?php  $page_no = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;?>
				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li class="<?= $active =='home'?'active':''; ?>" >
								<a href="<?php echo base_url(); ?>">Home</a>
							</li>
							
							<li class="<?= $active =='about'?'active':''; ?>">
								<a href="<?php echo base_url('about-us'); ?>">About Us</a>
							</li>

							<!--<li class="<?= $active =='services'?'active':''; ?>">
								<a href="<?php echo base_url('services'); ?>">Services</a>
							</li>-->

							<li class="<?= $active =='shop'?'active':''; ?>">
							  <a href="<?php echo base_url('products'); ?>">Products</a>
							   
								<ul class="sub_menu" style="display:block;width: 560px;background-color: rgba(0, 0, 0,0.9);box-shadow: 0 3px 15px -5px black;left: -175px;border: 1px solid rgba(255, 255, 255, 0.72);">
								  <div class="row">
								   <?php
									$queryec = $this->db->query('SELECT * FROM product_category WHERE status_id=1');
									$catarr= $queryec->result();
									$catid = 0;
									for($i=0;$i<count($catarr);$i++){ 
									$catid = $catarr[$i]->id;
									?>
								    <div class="<?php if($i==0){ echo 'col-md-3 col-sm-3 col-xs-12 p-r-0 m-l-25'; } else if($i==1){ echo'col-md-4 col-sm-4 col-xs-12 p-l-0 p-r-0'; } else { echo'col-md-4 col-sm-4 col-xs-12 p-l-0'; } ?>">
									<li style="font-size: large;">
									<a href="<?= base_url('frontend/products/'.$catid); ?>" class="back_color" style="font-size: 13px;"><b><?php echo $catarr[$i]->name; ?></b></a>
									</li>
									<hr style="margin:0px;border-top: 1px solid rgba(255, 255, 255, 0.26);">
									 <?php 
										$querys = $this->db->query('SELECT * FROM product_subcategory WHERE product_cat_id = '.$catid.' AND status_id=1');
										$subcatarr= $querys->result();
										$subcatid = 0;
										for($si=0;$si<count($subcatarr);$si++){
										$subcatid = $subcatarr[$si]->id;
										?>
									<li style="padding-bottom: 1px;"><a href="<?= base_url('frontend/filter_products/'.$catid.'/'.$subcatid.'/0/'.$page_no); ?>" class="back_color"><?php echo $subcatarr[$si]->name; ?></a></li>
									<?php } ?>
							        </div>
									<?php } ?>
									<!--<div class="col-md-4 col-sm-2 col-xs-1">
									<li style="font-size: large; ">
									<a href="index.html" class="back_color" style="font-size: 16px;"><b>Strength and Endurance</b></a>
									</li>
								    <li><a href="index.html" class="back_color">Creatine</a></li>
									<li><a href="home-02.html" class="back_color">Amino Acid</a></li>
									<li><a href="home-03.html" class="back_color">Pre Workout</a></li>
							        </div>
									<div class="col-md-4 col-sm-2 col-xs-1">
									<li style="font-size: large;">
									<a href="index.html" class="back_color" style="font-size: 16px;"><b>Health</b></a>
									</li>
								    <li><a href="index.html" class="back_color">Weight Management</a></li>
									<li><a href="home-02.html" class="back_color">Multivitatmin</a></li>
									<li><a href="home-03.html" class="back_color">Speciality Products</a></li>
							        </div>-->
									</div>
								</ul>

							</li>
							
							<li class="<?= $active =='authenticate'?'active':''; ?>">
								<a href="<?php echo base_url('authenticate'); ?>">Authenticate</a>
							</li>
							
							<li class="<?= $active =='blogs'?'active':''; ?>">
								<a href="<?php echo base_url('blogs'); ?>">Blogs</a>
							</li>
							
							<li class="<?= $active =='contact'?'active':''; ?>">
								<a href="<?php echo base_url('contact-us'); ?>">Enquiry</a>
							</li>
							
							<li style="background: #ef9b12; padding: 3px 5px;" class="<?= $active =='offers'?'active':''; ?>">
								<a href="<?php echo base_url('offers'); ?>">Offers</a>
							</li>

						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="topbar-child2">
					<div class="header-icons">
						<!--a href="<?php echo base_url('frontend/profile'); ?>" class="header-wrapicon1 dis-block">
							<img src="<?php echo assets_path; ?>images/icons/icon-header-01.png" class="header-icon1 header-icon1 js-show-header-dropdown" alt="ICON">
						</a-->
						<div class="header-wrapicon2">
						<img src="<?php echo assets_path; ?>images/icons/icon-header-01.png" class="header-icon1 header-icon1 js-show-header-dropdown" alt="ICON">

							<!-- Header cart noti -->
							<?php if($this->session->userdata('user_profile')!=''){ ?>
								<div class="header-cart header-dropdown" style="width: 165px;">
									<ul class="header-cart-wrapitem">
										<li class="header-cart-item" style="border-bottom: 1px solid #f2f2f2;">
											<a href="<?php echo base_url('profile'); ?>" class="header-cart-item-name"> 
												<i class="fa fa-user"></i>
												My Profile
											</a>
										</li>
										<li class="header-cart-item"  style="border-bottom: 1px solid #f2f2f2;">
											<a href="<?php echo base_url('my-orders'); ?>" class="header-cart-item-name"> 
												<i class="fa fa-shopping-bag"></i>
												My Orders
											</a>
										</li>
										<li class="header-cart-item"  style="border-bottom: 1px solid #f2f2f2;">
											<a href="<?php echo base_url('frontend/logout'); ?>" class="header-cart-item-name">
												<i class="fa fa-sign-out"></i>
												Log Out
											</a>
										</li>
									</ul>
								</div>
							<?php } else {?>
							
								<div class="header-cart header-dropdown" style="width: 165px;">
									<ul class="header-cart-wrapitem">	
										<li class="header-cart-item" style="border-bottom: 1px solid #f2f2f2;">
											<a href="<?php echo base_url('login'); ?>" class="header-cart-item-name"> 
												Log In
											</a>
										</li>
										<li class="header-cart-item" style="border-bottom: 1px solid #f2f2f2;">
											<a href="<?php echo base_url('registration'); ?>" class="header-cart-item-name"> 
												Registation
											</a>
										</li>	
										<!--<li class="header-cart-item" style="border-bottom: 1px solid #f2f2f2;">
											 <div class=" ">
												<a href="#" class="header-cart-item-name" > Feedback </a>
												</div>
										</li>-->
									</ul>
								</div>
							<?php } ?>
							
						</div>
						<span class="linedivide1"></span>

						<div class="header-wrapicon2" >
						<?php 
						if($this->session->userdata('user_profile') !='')
						{
							$this->db->where('user_id', $_SESSION['user_profile']->id);
						}else if(isset($_SESSION['session_id'])){
							$this->db->where('session_id', $_SESSION['session_id']);
						}else{
							$this->db->where('session_id', 0);
						}
							$tbl_cart_list = $this->db->get('tbl_cart'); 
							$tbl_cart_list1 = $tbl_cart_list->result();
						?>
							<img src="<?php echo assets_path; ?>images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
							<span class="header-icons-noti" id="head_cart_cnt"><?php echo count($tbl_cart_list1);?></span>

							<!-- Header cart noti -->
							
							<div class="header-cart header-dropdown" id="head_cart_refresh">
							<?php if(count($tbl_cart_list1)>0){ ?>
								<ul class="header-cart-wrapitem" >
								<?php 
								$total_price_head=0;
								for($k=0;$k<count($tbl_cart_list1);$k++){
									$total_price_head+=$tbl_cart_list1[$k]->price*$tbl_cart_list1[$k]->quantity;
								?>
									<li class="header-cart-item">
										<div class="p-r-20">
											<a href="<?php echo base_url('product-details/'.$tbl_cart_list1[$k]->product_id); ?>" > <img style="height: 70px; width: 80px;" src="<?= upload_path.'product_profile/'.$tbl_cart_list1[$k]->image?>" alt="IMG"> </a>
										</div>

										<div class="header-cart-item-txt">
											<a href="<?php echo base_url('product-details/'.$tbl_cart_list1[$k]->product_id); ?>" class="header-cart-item-name">
												<?=$tbl_cart_list1[$k]->product_name?>
											</a>

											<span class="header-cart-item-info">
												<?=$tbl_cart_list1[$k]->price?> x <?=$tbl_cart_list1[$k]->quantity?>
											</span>
										</div>
									</li>
								<?php } ?>

									 </ul>

								<div class="header-cart-total">
									Total: <?=$total_price_head?>
								</div>

								<div class="header-cart-buttons">
									<div class="header-cart-wrapbtn">
										<!-- Button -->
										<a href="<?php echo base_url('cart'); ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
											View Cart
										</a>
									</div>

									<div class="header-cart-wrapbtn">
										<!-- Button -->
										<a href="<?php echo base_url('checkout'); ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
											Check Out
										</a>
									</div>
								</div><?php } else{ ?>
								<div class=" ">
										<!-- Button -->
									  <a style=" " class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" href="<?php echo base_url('products'); ?>">Continue Shopping</a>
									</div>
								<?php } ?>

							</div>
							
						</div>
					</div>
				</div>
				
				<!--<div class="header-icons" style="right: 5%;top: 61%;">
					<div class="form-group">	 
					<i style="color:#fff;" class="fa fa-search"></i>
					</div>
				</div> -->
				
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="<?php echo base_url(''); ?>" class="logo-mobile">
				<img style="max-height: 45px;" src="<?php echo assets_path; ?>img/logo.png" class=" header-icon1 js-show-header-dropdown" alt="ICON">
				
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<div class="header-wrapicon2">
					<img src="<?php echo assets_path; ?>images/icons/icon-header-01.png" class="header-icon1 header-icon1 js-show-header-dropdown" alt="ICON">

						<!-- Header cart noti -->
						<?php if($this->session->userdata('user_profile')!=''){ ?>
							<div class="header-cart header-dropdown" style="width: 165px;">
								<ul class="header-cart-wrapitem">
									<li class="header-cart-item" style="border-bottom: 1px solid #f2f2f2;">
										<a href="<?php echo base_url('profile'); ?>" class="header-cart-item-name"> 
											<i class="fa fa-user"></i>
											My Profile
										</a>
									</li>
									<li class="header-cart-item"  style="border-bottom: 1px solid #f2f2f2;">
										<a href="<?php echo base_url('my-orders'); ?>" class="header-cart-item-name"> 
											<i class="fa fa-shopping-bag"></i>
											My Order
										</a>
									</li>
									<li class="header-cart-item"  style="border-bottom: 1px solid #f2f2f2;">
										<a href="<?php echo base_url('frontend/logout'); ?>" class="header-cart-item-name">
											<i class="fa fa-sign-out"></i>
											Log Out
										</a>
									</li>
								</ul>
							</div>
							
						<?php } else {?>
						
							<div class="header-cart header-dropdown" style="width: 165px;">
								<ul class="header-cart-wrapitem">	
									<li class="header-cart-item" style="border-bottom: 1px solid #f2f2f2;">
										<a href="<?php echo base_url('login'); ?>" class="header-cart-item-name"> 
											Log In
										</a>
									</li>
									<li class="header-cart-item" style="border-bottom: 1px solid #f2f2f2;">
										<a href="<?php echo base_url('registration'); ?>" class="header-cart-item-name"> 
											Registation
										</a>
									</li>	
									<!--<li class="header-cart-item" style="border-bottom: 1px solid #f2f2f2;">
										 <div class=" ">
											<a href="#" class="header-cart-item-name" > Feedback </a>
											</div>
									</li>-->
								</ul>
							</div>
						<?php } ?>
						
					</div>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2" >
						 <img src="<?php echo assets_path; ?>images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti" id="head_cart_cnt_mob"><?php echo count($tbl_cart_list1);?></span>
					
						<!-- Header cart noti -->
						<div class="header-cart header-dropdown" id="head_cart_refresh_mob">
							<ul class="header-cart-wrapitem">
							<?php 
							$total_price_head=0;
							for($k=0;$k<count($tbl_cart_list1);$k++){
								$total_price_head+=$tbl_cart_list1[$k]->price;
							?><li class="header-cart-item">
									<div class="p-r-20">
										<a href="<?php echo base_url('product-details/'.$tbl_cart_list1[$k]->product_id); ?>" > <img style="height: 70px; width: 80px;" src="<?= upload_path.'product_profile/'.$tbl_cart_list1[$k]->image?>" alt="IMG"> </a>
									</div>

									<div class="header-cart-item-txt">
										<a href="<?php echo base_url('product-details/'.$tbl_cart_list1[$k]->product_id); ?>" class="header-cart-item-name">
											<?=$tbl_cart_list1[$k]->product_name?>
										</a>

										<span class="header-cart-item-info">
											<?=$tbl_cart_list1[$k]->price?>
										</span>
									</div>
								</li>
							<?php } ?>
								 
							</ul>

							<div class="header-cart-total">
								Total: <?=$total_price_head?>
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="<?php echo base_url('cart'); ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>
								

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="<?php echo base_url('checkout'); ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					 
					<li class="item-menu-mobile">
						<a href="<?php echo base_url(''); ?>">Home</a>
					</li>
					
					<li class="item-menu-mobile">
						<a href="<?php echo base_url('about-us'); ?>">About Us</a>
					</li>

					<!--<li class="item-menu-mobile">
						<a href="<?php echo base_url('services'); ?>">Services</a>
					</li>-->

					<li class="item-menu-mobile">
						<a href="<?php echo base_url('products'); ?>">Products</a>
					     <ul class="sub-menu">
							 <div class="row" style="color:black;">
								   <?php
									$queryec = $this->db->query('SELECT * FROM product_category WHERE status_id=1');
									$catarr= $queryec->result();
									$catid = 0;
									for($i=0;$i<count($catarr);$i++){ 
									$catid = $catarr[$i]->id;
									?>
								    <div class="col-md-12">
									<li style="font-size: large;">
									<a href="<?= base_url('frontend/products/'.$catid); ?>" class="back_color" style="font-size: 13px;"><b><?php echo $catarr[$i]->name; ?></b></a>
									</li>
									<ul class="sub-menu1" style="display: none !important;">
									<hr style="margin:0px;">
									 <?php 
										$querys = $this->db->query('SELECT * FROM product_subcategory WHERE product_cat_id = '.$catid.' AND status_id=1');
										$subcatarr= $querys->result();
										$subcatid = 0;
										for($si=0;$si<count($subcatarr);$si++){
										$subcatid = $subcatarr[$si]->id;
										?>
									<li style="padding-bottom: 1px;"><a href="<?= base_url('frontend/filter_products/'.$catid.'/'.$subcatid.'/0/'.$page_no); ?>" class="back_color"><?php echo $subcatarr[$si]->name; ?></a></li>
									<?php } ?>
									</ul>
									<i class="arrow-main-menu1 fa fa-angle-right" aria-hidden="true"></i>  
							        </div>
									<?php } ?>
									<!--<div class="col-md-4 col-sm-2 col-xs-1">
									<li style="font-size: large; ">
									<a href="index.html" class="back_color" style="font-size: 16px;"><b>Strength and Endurance</b></a>
									</li>
								    <li><a href="index.html" class="back_color">Creatine</a></li>
									<li><a href="home-02.html" class="back_color">Amino Acid</a></li>
									<li><a href="home-03.html" class="back_color">Pre Workout</a></li>
							        </div>
									<div class="col-md-4 col-sm-2 col-xs-1">
									<li style="font-size: large;">
									<a href="index.html" class="back_color" style="font-size: 16px;"><b>Health</b></a>
									</li>
								    <li><a href="index.html" class="back_color">Weight Management</a></li>
									<li><a href="home-02.html" class="back_color">Multivitatmin</a></li>
									<li><a href="home-03.html" class="back_color">Speciality Products</a></li>
							        </div>-->
									</div>
						  </ul>
						  <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>  
					</li>
					
					<li class="item-menu-mobile">
						<a href="<?php echo base_url('authenticate'); ?>">Authenticate</a>
					</li>
					
					<li class="item-menu-mobile">
						<a href="<?php echo base_url('blogs'); ?>">Blogs</a>
					</li>

					<li class="item-menu-mobile">
						<a href="<?php echo base_url('contact-us'); ?>">Enquiry</a>
					</li>

				</ul>
			</nav>
		</div>
	</header>
  <!--================Header Menu Area =================-->
