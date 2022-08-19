
<?php 
	$this->load->view('site/_includes/header');
?>
<style>
.fade {
    opacity: 1;
 
}
.p-b-20 {
    padding-top: 10px;
    padding-bottom: 10px;
    
}
.sale-noti1 {
	color:#e65540;
}
</style>   
    <!--================Home Banner Area =================-->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-20 p-l-15-sm">
	<a href="<?php echo base_url('profile'); ?>"> <img alt=""	class="img-circle"
		src="<?php echo upload_path; ?>profile/<?=$_SESSION['user_profile']->image;?>" />
		<span class="username username-hide-on-mobile"> <?php echo $this->session->userdata('first');?> </span>
	</a>	
	</div>
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-10 p-l-15-sm">
	
	<a href="<?php echo base_url(''); ?>" class="s-text16"> Home
		<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17"> User Profile </span>
	</div>
	 
	<!-- Content page -->
	<section class="bgwhite p-b-10">
		<div class="col-md-12">
			<div class="row">
				<div class="col-sm-6 col-md-3 col-lg-3 ">
					<div class="leftbar p-r-20 p-r-0-sm">
			    		<!--  -->
						<h4 class="m-text14 p-b-7">
							My Account
						</h4>
	 					<ul class="p-b-54">

							<li class="p-t-4 p-b-20" style="font-size: 18px;">
								<a href="" onclick="return my_profile_section();" id="profile_section" class="sale-noti1 list-group-item " style="font-size: 18px;">
								 <i class="fa fa-user"></i> Profile
								 </a>
							</li>
							
							<li class="p-t-4 p-b-20">
								<a href="javascript:void(0);"  onclick="profile_my_order()" id="my_order_section" class="list-group-item" style="font-size: 18px;">
									<i class="fa fa-users"></i> Family
								</a>
							</li>
							
							<li class="p-t-4 p-b-20">
								<a href="javascript:void(0);" onclick="profile_change_password();" id="change_password_section"  class="list-group-item" style="font-size: 18px;">
									<i class="fa fa-key"></i> Change Password
								</a>
							</li>

							<!-- <li class="p-t-4 p-b-20">
								<a href="<?php echo base_url('site/logout');?>"   class="list-group-item" style="font-size: 18px;">
									<i class="fa fa-sign-out"></i> Log out
								</a>
							</li> -->
							
						</ul>

					</div>
				</div>

				<div class="col-sm-6 col-md-9 col-lg-9 ">

				<section class="bgwhite tab-pane" id="display_div">
				</section>
				<section class="bgwhite tab-pane" id="profile_section_div">
					<div class="container">
					<div class="row">
						<div class="col-md-8 col-lg-12 ">
							<div class="p-r-50 p-r-0-lg">
							<div class="p-b-40">
								<div class="blog-detail-txt p-t-33">
									<div class="row">
										<div class="col-md-5">
											<h4 class="p-b-11 m-text24">
												My Profile:
											</h4>
										</div>
										
										<div class="col-md-5">
											<button class="flex-c-m sizefull bg1 bo-rad-20 hov1 s-text1 trans-0-4" onclick="edit_profile();" href="javascript:void(0);" style="width: 50%; float: right; height: 40px;">
											Edit Profile
											</button>
										</div>
									</div>
									<hr> </hr>
									<div class="portlet-body">
									<div class="form-body">
									
									<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Foundation Name : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> 
													<?php if($user_profile->foundation == ''){ echo 'NA'; }else{ echo $user_foundation->foundation_name; } ?>  </label>
											</div>
										</div><div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>First Name : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile->first; ?>  </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Middle Name : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile->middle; ?>  </label>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Last Name : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile->last; ?>  </label>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Mobile : </b></label>
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"><?= $user_profile->contact; ?></label>
											</div>
										</div> 
							
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Email : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
											<label class="profile-label"><?php if($user->email == ''){ echo 'NA'; }else{ echo $user->email; } ?>  </label>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Gender : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile->gender ? : 'NA'; ?> </label>
											</div>
										</div>
							
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Marital Status : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> 
												<?php
                                            $table = 'marital_status';
                                            $where = array('id' => $user_profile->marital_status);
                                            $marital_statusd= $this->user_model->get_common($table, $where,'*',1);

											 if($user_profile->marital_status == ''){ echo 'NA'; }else{$user_profile->marital_status==$marital_statusd->id; echo $marital_statusd->marital_status_name; } ?> </label>
											</div>
										</div>	

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Mother Tounge : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> 
												<?php
                                            $table = 'language';
                                            $where = array('id' => $user_profile->language);
                                            $language= $this->user_model->get_common($table, $where,'*',1);

											 if($user_profile->language == ''){ echo 'NA'; }else{$user_profile->language==$language->id; echo $language->language_name; } ?> </label>
											</div>	
										</div>	
										
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Date of Birth : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile->date_of_birth; ?> </label>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Religion : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> 
												<?php
                                            $table = 'religion';
                                            $where = array('id' => $user_profile->religion);
                                            $religion= $this->user_model->get_common($table, $where,'*',1);

											 if($user_profile->religion == ''){ echo 'NA'; }else{$user_profile->religion==$religion->id; echo $religion->religion; } ?> </label>
											</div>		
											</div>
										
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Caste : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> 
												<?php
										 echo $caste->caste_name;  ?> </label>
											</div>		
										</div>	
										
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Sub Caste : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $caste->sub_caste_name; ?> </label>
											</div>
										</div>
										<h4 class="p-b-11 m-text12" style="color:#000;">
										Permanent / Residential Address :
											</h4>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Address : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $resident_address->address; ?> </label>
											</div>
										</div>
											
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Landmark : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $resident_address->landmark; ?> </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>City : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $resident_address->city; ?> </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>District : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $resident_address->district; ?> </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Pincode : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $resident_address->pincode; ?> </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>State : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $resident_address->state; ?> </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Country : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $resident_address->country; ?> </label>
											</div>
										</div>
										<h4 class="p-b-11 m-text12" style="color:#000;">
										Address For Correspondence:
											</h4>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Address : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
											<label class="profile-label"><?php if($correspondence_address->address == ''){ echo 'NA'; }else{ echo $correspondence_address->address; } ?>  </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Landmark : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
											<label class="profile-label"><?php if($correspondence_address->landmark == ''){ echo 'NA'; }else{ echo $correspondence_address->landmark; } ?>  </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>City : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
											<label class="profile-label"><?php if($correspondence_address->city == ''){ echo 'NA'; }else{ echo $correspondence_address->city; } ?>  </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>District : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
											<label class="profile-label"><?php if($correspondence_address->district == ''){ echo 'NA'; }else{ echo $correspondence_address->district; } ?>  </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Pincode : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
											<label class="profile-label"><?php if($correspondence_address->pincode == ''){ echo 'NA'; }else{ echo $correspondence_address->pincode; } ?>  </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>State : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
											<label class="profile-label"><?php if($correspondence_address->state == ''){ echo 'NA'; }else{ echo $correspondence_address->state; } ?>  </label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"><b>Country : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
											<label class="profile-label"><?php if($correspondence_address->country == ''){ echo 'NA'; }else{ echo $correspondence_address->country; } ?>  </label>
											</div>
										</div>
										
									</div>
									<hr> </hr>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div> 
					</div> 
				</section>

				</div>

			</div>
		</div>
	</section>
    <!--================End Category Product Area =================-->

<?php 
	$this->load->view('site/_includes/footer');
?>

<script>
  
	function my_profile_section()
	{ 
		//alert("hi");
		$("#profile_section").addClass('sale-noti1');
		$('#profile_section_div').show();
		$("#cart_section").removeClass('sale-noti1');
		$("#wishlist_section").removeClass('sale-noti1');
		$("#my_order_section").removeClass('sale-noti1');
		$("#change_password_section").removeClass('sale-noti1');
		$('#display_div').hide();
	}

	function edit_profile()
	{
		$.ajax({
			url:'<?= base_url("site/edit_user_profile/"); ?>',
			 type:'POST',
			data:{'id':''},
			success: function(data)
			{
				$('#profile_section_div').hide();
				$('#display_div').show();
				$('#display_div').html('');
				$('#display_div').append(data);
			}
		});
	}

	function profile_my_order()
	{
		$("#my_order_section").addClass('sale-noti1');
		$("#wishlist_section").removeClass('sale-noti1');
		$("#cart_section").removeClass('sale-noti1');
		$("#profile_section").removeClass('sale-noti1');
		$("#change_password_section").removeClass('sale-noti1');
			 
	 	$.ajax({
			url:'<?= base_url("site/family_profile/");?>',
			type:'POST',
			data:{'id':''},
			success: function(data)
			{
				//alert(data);
				$('#profile_section_div').hide();
				$('#display_div').show();
				$('#display_div').html('');
				$('#display_div').append(data);
			}
		});
	}
	function edit_family(id)
	{
		$("#my_order_section").addClass('sale-noti1');
		$("#wishlist_section").removeClass('sale-noti1');
		$("#cart_section").removeClass('sale-noti1');
		$("#profile_section").removeClass('sale-noti1');
		$("#change_password_section").removeClass('sale-noti1');
			 
	 	$.ajax({
			url:'<?= base_url("site/edit_family_member/");?>',
			type:'POST',
			data:{'id':id},
			success: function(data)
			{
				//alert(data);
				$('#profile_section_div').hide();
				$('#display_div').show();
				$('#display_div').html('');
				$('#display_div').append(data);
			}
		});
	}
	function profile_change_password()
	{
		$("#change_password_section").addClass('sale-noti1');
		$("#my_order_section").removeClass('sale-noti1');
		$("#wishlist_section").removeClass('sale-noti1');
		$("#cart_section").removeClass('sale-noti1');
		$("#profile_section").removeClass('sale-noti1');
			 
	 	$.ajax({
			url:'<?= base_url("site/change_password/"); ?>',
			type:'POST',
			data:{'id':''},
			success: function(data)
			{
				//alert(data);
				$('#profile_section_div').hide();
				$('#display_div').show();
				$('#display_div').html('');
				$('#display_div').append(data);
			}
		});
	}
	function update_user()
	{ 	 
	 
	    var myform = document.getElementById("update_user_form");
		var fd = new FormData(myform);
		$.ajax({
		  url: "<?php echo base_url('site/update_user');?>",
		  type: "POST",
		  data: fd,
		  cache: false,
		  processData: false,  // tell jQuery not to process the data
		  contentType: false,   // tell jQuery not to set contentType
			success: function (data) {
				// alert(data);
				if(data==1){
			 	  swal("Success", "Profile Updated Successfully..", "success");
				  setTimeout(function(){ 
					location.reload();
				  }, 3000);
					
				} 
				else{
				 $('#display_div').html('');
				$('#display_div').append(data);
				}
			}
		});  
	}

	function update_family_user()
	{ 	 
	 
	    var myform = document.getElementById("update_family_user_form");
		var fd = new FormData(myform);
		$.ajax({
		  url: "<?php echo base_url('site/update_family_user');?>",
		  type: "POST",
		  data: fd,
		  cache: false,
		  processData: false,  // tell jQuery not to process the data
		  contentType: false,   // tell jQuery not to set contentType
			success: function (data) {
				// alert(data);
				if(data==1){
			 	  swal("Success", "Profile Updated Successfully..", "success");
				  setTimeout(function(){ 
					location.reload();
				  }, 3000);
					
				} 
				else{
				 $('#display_div').html('');
				$('#display_div').append(data);
				}
			}
		});  
	}
	
	function change_password()
	{ 	 
	 
	    var myform = document.getElementById("change_password_form");
		var fd = new FormData(myform);
		$.ajax({
		  url: "<?php echo base_url('site/update_password');?>",
		  type: "POST",
		  data: fd,
		  cache: false,
		  processData: false,  // tell jQuery not to process the data
		  contentType: false,   // tell jQuery not to set contentType
			success: function (data) {
				 //alert(data);
				if(data==1){
			 	  swal("Success", "Password Reset Successfully..", "success");
				 setTimeout(function(){ 
					location.reload();
				  }, 2000);
				}else if(data==2){
			 	  swal("Error", "Current Password Incorrect..", "error");
					 
				}
				else{
				$('#display_div').html('');
				$('#display_div').append(data);
				}
			}
		});  
	}
	 
	
</script>