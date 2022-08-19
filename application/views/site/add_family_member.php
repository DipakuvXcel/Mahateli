 
<style>
.fade {
    opacity: 1;
}
.input-large{
	display:flex;
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
							Add Family:
						</h4>
						</div>
						<div class="col-md-5">
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
	 
					<form autocomplete="off" onsubmit="return save_family_user()"  action="javascript:void(0);" method="post" id="save_family_user_form"  enctype="multipart/form-data">
						<div class="row" >
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="first_name" style="float: left;"> First Name</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="first_name" id="first_name" aria-describedby="emailHelp" placeholder=" First Name" 
								value="<?= set_value('first_name'); ?>" /> 
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="middle_name" style="float: left;"> Middle Name</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="middle_name" id="middle_name" aria-describedby="emailHelp" placeholder=" Middle Name" 
								value="<?= set_value('middle_name'); ?>" /> 
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="last_name" style="float: left;"> Last Name</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="last_name" id="last_name" aria-describedby="emailHelp" placeholder=" Last Name" 
								value="<?= set_value('last_name'); ?>" /> 
							</div>
							</div>
							</div>
							<div class="row" >
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="exampleInputPassword18" style="float: left;">Mobile</label><span style="color:red;float: left;">*</span>
								<input type="number" style="border: 1px solid #989898 !important;"   name="contact" class="form-control" id="contact" placeholder="Mobile" value="<?= set_value('contact') ?>" />
							</div>
							</div>
						
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="exampleInputEmail12" style="float: left;">Email</label><span style="color:red;float: left;">*</span>
								<input type="email" style="border: 1px solid #989898 !important;" required class="form-control"  name="email_id" id="email_id" aria-describedby="emailHelp" placeholder="Enter email" value="<?= set_value('email_id'); ?>" />
							</div>							
							</div>
							
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="exampleInputEmail12" style="float: left;">Gender</label>
								<select name="gender" id="gender"style="border: 1px solid #989898 !important;" class="form-control"  required>
									<option value=""  selected="selected">-Gender-</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
							</div>							
							</div>
						</div>
						<div class="row" >
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="marital_status" style="float: left;"> Marital Status</label><span style="color:red;float: left;">*</span>
								<select name="marital_status" id="marital_status" style="border: 1px solid #989898 !important;" class="form-control"  required>
									<option value=""  selected="selected">-Marital Status-</option>
									<option value="5">Married</option>
									<option value="4">Unmarried</option>
									<option value="3">Widow/Widower</option>
									<option value="2">Divorcee</option>
									<option value="1">Separated</option>
								</select>
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="mother_tounge" style="float: left;"> Mother Tounge</label><span style="color:red;float: left;">*</span>
								<select name="mother_tounge"  style="border: 1px solid #989898 !important;" class="form-control" id="mother_tounge" maxlength="2" required>
									<OPTION value="Marathi" selected="selected">Marathi</OPTION>
									<OPTION value="Hindi"  >Hindi</OPTION>
									<OPTION value="English"  >English</OPTION>
								</select>
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="date" style="float: left;"> Date of Birth</label><span style="color:red;float: left;">*</span>
								<input type="date" name="date" class="form-control" id="date" placeholder="DD-MM-YYYY" value="<?= set_value('date_of_birth'); ?>" required>
							</div>
							</div>
							</div>
							<div class="row" >
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="religion" style="float: left;"> Religion</label><span style="color:red;float: left;">*</span>
								<select name="religion"  style="border: 1px solid #989898 !important;" class="form-control" id="religion" required>
									<option value="Hindu" selected="selected">Hindu</option>
								</select>
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="mother_tounge" style="float: left;"> Caste</label><span style="color:red;float: left;">*</span>
								<select name="caste"  style="border: 1px solid #989898 !important;"  class="form-control" id="caste" required>
								<option value="Teli" selected="selected">Teli</option>
								</select>
								<div class="select_arrow"></div>
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="sub_caste" style="float: left;"> Sub Caste</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"   class="form-control" name="sub_caste" id="sub_caste" aria-describedby="emailHelp" placeholder="Sub Caste" value="<?= set_value('Sub Caste'); ?>" /> 
							</div>
							</div>
							</div>
						
							<h4 class="address-title">Relation : </h4>	
							<div class="row">
							<div class="col-md-3 col-lg-3" > 
							<div class="form-group">
							<select id="relation" name="relation" class="form-control">
								<option value="">Select</option>
								<?php for($i=0;$i<count($relation);$i++){?>
								<option <?= set_select("relation",$relation[$i]->id); ?> value="<?= $relation[$i]->id ?>"><?php echo $relation[$i]->family_relation_name; ?></option>
								<?php } ?>
							</select>
							</div>
							</div>
						</div>
							
							<h4 class="address-title">Permanent / Residential Address : </h4>	
							<div class="row">
							<div class="col-md-9 col-lg-9" >	 
							<div class="form-group">
								<label for="exampleInputPassword13" style="float: left;">Address :</label><span style="color:red;float: left;">*</span>
								<textarea name="res_address" id="res_address" required style="border: 1px solid #989898 !important;" class="form-control" > <?= set_value('res_address'); ?> </textarea>
							</div>
							</div>
						</div>
						
						<div class="row">
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="res_landmark" style="float: left;">Landmark</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="res_landmark" class="form-control" required id="res_landmark" placeholder="Landmark" value="<?= set_value('res_landmark'); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="res_city" style="float: left;">City</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="res_city" class="form-control" required id="res_city" placeholder="City" value="<?= set_value('res_city'); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="res_district" style="float: left;">District</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="res_district" class="form-control" required id="res_district" placeholder="District" value="<?= set_value('res_district'); ?>" />
							</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="exampleInputPassword17" style="float: left;">Pincode</label><span style="color:red;float: left;">*</span>
								<input type="number" style="border: 1px solid #989898 !important;"  name="res_pincode" class="form-control" required id="res_pincode" placeholder="Pincode" value="<?= set_value('res_pincode'); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="res_state" style="float: left;">State :</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;" name="res_state" class="form-control" required id="res_state" placeholder="State" value="<?= set_value('res_state'); ?>" />
							</div>
							</div>
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
							<label for="res_country" style="float: left;">Country :</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="res_country" class="form-control" required id="res_country" placeholder="Country" value="<?= set_value('res_country'); ?>" />
							</div>
							</div>
						</div>
						<div class="row clearfix"style="margin-left: 2px;">
							<h5 style="text-transform: capitalize;">Same as Permanent / Residential Address</h5> &nbsp;&nbsp;&nbsp;<input type="checkbox" value="" style="height:20px;" name="filltoo" id="filltoo" onclick="filladd()" /> <br/>
						</div>
						<br>
						<h4 class="address-title">Address For Correspondence : </h4>	
							<div class="row">
							<div class="col-md-9 col-lg-9" >	 
							<div class="form-group">
								<label for="corr_address" style="float: left;">Address :</label><span style="color:red;float: left;">*</span>
								<textarea name="corr_address" id="corr_address" required style="border: 1px solid #989898 !important;" class="form-control" > <?= set_value('corr_address'); ?> </textarea>
							</div>
							</div>
						</div>
						
						<div class="row">
						<div class="col-md-3 col-lg-3">
							<div class="form-group">
							<label for="corr_landmark" style="float: left;">Landmark :</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="corr_landmark" class="form-control" required id="corr_landmark" placeholder="Landmark" value="<?= set_value('corr_landmark'); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="corr_city" style="float: left;">City</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="corr_city" class="form-control" required id="corr_city" placeholder="City" value="<?= set_value('corr_city'); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="corr_district" style="float: left;">District</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="corr_district" class="form-control" required id="corr_district" placeholder="District" value="<?= set_value('corr_district'); ?>" />
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="exampleInputPassword17" style="float: left;">Pincode</label><span style="color:red;float: left;">*</span>
								<input type="number" style="border: 1px solid #989898 !important;"  name="corr_pincode" class="form-control" required id="corr_pincode" placeholder="Pincode" value="<?= set_value('corr_pincode'); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
								<label for="corr_state" style="float: left;">State :</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;" name="corr_state" class="form-control" required id="corr_state" placeholder="State" value="<?= set_value('corr_state'); ?>" />
							</div>
							</div>
							<div class="col-md-3 col-lg-3">
							<div class="form-group">
							<label for="corr_country" style="float: left;">Country :</label><span style="color:red;float: left;">*</span>
								<input type="text" style="border: 1px solid #989898 !important;"  name="corr_country" class="form-control" required id="corr_country" placeholder="Country" value="<?= set_value('corr_country'); ?>" />
							</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-6 col-lg-6" > 
							<div class="form-group">
								<label class="control-label">Profile Image</label><span style="color:red">*</span><br>
								<div class="fileinput fileinput-new"
									data-provides="fileinput">
									<img id="blah" src="#" style="display:none;" alt="your image" />
									<div class="input-group input-large">
										<span class="input-group-addon btn default btn-file"> 
											<span class="fileinput-new"> Select file </span> 
											<input type="file" name="image" onchange="readURL(this);" accept="image/*">
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
								<button type="submit" class="btn dark_gray_bt" > Submit </button>
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
<script>
	function filladd()
{
	 if(filltoo.checked == true) 
     {
            var add =document.getElementById("res_address").value;
            var land =document.getElementById("res_landmark").value;
            var city =document.getElementById("res_city").value;
            var disti =document.getElementById("res_district").value;
            var pincd =document.getElementById("res_pincode").value;
            var state =document.getElementById("res_state").value;
            var count =document.getElementById("res_country").value;

            var copyadd =add ;
            var copyland =land ;
            var copycity =city ;
            var copydisti =disti ;
            var copypincs =pincd ;
            var copystate =state ;
            var copycount =count ;

            
            document.getElementById("corr_address").value = copyadd;
            document.getElementById("corr_landmark").value = copyland;
            document.getElementById("corr_city").value = copycity;
            document.getElementById("corr_district").value = copydisti;
            document.getElementById("corr_pincode").value = copypincs;
            document.getElementById("corr_state").value = copystate;
            document.getElementById("corr_country").value = copycount;
	 }
	 else if(filltoo.checked == false)
	 {
		 document.getElementById("corr_address").value='';
		 document.getElementById("corr_landmark").value='';
		 document.getElementById("corr_city").value='';
		 document.getElementById("corr_district").value='';
		 document.getElementById("corr_pincode").value='';
		 document.getElementById("corr_state").value='';
		 document.getElementById("corr_country").value='';
	 }
}
function readURL(input) {
		
		if (input.files && input.files[0]) {
	  $('#blah').show();
			var reader = new FileReader();
	
			reader.onload = function (e) {
				$('#blah')
					.attr('src', e.target.result)
					.width(98)
					.height(90);
			};
	
			reader.readAsDataURL(input.files[0]);
		}
	}
	function removeSingleImg(){
		$('#blah').hide();
	}
	</script>
	