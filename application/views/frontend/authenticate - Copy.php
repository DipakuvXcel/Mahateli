<?php 
	$this->load->view('frontend/_includes/header');
?>

<!--Start category area-->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-md-c-m" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/myFuelO1.png);">
		<h2 class="l-text2 t-center">
			Authenticate
		</h2>
	</section>
	
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16"> Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
			Authenticate
		</span>
	</div>

	<section class="banner2 bg5 p-t-55 " >
		<div class="container" style="border: 1px solid silver;margin-bottom: 5%;">
			<div class="row">
			
				<div class="bgwhite hov-img-zoom pos-relative p-b-20per-ssm"  >
					<br>
					<h3 class="text-center" style="color:#843b62">IS YOUR PROTEIN ORIGINAL ?<hr></h3>
				
					<div class="text-center">
						<br>
						Know is your MyFuel product is authenticate. </br> 
							</br> 
						Look for the Unique code under the cap 
						</br> 
						</br> 
						
						
						<form class=" " autocomplete="off" method="post" id=" " novalidate="novalidate" action="<?php echo base_url('frontend/check_authentication') ?>" >
  
							<div class="col-xl-auto">
							
							<div class="col-md-3" >
							</div>
							<div class="col-md-6" >
								<?php if($this->session->flashdata("success_message")!=""){?>
								<div class="alert alert-success alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<i class="fa-lg fa fa-check"></i><?php echo $this->session->flashdata("success_message");?>
								</div>
								<?php }?>
								<?php if($this->session->flashdata("error_message")!=""){?>

								<div class="alert alert-danger alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<i class="fa-lg fa fa-warning"></i> <?php echo $this->session->flashdata("error_message");?>
								</div>
								<?php }?>

								<?php if(validation_errors()!=""){?>
								<div class="alert alert-danger alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<i class="fa-lg fa fa-warning"></i><?php echo validation_errors();?>
								</div>

								<?php }?>

								<?php if( $this->upload->display_errors()!=""){?>
								<div class="alert alert-danger alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<i class="fa-lg fa fa-warning"></i><?php echo  $this->upload->display_errors();?>
								</div>
								<?php }?>
							</div>
							<div class="col-md-3" >
							</div>
							<div class="row">
								<div class="col-md-4" >
								</div>
								<div class="col-md-4" style="margin-bottom: 1rem;">
									<input name="product_code" id="product_code" style="border: 1px solid #989898 !important;" class="form-control" type="text" required placeholder="Enter Unique Code*" value="<?= set_value('product_code'); ?>" required />
								</div>
								<div class="col-md-4" >
								</div>

								<div class="col-md-4" >
								</div>
								<div class="col-md-4 " style="margin-bottom: 1rem;">
									<input name="contact" id="contact" style="border: 1px solid #989898 !important;" class="form-control" type="tel" placeholder="Mobile Number*" value="<?= set_value('contact'); ?>" required />
								</div>
								<div class="col-md-4" >
								</div>
								
								<div class="col-md-4" >
								</div>
								<div class="col-md-4 " style="margin-bottom: 1rem;">
									<input name="email" id="email" style="border: 1px solid #989898 !important;" class="form-control" type="email" placeholder="Email Id" value="<?= set_value('email'); ?>" >
								</div>
								<div class="col-md-4" >
								</div>
								</br></br>
								
								<div class="col-md-12">
									<div class="text-center">
										<button type="submit" name="submit" class="size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4 w-size25" style="border-radius: 12px;">Check Now</button> 
									</div>
								</div>
								</br> 
								</br> 
								
								<div class="col-md-12">
									<input type="checkbox" class="checkbox" name="subscribe" id="subscribe" value="1" <?php echo set_checkbox('subscribe', '1'); ?> /> Subscribe me to articles, ideas and more!
								</div>
							</div>
							</div>
							</br> 
						</form>

						<!--<div class=" t-center" style="margin-top: -25px; position: relative;">
						<a href="interestedModalTitle" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4" style="background-color: #843b62; color:#fff; font-weight: 600;width: 190px; padding: 15px; display: inline-flex;margin-bottom: 5%;" data-toggle="modal" data-target="#interestedModal">
						Talk to an Expert
						</a>
						</div>-->
					</div>
				</div>
			</div>
		</div>
	</section>


<?php 
	$this->load->view('frontend/_includes/footer');
?>

<script>
	function submitauthform(Form){

	  if ((Form.name.value == "") || (Form.name.value == "Name*")) {
		  alert("Please enter name.");
		  Form.name.select();
		  return false;
	  } else if ((Form.email.value == "") || (Form.email.value == "Email*")) {
		  alert("Please enter email address.");
		  Form.email.select();
		  return false;
	  } else if ((Form.contact.value == "") || (Form.contact.value == "Contact*")) {
		  alert("Please enter Contact.");
		  Form.contact.select();
		  return false;
	  } else if ((Form.address.value == "") || (Form.address.value == "Address*")) {
		  alert("Please enter Address.");
		  Form.address.select();
		  return false;
	  } else {
		  Form.submit();
	  }
	}
</script>