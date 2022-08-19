<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyFuel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
 
  <link rel="stylesheet" href="<?php echo assets_path; ?>css/util.css" />
  <style>
  .p-b-3{
	  padding-bottom: 3%;
  }
   .m-t-8{
	  margin-top: 5%;
  }
  .myfuellink{
	float: right;
	font-weight: 600;
    margin-bottom: 1%;
	color:#fff;
}
  @media (max-width: 768px){
	.p-b-3{
	  padding-bottom: 0%;
  }
   

.myfuellink{
	float: right;
    font-weight: 600;
    margin-bottom: 4%;
}
}
  </style>
  <style type="text/css">
.bs-example{
	font-family: sans-serif;
	position: relative;
	margin: 50px;
}
 
.typeahead {
	background-color: #FFFFFF;
	
}
.twitter-typeahead{
	width: 100%;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
	color: #999999;
	display: none;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 5px;
	padding: 8px 0;
	width: 100%;
}
.tt-suggestion {
	font-size: 16px;
	line-height: 20px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
	color: #000;
} 
pre{background-color:transparent;border-radius:0px;margin:0px;padding:0px;border:0px;}
.w-size2 {
    width: 160px;
}
</style>
</head>
<body style="background-color:#000; ">

<div class="container-fluid"  >
	<div class="row">
	<div class="col-md-2">
	<a href="javacsript:void(0);" class="logo">
		 <img style="max-height: 65px;" src="<?php echo assets_path; ?>img/logo.png" class=" header-icon1" alt="ICON">
	</a>
	</div>
	<div class="col-md-3 col-md-push-2" style=" margin-top: 2%;">
	
	<a class="myfuellink" href="<?php echo base_url('home'); ?>" class="logo">For Detail Product Information Click This Link</a>
	</div>
	</div>
	<div class="row">
     
    <div class="col-sm-5 col-sm-push-1 " style="  padding:1% ">
	<div class="row text-center" style="margin-top: 3%;">
	</div>
	<a class="block2-name hov-img-zoom dis-block s-text3 p-b-5" style="border: 2px solid #fff;box-shadow: 0px 0px 5px 2px #fff;">
		<img class = "img-responsive" src="<?= assets_path.'img/offer.png'; ?>" alt="IMG-PRODUCT">
	</a>
	<div class="row text-center" style="margin-top: 3%;">
	 <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong">
		  Enroll Here
	 </button>
	</div> 
	</div> 
	
    <div class="col-sm-5 col-sm-push-1" style=" padding:1% ">
	<div class="row text-center" style="margin-top: 3%;">
	
	</div>
	<a class="block2-name hov-img-zoom dis-block s-text3 p-b-5" style="border: 2px solid #fff;box-shadow: 0px 0px 5px 2px #fff;">
		<img class = "img-responsive" src="<?= assets_path.'img/offer2.png'; ?>" alt="IMG-PRODUCT">
	</a>
	<div class="row text-center" style="margin-top: 3%;">
	 <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong">
		  Enroll Here
	 </button>
	</div> 
	</div>
	</div>
	 
  </div>
  
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body" style="min-height: 420px;">
      	 
		 <h3 style="text-align: center;">To avail this offer enroll here</h3>
		 <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding: 4px 10px 4px 10px;margin-top: -6%; background-color:#000; opacity: 0.8; ">
          <span aria-hidden="true" style="color: white;">&times;</span>
        </button>
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
				  
				<form   id="save_guest_user_form"   action="<?php echo base_url('frontend/save_offer_page');?>"  method="post" autocomplete="off">
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-5  text-center m-t-20">
								 
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
									<label for="exampleInputPassword18" style="float: left;">GST Number</label>
									<input type="text" style="border: 1px solid #989898 !important;"  name="gst" class="form-control" id="gst" placeholder="GST Number" value="<?= set_value('gst'); ?>" />
								</div>
								
							
								<div class="form-group">
									<label for="exampleInputPassword17" style="float: left;">Select Offer</label><span style="color:red;float: left;">*</span>
									<select  class="form-control" id="product_offer"  name="product_offer"   value="<?= set_value('product_offer'); ?>" >
									<option value="">Select Offer</option>
									 <?php 
										
										for($i=0;$i<count($products);$i++){
										?>
										 <option value="<?=$products[$i]->product_id?>" <?php if(set_value('product_offer')==$products[$i]->product_id) echo 'selected'; ?>><?=$products[$i]->product_name?></option>
										<?php } ?>
									</select>
								</div>
								 
								 
							</div>
					 
							<div class="col-md-5 text-center m-t-20">
								
								<div class="form-group">
									<label for="exampleInputPassword13" style="float: left;">Address Line 1</label><span style="color:red;float: left;">*</span>
									<input type="text" name="address_line1" id="address_line1" style="border: 1px solid #989898 !important;" class="form-control" id="address_line1" placeholder="Address Line 1" value="<?= set_value('address_line1'); ?>" />
								</div>
							  
								<div class="form-group">
									<label for="exampleInputPassword14" style="float: left;">Address Line 2</label> 
									<input type="text" name="address_line2" id="address_line2" style="border: 1px solid #989898 !important;" class="form-control" id="address_line2" placeholder="Address Line 2" value="<?= set_value('address_line2'); ?>">
								</div>

								<div class="form-group">
									<label for="exampleInputPassword16" style="float: left;">State</label><span style="color:red;float: left;">*</span>
									<input type="text"  style="border: 1px solid #989898 !important;" name="state" class="form-control state" id="state" placeholder="State" value="<?= set_value('state'); ?>" />
								</div>
								
								<div class="form-group">
									<label for="exampleInputPassword15" style="float: left;">City</label><span style="color:red;float: left;">*</span>
									<input type="text"   style="border: 1px solid #989898 !important;"  name="city" class="form-control city" id="city" placeholder="City" value="<?= set_value('city'); ?>" />
								</div>

			
								<div class="form-group">
									<label for="exampleInputPassword17" style="float: left;">Pincode</label><span style="color:red;float: left;">*</span>
									<input type="number" style="border: 1px solid #989898 !important;"  name="pincode" class="form-control pincode" id="pincode" placeholder="Pincode" value="<?= set_value('pincode'); ?>" />
								</div>
						 	 
							<div class="form-group">
									<label for="exampleInputPassword17" style="float: left;">Get Delivery ON</label><span style="color:red;float: left;">*</span>
									<select  class="form-control" id="get_delivery"  name="get_delivery"   value="<?= set_value('get_delivery'); ?>" >
									<option value="">Select </option>
									<option value="1" <?php if(set_value('get_delivery')==1) echo 'selected'; ?>>Monthly </option>
									<option value="2" <?php if(set_value('get_delivery')==2) echo 'selected'; ?>>Quarterly </option>
									<option value="3" <?php if(set_value('get_delivery')==3) echo 'selected'; ?>>One Time Delivery </option>
									 
									</select>
								</div>
							 
								  <input type="checkbox" style=" " name="teamcondition" id="teamcondition">
									<label for="exampleInputPassword17" >Check Terms & Conditions</label> 
									
								 
								<a href="javascript:void(0);" title=" We need to mention the T&C like: 
									A) Premium Gym Membership Value upto 10000 for single and 18000 for couple inclusive of Taxes. 
									B) Gym Membership Bill to be taken in the name M/s. Kiran Pharmaceutical only. 
									C) No Return or Exchange Policy. 
									D) Need to make total payment with enrolment." style="float: right;" onclick="term();">Term & Conditions</a> 
								</div>
						
							
						</div> 
						<div class="row" >
								 
								<div class="w-size2 p-t-20 col-md-2 col-md-push-4 col-xs-push-0 col-xs-2" >
									<button type="submit" class="flex-c-m size2 bg44 bo-rad-23 hov1 m-text3 trans-0-4" > Submit </button>
								</div> 
								
								<div class="w-size2 p-t-20 col-md-2  col-xs-2 col-md-push-4 col-xs-push-0" >
									<button type="reset" class="flex-c-m size2 bg1-overlay bo-rad-23   m-text3 trans-0-4" > Reset </button>
								</div> 
								<div class="col-lg-4" > </div>
					 </div> 
			  </form>
	   </div>
       	
    </div>
  </div>
</div>
</div>

</body>
</html>
 
 <script src="<?php echo assets_path; ?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?php echo assets_path; ?>js/typeahead.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="<?php echo assets_path; ?>vendor/sweetalert/sweetalert.min.js"></script>
  <script type="text/javascript">
    $(window).on('load',function(){
		 setTimeout(function(){ 
		 $('#exampleModalLong').modal('show'); }, 4000);
    });
</script>
 <script>
 
 function term(){
	 var a="A) Premium Gym Membership Value upto 10000 for single and 18000 for couple inclusive of Taxes.\B) Gym Membership Bill to be taken in the name M/s. Kiran Pharmaceutical only.\C) No Return or Exchange Policy. D) Need to make total payment with enrolment.";
	 swal("Term & Conditions", a, "");
 }
   	var state_val='';
	$(document).ready(function(){
	
		$('input.state').on("blur", function(){
		  state_val=$('#state').val();
		     
		$('input.city').typeahead({
			name: 'city',
			remote:"<?php echo base_url('frontend/city_name?key=%QUERY&state=');?>"+state_val,
			limit : 10
		});
		
		});
		
		$('input.state').typeahead({
			name: 'state',
			remote:"<?php echo base_url('frontend/state_name?key=%QUERY');?>",
			limit : 10
		});
		$('input.pincode').typeahead({
			name: 'pincode',
			remote:"<?php echo base_url('frontend/pincode?key=%QUERY');?>",
			limit : 10
		});
});

/* 
function save_guest_user()
	{ 	 
	 //alert("hi");
	    var myform = document.getElementById("save_guest_user_form");
		var fd = new FormData(myform);
		$.ajax({
		  url: "<?php echo base_url('frontend/save_offer_page');?>",
		  type: "POST",
		  data: fd,
		  cache: false,
		  processData: false,  // tell jQuery not to process the data
		  contentType: false,   // tell jQuery not to set contentType
			success: function (data) {
				//  alert(data);
				if(data==1){
			 	  swal("Success", "Profile Updated Successfully..", "success");
				  setTimeout(function(){ 
					location.reload();
				  }, 2000);
					
				}
				else if(data==0){
					location.reload();
			 	 $('#exampleModalLong').close();
			 	 $('#exampleModalLong').modal('show');
				 } 
				else{$('#exampleModalLong').modal('show');
				 swal("Error", "Error To Add Data", "error");
				}
			}
		});  
	} */
  
  </script>
