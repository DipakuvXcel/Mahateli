<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<!-- site metas -->
<title><?= $page_title; ?></title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="<?php echo assets_path; ?>css/util.css" />
<!-- site icons -->
<link rel="icon" href="<?php echo site_path; ?>images/fevicon/fevicon.png" type="image/gif" />
<!-- bootstrap css -->
<link rel="stylesheet" href="<?php echo site_path; ?>css/bootstrap.min.css" />
<!-- Site css -->
<link rel="stylesheet" href="<?php echo site_path; ?>css/style.css" />
<!-- responsive css -->
<link rel="stylesheet" href="<?php echo site_path; ?>css/responsive.css" />
<!-- colors css -->
<link rel="stylesheet" href="<?php echo site_path; ?>css/colors1.css" />
<!-- <link rel="stylesheet" href="<?php echo assets_path; ?>css/components.min.css" /> -->
<!-- custom css -->
<link rel="stylesheet" href="<?php echo site_path; ?>css/custom.css" />
<!-- wow Animation css -->
<link rel="stylesheet" href="<?php echo site_path; ?>css/animate.css" />
<!-- revolution slider css -->
<link rel="stylesheet" type="text/css" href="<?php echo site_path; ?>revolution/css/settings.css" />
<link rel="stylesheet" type="text/css" href="<?php echo site_path; ?>revolution/css/layers.css" />
<link rel="stylesheet" type="text/css" href="<?php echo site_path; ?>revolution/css/navigation.css" />
	<!--<link rel="stylesheet" href="<?php echo assets_path; ?>vendor/select2/select2.min.css" />
	<link rel="stylesheet" href="<?php echo assets_path; ?>vendor/daterangepicker/daterangepicker.css" />-->
<?php
error_reporting(0);
?>
<style>
  .img-circle {
  border-radius: 20%;
  height:80px;
  width:70px;
}
</style>
</head>
<body id="default_theme" class="it_service">
<!-- loader -->
<div class="bg_load"> <img class="loader_animation" src="<?php echo site_path; ?>images/loaders/loader_1.png" alt="#" /> </div>
<!-- end loader -->
<!-- header -->
<header id="default_header" class="header_style_1">
  <!-- header top -->
  <div class="header_top">
    <div class="container top_container">
      <div class="row">
        <div class="col-md-6">
          <div class="full">
            <div class="topbar-left">
        <!-- logo start -->
          <div class="logo"> <a href="<?php echo base_url('registration'); ?>"><img src="<?php echo site_path; ?>images/logos/logo.png" alt="logo" /></a> </div>
          <!-- logo end -->
        
            </div>
          </div>
        </div>
        <div class="col-md-6 right_section_header_top">
        <?php if($this->session->userdata('user_profile')!=''){ ?>  
        <div class="float-left">
            <div class="social_icon">
            </div>
          </div>
            <div class="float-right">
							    <div class="make_appo">         
                  </div>
                  <div class="make_appo">
                      <a class="btn white_btn" href="<?php echo base_url('profile'); ?>" class="header-cart-item-name"> 
                      <i class="fa fa-user"></i>
                      Profile&nbsp;&nbsp;&nbsp;&nbsp;
                    </a>
                  </div>
                  <div class="make_appo">
											<a class="btn white_btn" href="<?php echo base_url('frontend/logout'); ?>" class="header-cart-item-name">
												<i class="fa fa-sign-out"></i>
												Sign Out
											</a>
                   </div>
								</div>
							<?php } else {?>
          <div class="float-right">
            <div class="make_appo"> <a class="btn white_btn" href="<?php echo base_url('registration'); ?>">Sign Up</a> </div>
			      <div class="make_appo"> <a class="btn white_btn" href="<?php echo base_url('login'); ?>">Sign In</a> </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- end header top -->
  <!-- header bottom -->
  <div class="header_bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
          <!-- menu start -->
          <div class="menu_side">
            <div id="navbar_menu">
              <ul class="first-ul">
                <li> <a class="<?= $active =='home'?'active':''; ?>" href="<?php echo base_url(); ?>">Home</a>
                <li><a class="<?= $active =='about'?'active':''; ?>" href="<?php echo base_url('about-us'); ?>">About Us</a></li>
                <!-- <li> <a class="<?= $active =='services'?'active':''; ?>" href="<?php echo base_url('services'); ?>">Service</a></li>
                <li> <a class="<?= $active =='shop'?'active':''; ?>" href="<?php echo base_url('products'); ?>">Product</a> </li> -->
                <li> <a class="<?= $active =='contact'?'active':''; ?>" href="<?php echo base_url('contact-us'); ?>">Contact Us</a></li>
                <li><a href="#" data-toggle="modal" data-target="#search_bar"><i class="fa fa-search" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
          <!-- menu end -->
        </div>
      </div>
    </div>
  </div>
  <!-- header bottom end -->
</header>
<!-- end header -->
<style>
  input[type=date],input[type=datetime-local],input[type=month],input[type=time]{-webkit-appearance:listbox}
</style>