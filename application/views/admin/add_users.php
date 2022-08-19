<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">
			Add user
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><a href="<?php echo base_url('admin/users'); ?>">user</a> </li> <i class="fa fa-angle-right"></i>
				<li><a> Add user</a> </li>
				<li><span></span>	
			</ul>
		</div>
		<!-- END PAGE HEADER-->

		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet light ">
					<div class="portlet-title">
						<div class="caption font-dark">
							<i class="icon-settings font-dark"></i> <span
								class="caption-subject bold uppercase "> Add user</span>
						</div>
						<div class="actions">
								<a href="<?php echo base_url('admin/users');?>" class="btn btn-circle default fa fa-arrow-left">Back
								</a>
						</div>
					</div>
					<div class="portlet-body">
							<?php if($this->session->flashdata("success_message")!="")
							{
							?>
			        <div class="Metronic-alerts alert alert-info fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<i class="fa-lg fa fa-check"></i>  <?php echo $this->session->flashdata("success_message");?>
			        </div>
							<?php 
							}
							if($this->session->flashdata("error_message")!="")
							{
							?>
			        <div class="Metronic-alerts alert alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i>  <?php echo $this->session->flashdata("error_message");?>
			        </div>
							<?php 
							}
							if(validation_errors()!="")
							{
							?>
			        <div class="Metronic-alerts alert alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i>  <?php echo validation_errors();?>
			        </div>
							<?php 
							}
							if( $this->upload->display_errors()!="")
							{
								?>
			        <div class="Metronic-alerts alert alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i>  <?php echo  $this->upload->display_errors();?>
			        </div>
							<?php 
							}
							?>
			              
						<form id="add_student_form" class="horizontal-form" autocomplete="off" action="<?php echo base_url('admin/save_user');?>"  method="post" enctype="multipart/form-data" autocomplete="Off">
							<div class="form-body">
							
								<h4 style="background-color:#68838B;color:#fff;padding:10px;">Personal Details</h4>
						
								<div class="row">
								
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">First Name</label><span style="color:red">*</span>
											<input  name="fname" class="form-control" maxlength="25" type="text"  value="<?= set_value('fname'); ?>" alt="Only 25 Character Allowed" placeholder="Enter first name">
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Middle Name</label><span style="color:red">*</span>
											<input  name="mname" class="form-control" maxlength="25" type="text"  value="<?= set_value('mname'); ?>" alt="Only 25 Character Allowed" placeholder="Enter middle name">
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Last Name</label><span style="color:red">*</span>
											<input  name="lname" class="form-control" maxlength="25" type="text"  value="<?= set_value('lname'); ?>" alt="Only 25 Character Allowed" placeholder="Enter last name">
										</div>
									</div>

									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Contact</label><span style="color:red">*</span>
											<input id="start_time" name="contact" class="form-control" type="tel"  value="<?= set_value('contact'); ?>" placeholder="Contact Number">
										</div>
									</div>
									</div>
									
									<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Date Of Birth </label><span style="color:red">*</span>
											<input id="birth" name="birth" placeholder="Date of birth" class="form-control datepicker"  type="text" value="<?= set_value('birth'); ?>">
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Marital Status : </label><span style="color:red">*</span>
											<select name="mstatus" class="form-control" required>
											<option value="" selected="selected">-Marital Status-</option>
											<option value="5">Married</option>
											<option value="4">Unmarried</option>
											<option value="3">Widow/Widower</option>
											<option value="2">Divorcee</option>
											<option value="1">Separated</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Mother tongue</label><span style="color:red">*</span>
											<select name="mlangu" class="form-control" id="mlangu" required>
												<option value="Marathi" selected="selected">Marathi</option>
												<option value="Hindi"  >Hindi</option>
												<option value="English"  >English</option>
											</select>
											<div class="select_arrow"></div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Religion </label><span style="color:red">*</span>
											<select name="religion" class="form-control" id="religion" required>
												<option value="Hindu" selected="selected">Hindu</option>
											</select>
											<div class="select_arrow"></div>
										</div>
									</div>
										
								</div>

									<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Caste : </label><span style="color:red">*</span>
											<select name="caste" class="form-control" id="caste" required>
											<option value="Teli" selected="selected">Teli</option>
											</select>
											<div class="select_arrow"></div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Sub Caste : </label><span style="color:red">*</span>
											<input  name="sub_caste" class="form-control" maxlength="25" type="text"  value="<?= set_value('sub_caste'); ?>" alt="Only 25 Character Allowed" placeholder="Sub Caste">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Gender : </label><span style="color:red">*</span>
											<input  name="gender" class="form-control" maxlength="25" type="text"  value="<?= set_value('gender'); ?>" alt="Only 25 Character Allowed" placeholder="Sub Caste">
										</div>
									</div>

								</div>
							
							<div class="row">

									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Email</label><span style="color:red">*</span>
											<input id="end_time" name="email" class="form-control"  type="Email" value="<?= set_value('email'); ?>" required placeholder="Email Address">
											<span style="color:gray">Email Id is considered as Username</span>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Password</label><span style="color:red">*</span>
											<input name="password" class="form-control" type="password"  value="<?= set_value('password'); ?>" required placeholder="Password">
											<span style="color:gray">Password should contain minimum 6 Characters</span>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Conf. Password</label><span style="color:red">*</span>
											<input name="cpassword" class="form-control" type="password"  value="<?= set_value('cpassword'); ?>" required placeholder="Confirm Password">
										</div>
									</div>
									</div>	
								</div>
								
								
								<h4 style="background-color:#68838B;color:#fff;padding:10px;">Permanent / Residential Address :</h4>


								<div class="row">

									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Address </label><span style="color:red">*</span>
											<textarea id="address1" name="address1" placeholder="Address " class="form-control" rows="3"><?= set_value('address1'); ?></textarea>
											<span style="color:gray">Enter Address lines without Country,State,City,Pincode</span>
										</div>
									</div>

									</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
										<label class="control-label">Landmaek</label><span style="color:red">*</span>
										<input  name="landmark1" class="form-control" maxlength="25" type="text" placeholder="Landmark" value="<?= set_value('landmaek1'); ?>" alt="Only 25 Character Allowed">
										</div>
										</div>
									<div class="col-md-3">
											<div class="form-group">
											<label class="control-label">City</label><span style="color:red">*</span>
											<input  name="city1" class="form-control" maxlength="25" type="text" placeholder="City" value="<?= set_value('city1'); ?>" alt="Only 25 Character Allowed">
											</div>
										</div>
							
								<div class="col-md-3">
											<div class="form-group">
											<label class="control-label">District</label><span style="color:red">*</span>
											<input  name="district1" class="form-control" maxlength="25" type="text" placeholder="District" value="<?= set_value('district1'); ?>" alt="Only 25 Character Allowed">
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="form-group">
											<label class="control-label">Pincode</label><span style="color:red">*</span>
											<input id="pin1" name="pin1" class="form-control" placeholder="Pincode" type="number" value="<?= set_value('pin1'); ?>">
											</div>
										</div>	
										</div>

										<div class="row">						
								<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">State</label><span style="color:red">*</span>
											<input id="state1" name="state1" class="form-control" placeholder="State" type="text" value="<?= set_value('state1'); ?>">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Country</label><span style="color:red">*</span>
											<input  name="country1" class="form-control" maxlength="25" type="text"  value="India" alt="Only 25 Character Allowed">
										</div>
									</div>		
									</div>	
									<div class="row clearfix"style="margin-left: 2px;display:flex;">	
									<h5 style="text-transform: capitalize;">Same as Permanent / Residential Address</h5> &nbsp;&nbsp;&nbsp;<input type="checkbox" value="" style="height:30px;" name="filltoo" id="filltoo" onclick="filladd()" /> <br/>
									</div>
									<h4 style="background-color:#68838B;color:#fff;padding:10px;">Address For Correspondence:</h4>


								<div class="row">

									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Address </label><span style="color:red">*</span>
											<textarea id="address2" name="address2" placeholder="Address " class="form-control" rows="3"><?= set_value('address2'); ?></textarea>
											<span style="color:gray">Enter Address lines without Country,State,City,Pincode</span>
										</div>
									</div>

									</div>

								<div class="row">									
									<div class="col-md-3">
											<div class="form-group">
											<label class="control-label">Landmark</label><span style="color:red">*</span>
											<input  name="landmark2" class="form-control" maxlength="25" type="text" placeholder="Landmark" value="<?= set_value('landmark2'); ?>" alt="Only 25 Character Allowed">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
											<label class="control-label">City</label><span style="color:red">*</span>
											<input  name="city2" class="form-control" maxlength="25" type="text" placeholder="City" value="<?= set_value('city2'); ?>" alt="Only 25 Character Allowed">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
											<label class="control-label">District</label><span style="color:red">*</span>
											<input  name="district2" class="form-control" maxlength="25" type="text" placeholder="District" value="<?= set_value('district2'); ?>" alt="Only 25 Character Allowed">
											</div>
										</div>
									
										<div class="col-md-3">
											<div class="form-group">
											<label class="control-label">Pincode</label><span style="color:red">*</span>
											<input id="pin2" name="pin2" class="form-control" placeholder="Pincode" type="number" value="<?= set_value('pin2'); ?>">
											</div>
										</div>
										
									</div>
									
									
									<div class="row">
										<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">State</label><span style="color:red">*</span>
											<input id="state2" name="state2" class="form-control" placeholder="State" type="text" value="<?= set_value('state2'); ?>">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Country</label><span style="color:red">*</span>
											<input  name="country2" class="form-control" maxlength="25" type="text"  value="India" alt="Only 25 Character Allowed">
										</div>
									</div>

								</div>

							</div>
							<h4 style="background-color:#68838B;color:#fff;padding:10px;">Upload Profile:</h4>
							<div class="form-group">
								<label class="control-label">Profile Image</label><span style="color:red">*</span><br>
								<div class="fileinput fileinput-new"
									data-provides="fileinput">
									<img id="blah" src="#" style="display:none;" alt="your image" />
									<div class="input-group input-large">
										<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
											<i class="fa fa-file fileinput-exists"></i>&nbsp; 
											<span class="fileinput-filename"> </span>
										</div>
										<span class="input-group-addon btn default btn-file"> 
											<span class="fileinput-new"> Select file </span> 
											<span class="fileinput-exists"> Change </span> 
											<input type="file" name="image" onchange="readURL(this);" accept="image/*">
										</span> 
										
										<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput" onclick="removeSingleImg()">X</a>
											
									</div>
								</div>
								<span class="help-block"> Allowed file types .jpg, .png</span>
							</div>

								<div class="row"></div>

								<div class="row">
									<div class="col-md-1">
										<button type="submit" class="btn blue"><i class="fa fa-check"></i> Submit</button>
									</div>	
									<div class="col-md-1">
										<a type="button" class="btn default" href="<?php echo base_url('admin/users');?>">Cancel</a>
									</div>
							</div>
							</div>
							
						</form>
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>

	</div>
	<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<script>
	var base_url = "<?php echo base_url(); ?>";
</script>

<?php
/*$data ['script'] = "";
$data ['initialize'] = "pageFunctions.init();";*/
$this->load->view ( 'admin/_includes/footer', $data );
?>

<script>
//$("#date").datepicker("setDate", new Date());
//$("#edate").datepicker("setDate", new Date());
	 

	$(".datepicker").datepicker({ 
        minDate: 0,
        format: "yyyy-mm-dd",
        changeMonth: true,
        changeYear: true,
		endDate: new Date(),
        yearRange: '-100:0'
    });
	</script>
	<script>
	function filladd()
{
	 if(filltoo.checked == true) 
     {
            var add =document.getElementById("address1").value;
            var land =document.getElementById("landmark1").value;
            var city =document.getElementById("city1").value;
            var disti =document.getElementById("district1").value;
            var pincd =document.getElementById("pincode1").value;
            var state =document.getElementById("state1").value;
            var count =document.getElementById("country1").value;

            var copyadd =add ;
            var copyland =land ;
            var copycity =city ;
            var copydisti =disti ;
            var copypincs =pincd ;
            var copystate =state ;
            var copycount =count ;

            
            document.getElementById("address2").value = copyadd;
            document.getElementById("landmark2").value = copyland;
            document.getElementById("city2").value = copycity;
            document.getElementById("district2").value = copydisti;
            document.getElementById("pincode2").value = copypincs;
            document.getElementById("state2").value = copystate;
            document.getElementById("country2").value = copycount;
	 }
	 else if(filltoo.checked == false)
	 {
		 document.getElementById("address2").value='';
		 document.getElementById("landmark2").value='';
		 document.getElementById("city2").value='';
		 document.getElementById("district2").value='';
		 document.getElementById("pincode2").value='';
		 document.getElementById("state2").value='';
		 document.getElementById("country2").value='';
	 }
}


</script>