 
<style>
.fade {
    opacity: 1;
}
</style>
	
	<!-- Content page -->
	<section class="bgwhite p-b-65">
		<div class="container">
			<div class="row">

				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="row m-b-30">
						<div class="col-md-5">
						<h4 class="p-b-11 m-text24">
							Edit Profile:
						</h4>
						</div>
						<div class="col-md-5">
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" onclick="profile_section();" href="javascript:void(0);" style="width: 50%; float: right; height: 40px;">
							My Profile
						</button>
						</div>
					</div>
					<hr> </hr>
				  
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
	 
					<form autocomplete="off" onsubmit="return update_user()"  action="javascript:void(0);" method="post" id="update_user_form">
						<div class="row" >
							<div class="col-md-6 col-lg-6" >
							<div class="form-group">
								<label for="first_name" style="float: left;"> Name</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder=" Name" value="<?= set_value('name',$user_profile[0]->name); ?>" /> 
							</div>
							</div>

							<div class="col-md-6 col-lg-6" >
							<div class="form-group">
								<label for="exampleInputPassword18" style="float: left;">Mobile</label><span style="color:red;float: left;">*</span>
								<input type="number" style="border: 1px solid #989898 !important;"   name="contact" class="form-control" id="contact" placeholder="Mobile" value="<?= set_value('contact',$user_profile[0]->contact); ?>" />
							</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6 col-lg-6" >
							<div class="form-group">
								<label for="exampleInputEmail12" style="float: left;">Email address</label><span style="color:red;float: left;">*</span>
								<input type="email" style="border: 1px solid #989898 !important;" required class="form-control"  name="email_id" id="email_id" aria-describedby="emailHelp" placeholder="Enter email" value="<?= set_value('email_id',$user_profile[0]->email); ?>" />
							</div>							
							</div>
							
							<div class="col-md-6 col-lg-6" >
							<div class="form-group">
								<label for="exampleInputEmail12" style="float: left;">GST Number</label>
								<input type="text" style="border: 1px solid #989898 !important;" class="form-control" name="gst" id="gst" placeholder="Enter GST Number" value="<?= set_value('gst',$user_profile[0]->gst); ?>" />
							</div>							
							</div>
							
							
						</div>
				 
						<div class="row">
							<div class="col-md-6 col-lg-6" >	 
							<div class="form-group">
								<label for="exampleInputPassword13" style="float: left;">Address Line 1</label><span style="color:red;float: left;">*</span>
								<textarea name="address_line1" id="address_line1" required style="border: 1px solid #989898 !important;" class="form-control" > <?= set_value('address_line1',$user_profile[0]->address1); ?> </textarea>
							</div>
							</div>
							
							<div class="col-md-6 col-lg-6" >
							<div class="form-group">
								<label for="exampleInputPassword14" style="float: left;">Address Line 2</label> 
								<textarea name="address_line2" id="address_line2" style="border: 1px solid #989898 !important;" class="form-control" ><?= set_value('address_line2',$user_profile[0]->address2); ?></textarea>
							</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4 col-lg-4" >
							<div class="form-group">
								<label for="exampleInputPassword16" style="float: left;">State</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;" name="state" class="form-control" required id="State" placeholder="State" value="<?= set_value('state',$user_profile[0]->state); ?>" />
							</div>
							</div>
							<div class="col-md-4 col-lg-4" >
							<div class="form-group">
								<label for="exampleInputPassword15" style="float: left;">City</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="city" class="form-control" required id="city" placeholder="City" value="<?= set_value('city',$user_profile[0]->city); ?>" />
							</div>
							</div>
							<div class="col-md-4 col-lg-4" >
							<div class="form-group">
								<label for="exampleInputPassword17" style="float: left;">Pincode</label><span style="color:red;float: left;">*</span>
								<input type="number" style="border: 1px solid #989898 !important;"  name="pincode" class="form-control" required id="pincode" placeholder="Pincode" value="<?= set_value('pincode',$user_profile[0]->pincode); ?>" />
							</div>
							</div>
						</div>
						
						<div class="row">
							<div class="w-size2 p-t-20 col-lg-6 col-md-6 col-sm-6 col-xs-12" >
								<button type="submit" class="flex-c-m size2 bg44 bo-rad-23 hov1 m-text3 trans-0-4" > Update </button>
							</div> 
							
							<div class="w-size2 p-t-20 col-lg-6 col-md-6 col-sm-6 col-xs-12" >
								<button type="reset" class="flex-c-m size2 bg1-overlay bo-rad-23   m-text3 trans-0-4" > Reset </button>
							</div> 
						</div> 
						
					</form>
				</div> 
			</div>
		</div>
	</section>
    <!--================End Category Product Area =================-->

 