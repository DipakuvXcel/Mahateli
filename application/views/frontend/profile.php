
<?php 
	$this->load->view('frontend/_includes/header');
?>
<style>
.fade {
    opacity: 1;
 
}
.p-b-20 {
    padding-top: 10px;
    padding-bottom: 10px;
    
}
.sale-noti1{
	color:#e65540;
}
</style>   
    <!--================Home Banner Area =================-->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16"> Home
		<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17"> User Profile </span>
	</div>
	 
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-10">
		<div class="col-md-12">
			<div class="row">
				<div class="col-sm-6 col-md-3 col-lg-3 ">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							My Account
						</h4>
	 					<ul class="p-b-54">

							<!--<li class="p-t-4 p-b-20">
								<a href="#"  id="account_section" class="list-group-item  <?= $active =='home'?'sale-noti':''; ?>" style="font-size: 18px;">
									<i class="fa fa-tachometer"></i> Account
								</a>
							</li>-->
							  
							<li class="p-t-4 p-b-20" style="font-size: 18px;">
								<a href="javascript:void(0);" onclick="my_profile_section();" id="profile_section" class="sale-noti1 list-group-item " style="font-size: 18px;">
								 <i class="fa fa-user-o"></i> Profile
								 </a>
							</li>
							
							<li class="p-t-4 p-b-20 " >
								<a href="javascript:void(0);" onclick="profile_cart()" id="cart_section"  class="list-group-item" style="font-size: 18px;">
									<i class="fa fa-shopping-cart"></i> Cart
								</a>
							</li>
							
							<!--<li class="p-t-4 p-b-20" >
								<a href="javascript:void(0);" onclick="profile_wishlist()" id="wishlist_section"  class="list-group-item" style="font-size: 18px;">
									<i class="fa fa-heart"></i> WishList
								</a>
							</li>-->
							
							<li class="p-t-4 p-b-20">
								<a href="javascript:void(0);"  onclick="profile_my_order()" id="my_order_section" class="list-group-item" style="font-size: 18px;">
									<i class="fa fa-history"></i> My Orders
								</a>
							</li>
							
							<li class="p-t-4 p-b-20">
								<a href="javascript:void(0);" onclick="profile_change_password();" id="change_password_section"  class="list-group-item" style="font-size: 18px;">
									<i class="fa fa-history"></i> Change Password
								</a>
							</li>
							
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
									<div class="row m-b-30">
										<div class="col-md-5">
											<h4 class="p-b-11 m-text24">
												My Profile:
											</h4>
										</div>
										<div class="col-md-5">
											<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" onclick="edit_profile();" href="javascript:void(0);" style="width: 50%; float: right; height: 40px;">
											Edit Profile
											</button>
										</div>
									</div>
									<hr> </hr>
									<div class="portlet-body">
									<div class="form-body">
									
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>Name : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile[0]->name; ?>  </label>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>Phone : </b></label>
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"><?= $user_profile[0]->contact; ?></label>
											</div>
										</div> 
							
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>Email : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile[0]->email; ?> </label>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>GST Number : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile[0]->gst ? : 'NA'; ?> </label>
											</div>
										</div>
							
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>Address 1 : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile[0]->address1; ?> </label>
											</div>
										</div>	

										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>Address 2 : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile[0]->address2 ? : 'NA'; ?> </label>
											</div>
										</div>	
										
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>State : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile[0]->state; ?> </label>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>City : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile[0]->city; ?> </label>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>Postal Code : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $user_profile[0]->pincode; ?> </label>
											</div>
										</div>	
										
										<!--
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>Profie Picture : </b></label> 
													</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> 
												<?php if($user_profile[0]->image){?> 
												<img src="<?php if($user_profile[0]->image!=""){ echo base_url().'site_data/uploads/user/'.$user_profile[0]->image;  }else { echo base_url().'site_data/uploads/user/cust.png'; }?>" style="    width: 30%;" alt="IMG" class="profile-img">
												<?php }else{ echo 'NA';} ?>
												</label>
											</div>
										</div>
										
										
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>Birthday: </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?php if($user_profile[0]->birth == '0000-00-00'){ echo 'NA'; }else{ echo $user_profile[0]->birth; } ?> </label>
											</div>
										</div>	
										
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label"><b>Anniversary: </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?php if($user_profile[0]->ani == '0000-00-00'){ echo 'NA'; }else{ echo $user_profile[0]->ani; } ?> </label>
											</div>
										</div>	
										-->
									</div>
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
	$this->load->view('frontend/_includes/footer');
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

	function profile_cart()
	{
		$("#cart_section").addClass('sale-noti1');
		$("#profile_section").removeClass('sale-noti1');
		$("#wishlist_section").removeClass('sale-noti1');
		$("#my_order_section").removeClass('sale-noti1');
		$("#change_password_section").removeClass('sale-noti1');
		$.ajax({
			url:'<?= base_url("frontend/profile_cart/"); ?>',
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

	function profile_wishlist()
	{
		$("#wishlist_section").addClass('sale-noti1');
		$("#cart_section").removeClass('sale-noti1');
		$("#profile_section").removeClass('sale-noti1');
		$("#my_order_section").removeClass('sale-noti1');
		$("#change_password_section").removeClass('sale-noti1');
		$.ajax({
			url:'<?= base_url("frontend/profile_wishlist/"); ?>',
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

	function edit_profile()
	{
		$.ajax({
			url:'<?= base_url("frontend/edit_user_profile/"); ?>',
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
			url:'<?= base_url("frontend/family_profile/");?>',
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
	function profile_change_password()
	{
		$("#change_password_section").addClass('sale-noti1');
		$("#my_order_section").removeClass('sale-noti1');
		$("#wishlist_section").removeClass('sale-noti1');
		$("#cart_section").removeClass('sale-noti1');
		$("#profile_section").removeClass('sale-noti1');
			 
	 	$.ajax({
			url:'<?= base_url("frontend/change_password/"); ?>',
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
		  url: "<?php echo base_url('frontend/update_user');?>",
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
				  }, 2000);
					
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
		  url: "<?php echo base_url('frontend/update_password');?>",
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