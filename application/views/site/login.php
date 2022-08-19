<?php 
	$this->load->view('site/_includes/header');
?>

<style>
.fade {
    opacity: 1;
}
</style>   
	<section class="bgwhite p-t-15 p-b-25">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-3 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm m-t-50">
						<!-- <ul class="p-b-30">
							<li class="p-t-4 ">
								<h5>My Account</h5>
							</li>
							<li class="p-t-4 ">
								<a href="<?php echo base_url('registration'); ?>" class="s-text13 ">
									Create Account
								</a>
							</li>
							<li class="p-t-4 ">
								<a href="<?php echo base_url('terms_conditions'); ?>" class="s-text13 ">
									Terms & Conditions
								</a>
							</li>
						</ul> -->
					</div>
				</div>

				<div class="col-sm-6 col-md-9 col-lg-9  text-center">
				<div class="row">
				<div class="col-sm-1 col-md-1 col-lg-1 p-b-50 p-t-30 text-center" style="background: #f9f9f9b0;">
					</div>
				<div class="col-sm-5 col-md-5 col-lg-5 p-b-50 p-t-30 text-center" style="background: #D3E9B6;">
		
					<h3 class="m-b-30 m-text4 color0">Sign In</h3>
					<div class="text-center m-t-20 m-l-40 m-r-40  ">
				 	<div class="formd" >
						<form id="registration_form" action="<?php echo base_url('site/do_login');?>"  method="post" autocomplete="off">
							
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
									<input type="password" style="border: 1px solid #989898 !important;" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>" />
								</div>
								<div class="row" >
									<div class="p-t-20col-md-12 flex_corner" style="margin-bottom:20px;">
										<button type="submit" class="btn dark_gray_bt" > Sign In </button>
										<a href="<?php echo base_url('forgot_password'); ?>" class="margin-top ablue"> Forgot Password </a> 
									</div> 
									
								</div> 
							</div>
						</form>
						</div>
						</div>
					</div>
					<div class="col-sm-1 col-md-1 col-lg-1 p-b-50 p-t-30 text-center" style="background: #f9f9f9b0;">
					</div>
				
				</div>
				</div>
				
			</div>
		</div>
	</section>
    <!--================End Category Product Area =================-->

<?php 
	$this->load->view('site/_includes/footer');
?>
  