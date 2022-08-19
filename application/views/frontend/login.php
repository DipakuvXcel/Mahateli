<?php 
	$this->load->view('frontend/_includes/header');
?>

<style>
.fade {
    opacity: 1;
}
</style>   

	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16">
		Home
		<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
		Login
		</span>
	</div>
	 
	<!-- Content page -->
	<section class="bgwhite p-t-15 p-b-25">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-3 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm m-t-50">
						<ul class="p-b-30">
							<li class="p-t-4 ">
								My Account
							</li>
							<li class="p-t-4 ">
								<a href="<?php echo base_url('registration'); ?>" class="s-text13 ">
									Create Account
								</a>
							</li>
						</ul>
						
						<ul class="p-b-30">
							<li class="p-t-4 ">
								SHOP CONFIDENTLY
							</li>
							<li class="p-t-4 ">
								<a href="<?php echo base_url('privacy-policy'); ?>" class="s-text13 ">
									Privacy Policy
								</a>
							</li>
							<li class="p-t-4 ">
								<a href="<?php echo base_url('terms-conditions'); ?>" class="s-text13 ">
									Terms & Conditions
								</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-sm-6 col-md-9 col-lg-9  text-center" style="box-shadow: 0px 0px 4px #c3c3c3;">
				<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-6 p-b-50 p-t-30 text-center" style="background: #dbdbdb;">
		
					<h3 class="m-b-30 m-text4 color0">ACCOUNT LOGIN</h3>
					<div class="text-center m-t-20 m-l-40 m-r-40  ">
				 	<div class="formd" >
						<form id="registration_form" action="<?php echo base_url('frontend/do_login');?>"  method="post" autocomplete="off">
							
							<!--<h5>Returning users</h5>-->
							
							<!--<?php if($this->session->flashdata("success_message")!=""){?>
			                <div class="Metronic-alerts alert alert-info fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<i class="fa-lg fa fa-check"></i>  <?php echo $this->session->flashdata("success_message");?>
			                </div>
							<?php }?> -->
						  
							<?php if($this->session->flashdata("error_message")!=""){?>
							 <div class="Metronic-alerts alert alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i> <?php echo $this->session->flashdata("error_message");?>
			                </div>
							<?php }?>
			              
							<?php if(validation_errors()!=""){?>
			                <div
								class="Metronic-alerts alert alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i>  <?php echo validation_errors();?>
			                </div>
							<?php }?>
			              
							<?php if( $this->upload->display_errors()!=""){?>
			                <div
								class="Metronic-alerts alert alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i>  <?php echo  $this->upload->display_errors();?>
			                </div>
							<?php }?>
							
							<div class="text-center m-t-20">

								<div class="form-group">
									<label for="email_id" style="float: left;">Email-Id / Mobile Number</label><span style="color:red;float: left;">*</span>
									<input type="text" style="border: 1px solid #989898 !important;" class="form-control" id="email_id" name="email_id" placeholder="Enter Email-Id / Mobile Number" value="<?= set_value('email_id'); ?>" />
								</div>
								
								<div class="form-group">
									<label for="password" style="float: left;">Password</label><span style="color:red;float: left;">*</span>
									<input type="password" style="border: 1px solid #989898 !important;" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value('email_id'); ?>" />
								</div>
								<div class="row" >
									<div class="p-t-20 col-md-12" >
										<button type="submit" class="flex-c-m size1 bg44 bo-rad-23 hov1 m-text1 trans-0-4" > LogIn </button>
									</div> 
									<!--<div class="p-t-20 col-lg-6 col-md-6 col-sm-6" >
										<button type="reset" class="flex-c-m size2 bg1-overlay bo-rad-23   m-text3 trans-0-4" > Reset </button>
									</div> -->
								</div> 
								<div class="text-right m-t-10" >
									<a href="<?php echo base_url('forgot_password'); ?>" > Forgot Password </a> 
								</div>   
							</div>
						</form>
						</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 p-b-50 p-t-30 text-center" style="background: #f9f9f9b0;">
						<div class="text-center m-t-90 m-l-40 m-r-40  ">
						<h5 class="m-b-5">CREATE AN ACCOUNT</h5>
						<p class="m-b-5">Save your info to checkout faster with future orders.</p>
						<a href="<?php echo base_url('registration'); ?>" >
							<button type="submit" class="flex-c-m size1 bg4 bo-rad-23 hov1 m-text1 trans-0-4" > Create New Account </button> 
						</a>
						</div>
					 </div>
				</div>
				</div>
				
				<div class="col-sm-6 col-md-4 col-lg-4 p-b-50 ">
					<!--<h3>New users</h3>
					<label class="m-t-20">Creating an account is easy. Just fill out the form below and enjoy the benefits of being a registered user.</label>
					<a href="<?php echo base_url('registration'); ?>" >
						<button type="submit" class="flex-c-m size2 bg44 bo-rad-23 hov1 m-text3 trans-0-4" > Create New Account </button> 
					</a>-->
				</div>
			</div>
		</div>
	</section>
    <!--================End Category Product Area =================-->

<?php 
	$this->load->view('frontend/_includes/footer');
?>
  