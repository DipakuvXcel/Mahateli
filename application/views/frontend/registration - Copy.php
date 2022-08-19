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
			Registration
		</span>
	</div>

	<!-- Content page -->
	<section class="bgwhite p-t-15 p-b-25">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-3 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm m-t-40">
						<ul class="p-b-30">
							<li class="p-t-4 ">
								My Account
							</li>
							<li class="p-t-4 ">
								<a href="<?php echo base_url('login'); ?>" class="s-text13 ">
									Login
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
				 
				<div class="col-sm-6 col-md-9 col-lg-9 p-b-50 text-center">
				  <h3 class="m-b-30 m-text4 color0">CREATE ACCOUNT</h3>
				  
					<?php if($this->session->flashdata("success_message")!=""){?>
						<div class="Metronic-alerts alert alert-info fade in">
							<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true"></button>
							<i class="fa-lg fa fa-check"></i>  <?php echo $this->session->flashdata("success_message");?>
						</div>
					 <?php } ?>
					 
					<?php if($this->session->flashdata("error_message")!=""){?>
						<div
							class="Metronic-alerts alert alert-danger fade in">
							<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true"></button>
							<i class="fa-lg fa fa-warning"></i>  <?php echo $this->session->flashdata("error_message");?>
						</div>
					<?php }?>
					  
					<?php if(validation_errors()!=""){?>
						<div class="Metronic-alerts alert alert-danger fade in">
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
				  
					<form id="registration_form" action="<?php echo base_url('frontend/save_registration');?>"  method="post" autocomplete="off">
						<div class="row">
							<div class="col-md-6 col-lg-6  text-center m-t-20">
								 
								<div class="form-group">
									<label for="first_name" style="float: left;">First Name</label><span style="color:red;float: left;">*</span>
									<input type="text" style="border: 1px solid #989898 !important;" class="form-control" name="first_name" id="first_name" aria-describedby="emailHelp" placeholder="First Name" value="<?= set_value('first_name'); ?>" /> 
								</div>
								
								<div class="form-group">
									<label for="exampleInputEmail11" style="float: left;">Last Name</label><span style="color:red;float: left;">*</span>
									<input type="text" style="border: 1px solid #989898 !important;" class="form-control"  name="last_name" id="last_name" aria-describedby="emailHelp" placeholder="Last Name" value="<?= set_value('last_name'); ?>" />
								</div>
								
								<div class="form-group">
									<label for="exampleInputEmail12" style="float: left;">Email address</label><span style="color:red;float: left;">*</span>
									<input type="email" style="border: 1px solid #989898 !important;" class="form-control"  name="email_id" id="email_id" aria-describedby="emailHelp" placeholder="Enter email" value="<?= set_value('email_id'); ?>" />
								</div>
								
								<div class="form-group">
									<label for="exampleInputPassword18" style="float: left;">Mobile</label><span style="color:red;float: left;">*</span>
									<input type="number" style="border: 1px solid #989898 !important;"  name="contact" class="form-control" id="contact" placeholder="Mobile" value="<?= set_value('contact'); ?>" />
								</div>
								
								<div class="form-group">
									<label for="password" style="float: left;">Password</label><span style="color:red;float: left;">*</span>
									<input type="password" style="border: 1px solid #989898 !important;" class="form-control"  name="password" id="password" placeholder="Password" value="<?= set_value('password'); ?>" />
								</div>
							  
								<div class="form-group">
									<label for="conf_password" style="float: left;">Confirm Password</label><span style="color:red;float: left;">*</span>
									<input type="password" style="border: 1px solid #989898 !important;" onblur="checkpass();"  name="conf_password" class="form-control" id="conf_password" placeholder="Confirm Password" value="<?= set_value('conf_password'); ?>" />
								</div>

							</div>
					 
							<div class="col-md-6 col-lg-6 text-center m-t-20">
								
								<div class="form-group">
									<label for="exampleInputPassword13" style="float: left;">Address Line 1</label><span style="color:red;float: left;">*</span>
									<input type="text" name="address_line1" id="address_line1" style="border: 1px solid #989898 !important;" class="form-control" id="address_line1" placeholder="Address Line 1" value="<?= set_value('address_line1'); ?>" />
								</div>
							  
								<div class="form-group">
									<label for="exampleInputPassword14" style="float: left;">Address Line 2</label> 
									<input type="text" name="address_line2" id="address_line2" style="border: 1px solid #989898 !important;" class="form-control" id="address_line2" placeholder="Address Line 2" value="<?= set_value('address_line2'); ?>">
								</div>

								<div class="form-group">
									<label for="exampleInputPassword15" style="float: left;">City</label><span style="color:red;float: left;">*</span>
									<input type="text" style="border: 1px solid #989898 !important;"  name="city" class="form-control" id="city" placeholder="City" value="<?= set_value('city'); ?>" />
								</div>

								<div class="form-group">
									<label for="exampleInputPassword16" style="float: left;">State</label><span style="color:red;float: left;">*</span>
									<input type="text" style="border: 1px solid #989898 !important;" name="state" class="form-control" id="State" placeholder="State" value="<?= set_value('state'); ?>" />
								</div>
			
								<div class="form-group">
									<label for="exampleInputPassword17" style="float: left;">Pincode</label><span style="color:red;float: left;">*</span>
									<input type="number" style="border: 1px solid #989898 !important;"  name="pincode" class="form-control" id="pincode" placeholder="Pincode" value="<?= set_value('pincode'); ?>" />
								</div>
								
								<div class="row" >
								<div class="w-size2 p-t-20 col-lg-6 col-md-6 col-sm-6" >
									<button type="submit" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4" > Submit </button>
								</div> 
								
								<div class="w-size2 p-t-20 col-lg-6 col-md-6 col-sm-6" >
									<button type="reset" class="flex-c-m size2 bg1-overlay bo-rad-23   m-text3 trans-0-4" > Reset </button>
								</div> 
							</div> 
			
							</div>
						
							
						</div> 
					</form>
				</div> 
			</div>
		</div>
	</section>
    <!--================End Category Product Area =================-->

<?php 
	$this->load->view('frontend/_includes/footer');
?>
  