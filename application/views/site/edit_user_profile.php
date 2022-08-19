 
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
						<img alt=""	class="img-circle"
									src="<?php echo upload_path; ?>/profile/<?= $user_profile[0]->image;?>" />
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
					<input type="hidden" name="id" id="id" value="<?= set_value('id',$user_profile[0]->id); ?>" /> 
					<div class="row" >
						<div class="col-md-9 col-lg-9">
						<div class="form-group">
								<label for="foundation" style="float: left;"> Foundation Name :</label>
								<select name="foundation" style="border: 1px solid #989898 !important;"   class="form-control" id="foundation" required>
									<option value="Sri Shani-Shaneswar Foundation" selected="selected">Sri Shani-Shaneswar Foundation</option>
								</select>
								<div class="select_arrow"></div>
									</div>
						</div>
						</div>
					
					<div class="row" >
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="first_name" style="float: left;"> First Name</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="first_name" id="first_name" aria-describedby="emailHelp" placeholder=" First Name" 
								value="<?= set_value('first_name',$user_profiledtails->first); ?>" /> 
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="middle_name" style="float: left;"> Middle Name</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="middle_name" id="middle_name" aria-describedby="emailHelp" placeholder=" Middle Name" 
								value="<?= set_value('middle_name',$user_profiledtails->middle); ?>" /> 
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="last_name" style="float: left;"> Last Name</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="last_name" id="last_name" aria-describedby="emailHelp" placeholder=" Last Name" 
								value="<?= set_value('last_name',$user_profiledtails->last); ?>" /> 
							</div>
							</div>
							</div>
							<div class="row" >
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="exampleInputPassword18" style="float: left;">Mobile</label><span style="color:red;float: left;">*</span>
								<input type="number" readonly style="border: 1px solid #989898 !important;"   name="contact" class="form-control" id="contact" placeholder="Mobile" value="<?= set_value('contact',$user_profile[0]->contact); ?>" />
							</div>
							</div>
						
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="exampleInputEmail12" style="float: left;">Email</label><span style="color:red;float: left;">*</span>
								<input type="email" style="border: 1px solid #989898 !important;" readonly class="form-control"  name="email_id" id="email_id" aria-describedby="emailHelp" placeholder="Enter email" value="<?= set_value('email_id',$user_profile[0]->email); ?>" />
							</div>							
							</div>
							
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="exampleInputEmail12" style="float: left;">Gender</label>
								<input type="text" style="border: 1px solid #989898 !important;" class="form-control" name="gender" id="gender" placeholder="Enter gender" value="<?= set_value('gender',$user_profiledtails->gender); ?>" />
							</div>							
							</div>
						</div>
						<div class="row" >
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="marital_status" style="float: left;"> Marital Status</label><span style="color:red;float: left;">*</span>
								<select id="marital_status" name="marital_status" onchange="changeFunc(this.value);" class="form-control">
									<?php for($i=0;$i<count($marital_status_details);$i++){ ?>
										<option value="<?= $marital_status_details[$i]->id ?>" 
										<?= set_select("marital_status", $marital_status_details[$i]->id,$user_profiledtails->marital_status==$marital_status_details[$i]->id?true:'');?>>
										<?php echo $marital_status_details[$i]->marital_status_name; ?></option>
									<?php } ?>
								</select>
								</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="mother_tounge" style="float: left;"> Mother Tounge</label><span style="color:red;float: left;">*</span>
								<?php $tablec = 'language';
										$wherec = array('id'=>$user_profiledtails->language,'status!='=>0);
										$language = $this->user_model->get_common($tablec, $wherec);?>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="mother_tounge" id="mother_tounge" placeholder=" Mother Tounge" value="<?= set_value('mother_tounge',$language->language_name); ?>" /> 
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="date" style="float: left;"> Date of Birth</label><span style="color:red;float: left;">*</span>
								<input type="date" name="date" class="form-control" id="date" placeholder="DD-MM-YYYY" value="<?= set_value('date_of_birth',$user_profiledtails->date_of_birth); ?>" required>
							</div>
							</div>
							</div>
							<div class="row" >
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="religions" style="float: left;"> Religion</label><span style="color:red;float: left;">*</span>
								<?php $tablec = 'religion';
										$wherec = array('id'=>$user_profiledtails->religion,'status!='=>0);
										$religion = $this->user_model->get_common($tablec, $wherec);?>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="religions" id="religions" placeholder="Religion" 
								value="<?= set_value('religion',$religion->religion); ?>" /> 
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="mother_tounge" style="float: left;"> Caste</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="caste" id="caste" aria-describedby="emailHelp" placeholder=" Caste" value="<?= set_value('Caste',$profilcaste->caste_name); ?>" /> 
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="sub_caste" style="float: left;"> Sub Caste</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="sub_caste" id="sub_caste" aria-describedby="emailHelp" placeholder="Sub Caste" value="<?= set_value('Sub Caste',$profilcaste->sub_caste_name); ?>" /> 
							</div>
							</div>
							</div>
							<h4 class="address-title">Permanent / Residential Address : </h2>	
							<div class="row">
							<div class="col-md-9 col-lg-9" >	 
							<div class="form-group">
								<label for="exampleInputPassword13" style="float: left;">Address :</label><span style="color:red;float: left;">*</span>
								<textarea name="res_address" id="res_address" required style="border: 1px solid #989898 !important;" class="form-control" > <?= set_value('res_address',$resident_address->address); ?> </textarea>
							</div>
							</div>
						</div>
						
						<div class="row">
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="res_landmark" style="float: left;">Landmark</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="res_landmark" class="form-control" required id="res_landmark" placeholder="Landmark" 
								value="<?= set_value('res_landmark',$resident_address->landmark); ?>" />
							</div>
						</div>
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="res_city" style="float: left;">City</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="res_city" class="form-control" required id="res_city" placeholder="City" value="<?= set_value('res_city',$resident_address->city); ?>" />
							</div>
						</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="res_district" style="float: left;">District</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="res_district" class="form-control" required id="res_district" placeholder="District" value="<?= set_value('res_district',$resident_address->district); ?>" />
							</div>
						</div>	
						</div>
						<div class="row">
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="exampleInputPassword17" style="float: left;">Pincode</label><span style="color:red;float: left;">*</span>
								<input type="number" style="border: 1px solid #989898 !important;"  name="res_pincode" class="form-control" required id="res_pincode" placeholder="Pincode" value="<?= set_value('res_pincode',$resident_address->pincode); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="res_state" style="float: left;">State :</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;" name="res_state" class="form-control" required id="res_state" placeholder="State" value="<?= set_value('res_state',$resident_address->state); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
							<label for="res_country" style="float: left;">Country :</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="res_country" class="form-control" required id="res_country" placeholder="Country" value="<?= set_value('res_country',$resident_address->country); ?>" />
							</div>
							</div>						
						</div>
						<h4 class="address-title">Address for correspondence : </h2>	
							<div class="row">
							<div class="col-md-9 col-lg-9" >	 
							<div class="form-group">
								<label for="corr_address" style="float: left;">Address :</label><span style="color:red;float: left;">*</span>
								<textarea name="corr_address" id="corr_address" required style="border: 1px solid #989898 !important;" class="form-control" > <?= set_value('corr_address',$correspond_address->address); ?> </textarea>
							</div>
							</div>
						</div>
						
						<div class="row">
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="corr_landmark" style="float: left;">Landmark</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="corr_landmark" class="form-control" required id="corr_city" placeholder="Landmark" value="<?= set_value('corr_landmark',$correspond_address->landmark); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="corr_city" style="float: left;">City</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="corr_city" class="form-control" required id="corr_city" placeholder="City" value="<?= set_value('corr_city',$correspond_address->city); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="corr_district" style="float: left;">District</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="corr_district" class="form-control" required id="corr_district" placeholder="District" value="<?= set_value('corr_district',$correspond_address->district); ?>" />
							</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="exampleInputPassword17" style="float: left;">Pincode</label><span style="color:red;float: left;">*</span>
								<input type="number" style="border: 1px solid #989898 !important;"  name="corr_pincode" class="form-control" required id="corr_pincode" placeholder="Pincode" value="<?= set_value('corr_pincode',$correspond_address->pincode); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="corr_state" style="float: left;">State :</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;" name="corr_state" class="form-control" required id="corr_state" placeholder="State" value="<?= set_value('corr_state',$correspond_address->state); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
							<label for="corr_country" style="float: left;">Country :</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="corr_country" class="form-control" required id="corr_country" placeholder="Country" value="<?= set_value('corr_country',$correspond_address->country); ?>" />
							</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-6 col-lg-6" > 
							<div class="form-group">
								<label class="control-label">Profile Image</label><span style="color:red">*</span><br>
								<div class="fileinput fileinput-new"
									data-provides="fileinput">
									<img id="blah" src="<?php echo upload_path; ?>profile/<?=$user_profile[0]->image; ?>" style="display:none;" alt="your image" />
									<div class="input-group input-large">
										<span class="input-group-addon btn default btn-file"> 
											<span class="fileinput-new"> Select file </span> 
											<input type="file" name="image" onchange="readURL(this);" accept="image">
											<a href="javascript:;" class="input-group-addon fileinput-exists" data-dismiss="fileinput" onclick="removeSingleImg()">X</a>
										</span> 														
									</div>
								</div>
								<span class="help-block"> Allowed file types .jpg, .png</span>
							</div>
						</div>
					</div>
						<div class="row">
							<div class="w-size2 p-t-20 col-lg-6 col-md-6 col-sm-6 col-xs-12" >
								<button type="submit" class="btn dark_gray_bt" > Update </button>
							</div> 
							
							<div class="w-size2 p-t-20 col-lg-6 col-md-6 col-sm-6 col-xs-12" >
								<button type="reset" class="btn dark_gray_bt" > Reset </button>
							</div> 
						</div> 
						
					</form>
				</div> 
			</div>
		</div>
	</section>
    <!--================End Category Product Area =================-->

 