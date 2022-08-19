<?php $this->load->view('admin/_includes/header');?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
.toggle-handle {
    position: relative !important;
    margin: 0 auto !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    height: 100% !important;
    width: 0 !important;
    border-width: 0 1px !important;
     
}
.btn-sm {
    line-height: 2.1 !important;
}
 
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">
			Edit Family User
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><a href="<?php echo base_url('admin/users'); ?>">users</a>
					<i class="fa fa-angle-right"></i></li>
				<li><span> Edit Family User</span>	
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
								class="caption-subject bold uppercase">  Edit Family User</span>
						</div>
						<div class="actions">
							
								<a href="<?php echo base_url('admin/users');?>"
									class="btn btn-circle default fa fa-arrow-left">
									Back</a>
						</div>
					</div>
					<div class="portlet-body">
					
							<?php if($this->session->flashdata("success_message")!=""){?>
			                <div class="Metronic-alerts alert alert-info fade in">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true"></button>
								<i class="fa-lg fa fa-check"></i>  <?php echo $this->session->flashdata("success_message");?>
			                </div>
			              <?php }?>
			              <?php if($this->session->flashdata("error_message")!=""){?>
			                <div
								class="Metronic-alerts alert alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i>  <?php echo $this->session->flashdata("error_message");?>
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
			              
			             
		              
						<form id="add_student_form" class="horizontal-form" action="<?php echo base_url('admin/update_family_user');?>"
							method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?= set_value('id',$user_details->id) ?>">
							<div class="form-body">
							<h4 style="background-color:#68838B;color:#fff;padding:10px;">Personal Details</h4>
								<div class="row">
									<div class="col-md-3 col-md-push-1">
										<div class="form-group">
											<label class="control-label">First Name</label><span style="color:red">*</span>
											<input  name="fname" class="form-control" type="text" maxlength="25"  value="<?= set_value('fname',$user_details->first); ?>" alt="Only 25 Character Allowed">
										</div>
									</div>
									<div class="col-md-3 col-md-push-1">
											<div class="form-group">
											<label class="control-label">Middle Name</label><span style="color:red">*</span>
											<input  name="mname" class="form-control" type="text" maxlength="25"  value="<?= set_value('mname',$user_details->middle); ?>" alt="Only 25 Character Allowed">
										</div>
									</div>
									<div class="col-md-3 col-md-push-1">
										<div class="form-group">
											<label class="control-label">Last Name</label><span style="color:red">*</span>
											<input  name="lname" class="form-control" type="text" maxlength="25"  value="<?= set_value('lname',$user_details->last); ?>" alt="Only 25 Character Allowed">
										</div>
									</div>
								</div>
								<div class="row">
								<div class="col-md-3 col-md-push-1">
									<div class="form-group">
											<label class="control-label">Contact</label><span style="color:red">*</span>
											<input id="start_time" name="contact" class="form-control" type="number" required value="<?= set_value('contact',$user_details->contact); ?>">
										</div>
									</div>
									<div class="col-md-3 col-md-push-1">
										<div class="form-group">
											<label class="control-label">Email / Username</label><span style="color:red">*</span>
											<input id="end_time" name="email" class="form-control" readonly type="Email" value="<?= set_value('email',$user_details->email); ?>">
										</div>
									</div>
									<div class="col-md-3 col-md-push-1">
										<div class="form-group">
											<label class="control-label">Birth Date</label>
											<input id="birth" name="birth" class="form-control my-datepicker"  type="text" value="<?= set_value('birth',$user_details->date_of_birth); ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 col-md-push-1">
											<div class="form-group">
											<label class="control-label">Marital Status</label>
											<select name="marital_status" class="form-control" required>
											<option value="">Select</option>
											<?php for($i=0;$i<count($marital_status);$i++){ 
												
												?>
												<option value="<?= $marital_status[$i]->id ?>" <?= set_select("marital_status", ".$marital_status[$i]->id.",$user_details->marital_status==$marital_status[$i]->id?true:'');?>><?php echo $marital_status[$i]->marital_status_name; ?></option>
												<?php } 
                                                   ?>
											</select>
										</div>
									</div>
									<div class="col-md-3 col-md-push-1">
										<div class="form-group">
											<label class="control-label">Mother tongue</label>
									<select name="language" class="form-control" id="language" maxlength="9" required>
										<option value="Marathi" selected="selected">Marathi</option>
										<option value="Hindi"  >Hindi</option>
										<option value="English"  >English</option>
									</select>
								</div>
								</div>
								<div class="col-md-3 col-md-push-1">
										<div class="form-group">
											<label class="control-label">Religion</label>
											<select name="religion" class="form-control" id="religion" required>
											<option value="Hindu" selected="selected">Hindu</option>
										</select>
								</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 col-md-push-1" >
								<div class="form-group">
								<label class="control-label">Caste</label><span style="color:red">*</span>
									<select name="caste" class="form-control" id="caste" required>
									<option value="Teli" selected="selected">Teli</option>
									</select>
									</div>
								</div>
								<div class="col-md-3 col-md-push-1" >
								<div class="form-group">
								<label class="control-label">Sub Caste</label><span style="color:red">*</span>
									<input type="text" id="sub_caste" name="sub_caste" class="form-control"  maxlength="25"alt="Only 25 Character Allowed" placeholder="Sub Caste" value="<?= set_value('sub_caste',$caste->sub_caste_name); ?>" required>        
									</div>
									</div>
								<div class="col-md-3 col-md-push-1" >
								<div class="form-group">
								<label class="control-label">Gender</label><span style="color:red">*</span>
									<input type="text" id="gender" name="gender" class="form-control"  maxlength="25"alt="Only 25 Character Allowed" placeholder="Gender" value="<?= set_value('gender',$user_details->gender); ?>" required>        
									</div>
									</div>
								</div>
								<h4 style="background-color:#68838B;color:#fff;padding:10px;">Permanent / Residential Address :</h4>


<div class="row">

	<div class="col-md-9 col-md-push-1">
		<div class="form-group">
			<label class="control-label">Address </label><span style="color:red">*</span>
			<textarea id="address1" name="address1" placeholder="Address " class="form-control" rows="3"><?= set_value('address1',$reside->address); ?></textarea>
			<span style="color:gray">Enter Address lines without Landmark,City,District,State,Pincode,Country</span>
		</div>
	</div>

	</div>

<div class="row">
<div class="col-md-3 col-md-push-1" >
							<div class="form-group">
		<label class="control-label">Landmaek</label><span style="color:red">*</span>
		<input  name="landmark1" class="form-control" maxlength="25" type="text" placeholder="Landmaek" value="<?= set_value('landmaek1',$reside->landmark); ?>" alt="Only 25 Character Allowed">
		</div>
		</div>
		<div class="col-md-3 col-md-push-1" >
								<div class="form-group">
			<label class="control-label">City</label><span style="color:red">*</span>
			<input  name="city1" class="form-control" maxlength="25" type="text" placeholder="City" value="<?= set_value('city1',$reside->city); ?>" alt="Only 25 Character Allowed">
			</div>
		</div>

		<div class="col-md-3 col-md-push-1" >
									<div class="form-group">
			<label class="control-label">District</label><span style="color:red">*</span>
			<input  name="district1" class="form-control" maxlength="25" type="text" placeholder="District" value="<?= set_value('district1',$reside->district); ?>" alt="Only 25 Character Allowed">
			</div>
		</div>
		
		</div>

		<div class="row">						
		<div class="col-md-3 col-md-push-1" >
							<div class="form-group">
			<label class="control-label">Pincode</label><span style="color:red">*</span>
			<input id="pincode1" name="pincode1" class="form-control" placeholder="Pincode" type="number" value="<?= set_value('pin1',$reside->pincode); ?>">
			</div>
		</div>	
		<div class="col-md-3 col-md-push-1" >
								<div class="form-group">
			<label class="control-label">State</label><span style="color:red">*</span>
			<input id="state1" name="state1" class="form-control" placeholder="State" type="text" value="<?= set_value('state1',$reside->state); ?>">
		</div>
	</div>
	<div class="col-md-3 col-md-push-1" >
							<div class="form-group">
			<label class="control-label">Country</label><span style="color:red">*</span>
			<input  name="country1" class="form-control" maxlength="25" type="text"  value="<?= set_value('state1',$reside->country); ?>" alt="Only 25 Character Allowed">
		</div>
	</div>		
	</div>		
	
<h4 style="background-color:#68838B;color:#fff;padding:10px;">Address For Correspondence:</h4>


<div class="row">

<div class="col-md-9 col-md-push-1">
		<div class="form-group">
			<label class="control-label">Address </label><span style="color:red">*</span>
			<textarea id="address2" name="address2" placeholder="Address " class="form-control" rows="3"><?= set_value('address2',$corrs->address); ?></textarea>
			<span style="color:gray">Enter Address lines without Landmark,City,District,State,Pincode,Country</span>
		</div>
	</div>

	</div>

<div class="row">									
<div class="col-md-3 col-md-push-1" >
			<div class="form-group">
			<label class="control-label">Landmark</label><span style="color:red">*</span>
			<input  name="landmark2" id="landmark2" class="form-control" maxlength="25" type="text" placeholder="Landmark" value="<?= set_value('landmark2',$corrs->landmark); ?>" alt="Only 25 Character Allowed">
			</div>
		</div>
		<div class="col-md-3 col-md-push-1" >
			<div class="form-group">
			<label class="control-label">City</label><span style="color:red">*</span>
			<input  name="city2" class="form-control" maxlength="25" type="text" placeholder="City" value="<?= set_value('city2',$corrs->city); ?>" alt="Only 25 Character Allowed">
			</div>
		</div>
		<div class="col-md-3 col-md-push-1" >
			<div class="form-group">
			<label class="control-label">District</label><span style="color:red">*</span>
			<input  name="district2" class="form-control" maxlength="25" type="text" placeholder="District" value="<?= set_value('district2',$corrs->district); ?>" alt="Only 25 Character Allowed">
			</div>
		</div>
	
		
	</div>
	
	
	<div class="row">
	<div class="col-md-3 col-md-push-1" >
			<div class="form-group">
			<label class="control-label">Pincode</label><span style="color:red">*</span>
			<input id="pincode2" name="pincode2" class="form-control" placeholder="Pincode" type="number" value="<?= set_value('pin2',$corrs->pincode); ?>">
			</div>
		</div>
		<div class="col-md-3 col-md-push-1" >
		<div class="form-group">
			<label class="control-label">State</label><span style="color:red">*</span>
			<input id="state2" name="state2" class="form-control" placeholder="State" type="text" value="<?= set_value('state2',$corrs->state); ?>">
		</div>
	</div>
	<div class="col-md-3 col-md-push-1" >
		<div class="form-group">
			<label class="control-label">Country</label><span style="color:red">*</span>
			<input  name="country2" class="form-control" maxlength="25" type="text"  value="<?= set_value('state2',$corrs->country); ?>" alt="Only 25 Character Allowed">
		</div>
	</div>
	</div>

</div>

</div>
	<div class="row"></div>
													 
							<div class="text-center">
								<button type="submit" class="btn blue">
									<i class="fa fa-check"></i> Update
								</button>
								<a type="button" class="btn default" href="<?php echo base_url('admin/users');?>">Cancel</a>
							</div>
							<!-- <div class="row">
								<div class="col-md-2">
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Update</button>
								</div>
								<div class="col-md-2">
									<a type="button" class="btn default" href="<?php echo base_url('admin/dealer');?>">Cancel</a>
								</div>
							</div> -->
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
 
$this->load->view ( 'admin/_includes/footer', $data );
?>
<script>
  $(function() {
    $('#notify_sms').bootstrapToggle();
  });
  $(function() {
    $('#notify_email').bootstrapToggle();
  });
</script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
	//CKEDITOR.replace( 'editor1' );
	$(".my-datepicker").datepicker({ 
        minDate: 0,
        format: "yyyy-mm-dd",
        changeMonth: true,
        changeYear: true,
		endDate: new Date(),
        yearRange: '-100:0'
    });
</script>