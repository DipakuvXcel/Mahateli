<?php 
	$this->load->view('frontend/_includes/header');
	$this->load->helper('custom');
?>
 
	
<style>
.fade {
    opacity: 1;
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

  
.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
  line-height: 1
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

input[type=text] {
  width: 100%;
  line-height: 1.5;
  margin-bottom: 10px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
input[type=number] {
  width: 100%;
  line-height: 1.5;
  margin-bottom: 10px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

 span{
	 font-weight:600;
 }
 @media (min-width:420px ) {
 .margl{
	 margin-left: 120px;
 }
 .textr{
	text-align: right;
 }
 } 
 
 @media (max-width:420px ) {
 .margt{
	 margin-top: 13px;
 }
 }
 @media (min-width: 992px){ 
.col-lg-3 {
    
    flex: 0 0 23%;
 }
 }
 .offerhov:hover{
	 	 border: 1px solid;;
 }
</style>
	
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/myFuelO1.png);">
		<h2 class="l-text2 t-center">
			Checkout
		</h2>
	</section>
 
 <!--================Home Banner Area =================-->
 
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
			Checkout
		</span>
	</div>
    <!--================End Home Banner Area =================-->
	
	<section class="product_description_area p-t-10 p-b-60">
	<div class="container">
	<div class="row">
	
	<?php   if($this->session->userdata('user_profile') !='' || $this->session->userdata('guest_user_profile') !=''){ ?>
	
	  <div class="col-md-8 p-r-o col-md-sm-2 m-b-40" >
	  
	  
	  
	  <div  id="card_id_refresh">
	  <div class="p-t-20 m-t-20 p-b-20 p-r-20  p-l-20 " style="box-shadow: 0px 0px 4px #c3c3c3;">
		<div class="m-t-10">
			 
		</div>
	   <h4 style="float:left;"><h4 style="float:left;"></h4><span class="price m-b-20" style="    float: right;color:black"><i class="fa fa-shopping-cart"></i> <b><?=count($tbl_cart)?></b></span></h4>
		<table class="table    table-responsive  table-hover" id="managed_datatable">
			<thead>
				<tr>
					<th>Product</th>
					<th>Name</th>
					<th style="width:18%;">Price (RS) </th>
					<th>Qty</th>
					
					<th style="width:18%;">Total (RS) </th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$total_price_head=0;
				$total_qty=0;
				for($k=0;$k<count($tbl_cart);$k++){
					//$total_price_head+=$tbl_cart[$k]->price;
					
					$where = array('product_id' =>$tbl_cart[$k]->product_id);
					$pro_details = $this->user_model->get_common('products', $where,'*',2,'','','','');
					$category=$pro_details[0]->main_category;
					$sub_category=$pro_details[0]->sub_category;
					$product_name=$pro_details[0]->product_name;
					$flavour=$pro_details[0]->flavour;
					$weight=$pro_details[0]->weight;
								
					$gst=$tbl_cart[$k]->price*($tbl_cart[$k]->gst/100);
					$total_price_head += $tbl_cart[$k]->price*$tbl_cart[$k]->quantity;
					
					$total_qty +=$tbl_cart[$k]->quantity;
				?>
				<tr class="odd gradeX">
					<td>
						<a href="<?php echo base_url('product-details/'.$tbl_cart[$k]->product_id); ?>" > <img src="<?=base_url();?>/site_data/uploads/product_profile/<?=$tbl_cart[$k]->image;?>"  width="40" height ="40" class="cart-image" style="margin-left: "/> </a>
					</td>
					<td>
						<a href="<?php echo base_url('product-details/'.$tbl_cart[$k]->product_id); ?>" > <b><?=$tbl_cart[$k]->product_name?><br></b><?php echo get_subcat_name($sub_category);?>&nbsp<?php echo get_cat_name($category);?> </a>
					</td>
					<td class="column-3"> <?=$tbl_cart[$k]->price?></td>
						<?php  if($tbl_cart[$k]->launch_offer==1){   ?>
							<td class="column-3">
							<?php
							if($tbl_cart[$k]->product_id==27 || $tbl_cart[$k]->product_id==28){ echo "10";}
							if($tbl_cart[$k]->product_id==29 || $tbl_cart[$k]->product_id==30){ echo "20";}
							?>
							 
							</td>
							<?php } else  if($tbl_cart[$k]->offer_id!=0){ ?>
							<td class="column-3">
							<?=$tbl_cart[$k]->quantity?>
							</td>
							<?php } else{  ?>
					<td class="column-3"><?=$tbl_cart[$k]->quantity?></td>
							<?php } ?>
					<td class="column-4 total_amt"> <?=$tbl_cart[$k]->price*$tbl_cart[$k]->quantity?></td>
				</tr>
			<?php } ?>
		 
			<tr class="odd gradeX">
			<td></td>
				<td>Sub Total</td>
				 <td></td>
				<td></td>
				<td>RS.&nbsp; <?php echo number_format($total_price_head,2);?></td>
			</tr>
			<?php if($coupon_discount && $coupon_discount > 0){ ?>
			<tr class="odd gradeX">
				 
				<td colspan="4">Coupon - <span><?=$coupon_code?><br>
				<span style="color:#0ac30a;">  applied successfully!</span><br>
				<button class="btnRemoveAction" onclick="remove_coupon();" title="Remove Item" style="color: red;">Remove Coupon <i class="fa fa-trash" aria-hidden="true" ></i>
				 </button>
				</td>
	
				<?php 
				$discount_amt = round($total_price_head *($coupon_discount/100));
                $final_total = $total_price_head - $discount_amt;	
				?>
				<td><?php echo "Rs. -".$discount_amt." (".$coupon_discount."%)";?></td>
			</tr>
				<tr class="odd gradeX">
				<td></td>
					<td><b><br>Final Total</b></td>
					
					<td></td>
					<td></td>
					<td><br><b> RS.&nbsp; <?php echo number_format($final_total,2);?></b></td>
				</tr>
			<?php } else{
					$final_total = $total_price_head;
				?>
				<tr class="odd gradeX">
				<td></td>
					<td><b><br>Total</b></td>
					
					<td></td>
					<td></td>
					<td><br><b> RS.&nbsp; <?php echo number_format($final_total,2);?></b></td>
				</tr>	
			<?php } ?>
		</tbody>
		</table>
		 
		<?php if(!$coupon_discount && $coupon_discount <= 0){ ?>
			
			<form name="frm_user_detail"  action="<?php echo base_url('frontend/checkout'); ?>" method="POST">
				<div class="row  m-b-20  margl">
				<div class=" bo4 m-r-10 col-lg-4 col-md-4 col-sm-4 col-xs-12"style="    height: 47px;">
					<input class="sizefull s-text7 p-l-22 p-r-22 form-control" type="text" id="hidden_coupon_code" name="hidden_coupon_code" placeholder="Coupon Code" >
				</div>
				<div class=" trans-0-4 col-lg-4 col-md-4 col-sm-4 col-xs-12 m-b-10 m-r-10 margt" >
					<button type="submit" class="btn flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" style="line-height: 1.8;border-radius: 12px;">
						Apply coupon
					</button>
				</div>
				</div>
			</form>	
			
		<?php } ?> 
		 
			 
			
			<div class="row">
				<!--<div class="col-lg-6 col-md-6 col-sm-6 ">
					<a class="color0" href="<?= base_url('products') ?>">Continue Shopping</a>
				</div>-->
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
					<a class="color0 hov1 btn" href="<?= base_url('cart') ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i> Go To Cart</a></h3>		
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6  col-xs-6 textr">
					<a class="color0 hov1 btn" href="<?= base_url('products') ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i> Continue Shopping</a></h3>		
				</div> 
			</div>
	   </div>
	   </div>
	   </div>

		<?php } else{ ?>
		<div class="col-sm-6 col-md-2 col-lg-2 p-b-50">
		</div>		
		<div class="col-sm-6 col-md-9 col-lg-9  text-center" style="box-shadow: 0px 0px 4px #c3c3c3;">
		<div class="row">
		<div class="col-sm-6 col-md-6 col-lg-6 p-b-50 p-t-30 text-center" style="background: #dbdbdb;">
			<div class="formd" >
				<form id="registration_form" action="<?php echo base_url('frontend/do_login_checkout');?>"  method="post" autocomplete="off">
					<h3 class="m-b-40">ACCOUNT LOGIN</h3>
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
					
					<div class="text-center m-t-20 m-l-40 m-r-40  ">

						<div class="form-group">
							<label for="email_id" style="float: left;">Email-Id / Mobile Number</label><span style="color:red;float: left;">*</span>
							<input type="text" style="border: 1px solid #989898 !important;" class="form-control" id="email_id" name="email_id" placeholder="Enter Email-Id / Mobile Number" value="<?= set_value('email_id'); ?>" />
						</div>
						
						<div class="form-group">
							<label for="password" style="float: left;">Password</label><span style="color:red;float: left;">*</span>
							<input type="password" style="border: 1px solid #989898 !important;" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value('email_id'); ?>" />
						</div>
						<div class="row" >
							<div class="p-t-20 col-md-12" >
								<button type="submit" class="flex-c-m size1 bg44 bo-rad-23 hov1 m-text1 trans-0-4" > LogIn </button>
							</div> 
							<!--<div class="p-t-20 col-lg-6 col-md-6 col-sm-6" >
								<button type="reset" class="flex-c-m size2 bg1-overlay bo-rad-23   m-text3 trans-0-4" > Reset </button>
							</div> -->
						</div> 
						<div class="text-right m-t-10" >
							<a href="<?php echo base_url('forgot_password'); ?>" > Forgot Password </a> 
						</div> 
						  
					</div>
				</form>
			</div>
			</div>
			 
			 
			<div class="col-sm-6 col-md-6 col-lg-6 p-b-20 m-t-40 m-t-50 text-center" style="background: #f9f9f9b0;">
		 <div class="text-center m-t-15 m-l-40 m-r-40  ">
				<h5 class="m-b-5">CREATE AN ACCOUNT</h5>
				<p class="m-b-5">Save your info to checkout faster with future orders.</p>
				<a href="<?php echo base_url('registration'); ?>" >
					<button type="submit" class="flex-c-m size1 bg4 bo-rad-23 hov1 m-text1 trans-0-4" > Create New Account </button> 
				</a>
				<hr class=" m-t-40">  
				<h5 class="m-b-5">CHECKOUT AS A GUEST</h5>
				<p class="m-b-5">Place an order without registering for an account!</p>
				<a href="<?php echo base_url('frontend/guest_user'); ?>" >
					<button type="submit" class="flex-c-m size1 bg4 bo-rad-23 hov1 m-text1 trans-0-4" > Guest User </button> 
				</a>
			</div>	
			</div>	
			</div>	
			</div>	
		<?php } ?>
	   
	   <div class="col-md-4">
		<div class="container">
		 	<div class="row">
				<div class="col-md-12">
				 
				<!--<?php if($this->session->flashdata("success_message")!=""){?>
				<div class="Metronic-alerts alert alert-info fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
					<i class="fa-lg fa fa-check"></i>  <?php echo $this->session->flashdata("success_message");?>
				</div>
				<?php }?>-->
			  
				
				
				<?php if($this->session->userdata('user_profile') !='' || $this->session->userdata('guest_user_profile') !=''){ 
				
					
					if($this->session->userdata('guest_user_profile') !=''){
					$where1 = array('id'=>$_SESSION['guest_user_profile']->id);
					$table1 = 'guest_user';
					}
					if($this->session->userdata('user_profile') !=''){
					$where1 = array('id'=>$_SESSION['user_profile']->id);
					$table1 = 'user';
					}
					$user= $this->user_model->get_common($table1, $where1,'*',1,'','','','');
					$name = $user->name;
					$email = $user->email;
					$contact = $user->contact;
					$address1 = $user->address1;
					$city = $user->city;
					$state = $user->state;
					$pincode = $user->pincode;
					//print_r($user);
				?>
				
				<h5 class="m-b-5" style="font-size: 1rem;">Delivery Address</h5>
				
				<form name="frm_user_detail" autocomplete="on" action="<?=base_url('process_order')?>" method="POST">
				 
				<input type="hidden" name="user_id" id="user_id" value="<?php if($_SESSION['user_profile']->id!=""){ echo $_SESSION['user_profile']->id; }if($_SESSION['guest_user_profile']->id!=""){ echo $_SESSION['guest_user_profile']->id; } ?>">
				<input type="hidden" name="amount" id="amount" value="<?php  echo  $total_price_head; ?>">
	            <input type="hidden" name="quantity" id="quantity" value="<?php echo $total_qty; ?>">
				<input type="hidden" name="total_amt" id="total_amt" value="<?php echo $final_total; ?>">
				<input type="hidden" name="coupon_discount" id="coupon_discount" value="<?php echo $discount_amt; ?>">
				<input type="hidden" name="coupon_code" id="coupon_code" value="<?php echo $coupon_code; ?>">
				<input type="hidden" name="offer_id" id="offer_id" value="<?php echo $coupon_code; ?>">
	            <input type="hidden" name="quantity" id="quantity" value="<?php echo $total_qty; ?>">
				<input type="hidden" name="discount_per" id="discount_per" value="<?php echo $coupon_discount; ?>">
				<input type="hidden" name="productinfo" id="productinfo" value="<?php echo $product_name; ?>">
			 
				<input type="hidden" id="firstname" name="firstname" style="border: 1px solid #989898 !important;" placeholder="John M. Doe" value="<?= $name;?>" required readonly />
				<input type="hidden" id="email" name="email" style="border: 1px solid #989898 !important;" placeholder="john@example.com" value="<?= $email;?>" required readonly />
				<input type="hidden" id="phone" name="phone" style="border: 1px solid #989898 !important;" placeholder="9999999999" value="<?= $contact;?>" required readonly />
				<input type="hidden" id="adr" name="address" style="border: 1px solid #989898 !important;"  placeholder="542 W. 15th Street" value="<?= $address1;?>" required readonly />
				
				<input type="hidden" name="user_flag" value="<?php if($_SESSION['user_profile']->id){ echo 1;}else if($_SESSION['guest_user_profile']->id){ echo 2;}; ?>" />
				<input type="hidden" name="udf1" value="<?php if($_SESSION['user_profile']->id){ echo $_SESSION['user_profile']->id;}else if($_SESSION['guest_user_profile']->id){ echo $_SESSION['guest_user_profile']->id;}; ?>" />
				<input type="hidden" name="udf2" value="<?php echo $coupon_code; ?>" />
				<input type="hidden" name="udf3" value="<?php echo $coupon_discount; ?>" />
				<input type="hidden" name="udf4" value="PayUMoney" />
				 
				
				 <?php 
				 if($_SESSION['user_profile']->id!=''){  
				$user_id=$_SESSION['user_profile']->id;
				$user2=$this->db->query("SELECT * FROM `cust_address` WHERE `user_id`=$user_id");			
				$cust_address=$user2->result();
				 //print_r($cust_address);
				 if(count($cust_address)>0){
					 for($i=0;$i<count($cust_address);$i++){
					 
				?>
				<div class="m-b-20 m-t-20" style=" padding: 22px; box-shadow: 0px 0px 4px #c3c3c3;">
				<input type="radio" onclick="delivery_address2()" class="add-class" name="del_name" <?php if($i==0){ echo "checked"; } ?> <?php if(set_value('del_name')==$cust_address[$i]->id){  echo 'checked'; } ?> id="delivery_yes" value="<?= $cust_address[$i]->id ?>" >  
				
				<label><span><?= $cust_address[$i]->name;?></span></label> 
				 <label><span>-</span><?= $cust_address[$i]->contact;?></label><br>
				 <label><span></span><?php echo  $cust_address[$i]->address.", ".$cust_address[$i]->city.", ".$cust_address[$i]->state.", ".$cust_address[$i]->pin_code;?></label><br>
				<!--<label><?= $cust_address->address;?></label><br>
				<label><span>City : </span><?= $cust_address->city;?></label><br>
				<label><span>State : </span><?= $cust_address->state;?></label><br>
				<label><span>Pin Code : </span><?= $cust_address->pin_code;?></label>-->
				</div>
				
				 <?php } }  ?>
				<label for="city" class="m-t-20">  Do you want to add Anohter Address..?</label><br>
				<!--<input type="radio" onclick="delivery_address2()" name="del_name"  checked  id="delivery_yes" value="<?= set_value('del_name',1); ?>" > Yes &nbsp;&nbsp;-->
				<input type="radio" onclick="delivery_address1()" class="add-class" name="del_name"  id="delivery_no" value="yes" <?php if(set_value('del_name')=='yes'){  echo 'checked'; } ?> > Yes
				 	<div id="delivery_address_div" class="  m-t-10" style="display:none; <?php if(set_value('del_name')=='yes'){  echo 'display:block;'; } ?>  padding: 22px; box-shadow: 0px 0px 4px #c3c3c3;">
			
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
				<?php } ?>
				<?php 	 
					$this->db->where('user_id',$_SESSION['user_profile']->id);
					$res1 = $this->db->get('cust_address');
					$cust_address = $res1->row(); 
					//print_r($cust_address);
					 $cust_address->name;
				 ?>	
				<label for="fname"> Name <span style="color:red; ">*</span></label>
				<input type="text" class="form-control" id="del_firstname" name="del_firstname" style="border: 1px solid #989898 !important;" value="<?= set_value('del_firstname'); ?>" placeholder="Name"    />
				  
				<label for="fname">  Mobile  <span style="color:red; ">*</span></label>
				<input type="number" class="form-control" id="del_phone" name="del_phone" style="border: 1px solid #989898 !important;" value="<?= set_value('del_phone'); ?>" placeholder="Mobile no"    />
				 
				<label for="fname">Alternate Contact</label>
				<input type="number" class="form-control" id="del_alternet_phone" name="del_alternet_phone" style="border: 1px solid #989898 !important;" value="<?= set_value('del_alternet_phone'); ?>" placeholder="Alternate Contact no"    />
				
				<label for="adr">  Address  <span style="color:red; ">*</span></label>
				<textarea class="form-control" id="del_adr" name="del_address" style="border: 1px solid #989898 !important;"    placeholder="Address"><?= set_value('del_address'); ?></textarea>
				
				<label for="state">State  <span style="color:red; ">*</span></label>
					<input type="text" id="del_state" name="del_state" class="form-control del_state" style="line-height:1.5; border: 1px solid #989898 !important;" value="<?= set_value('del_state'); ?>" placeholder="State"   />
					
				
				<div class="row">
				  <div class="col-50">
				  <label for="city"> City  <span style="color:red; ">*</span></label>
					<input type="text" id="del_city" name="del_city" class="form-control del_city" style="border: 1px solid #989898 !important;" value="<?= set_value('del_city'); ?>" placeholder="City"     />

					<input type="hidden" name="del_country" id="del_country" value="India">
				  </div>
				  <div class="col-50">
					<label for="zip">Pincode  <span style="color:red; ">*</span></label>
					<input type="number" class="form-control del_zipcode" id="del_zipcode" name="del_zipcode" style="line-height:1.5; border: 1px solid #989898 !important;" value="<?= set_value('del_zipcode'); ?>" placeholder="Pin Code"   />
				  </div>
				</div>
				</div>
				<?php } else if($_SESSION['guest_user_profile']->id!=''){ ?>
				<div class="m-b-20 m-t-20" style=" padding: 22px; box-shadow: 0px 0px 4px #c3c3c3;">
				<input type="radio" onclick="delivery_address2()" class="add-class" name="del_name" <?php if($i==0){ echo "checked"; } ?> <?php if(set_value('del_name')==$cust_address[$i]->id){  echo 'checked'; } ?> id="delivery_yes" value="<?= $cust_address[$i]->id ?>" >  
				
				<label><span > <?= $name;?></span></label>  
				<!--<label><span>Email : </span><?= $email;?></label><br>-->
				 <label><span>- </span><?=$contact;?></label><br>
				<label><?php echo $address1.", ".$city.", ".$state." ,".$pincode ?></label><br>
				<!--<label><span>City : </span><?= $city;?></label><br>
				<label><span>State : </span><?= $state;?></label><br>
				<label><span>Pin Code : </span><?= $pincode;?></label></div>-->
				</div>
				<?php } ?>
				<br>
				<label for="city" class="m-t-20">  Payment Method</label><br>
				<!--<input type="radio"   name="payment_type" id="cod" value="cod" checked> Cash on Delivery &nbsp;&nbsp;-->
				<input type="radio" name="payment_type" id="online" value="online" checked> Online
			  
					<div id="online_payment" style="display:none;">
						<h3 class="m-t-20" >Payment</h3>
						<label for="fname">Accepted Cards</label>
						<div class="icon-container">
						  <i class="fa fa-cc-visa" style="color:navy;"></i>
						  <i class="fa fa-cc-amex" style="color:blue;"></i>
						  <i class="fa fa-cc-mastercard" style="color:red;"></i>
						  <i class="fa fa-cc-discover" style="color:orange;"></i>
						</div>
						<label for="cname" style=">Name on Card</label>
						<input type="text" id="cname" name="cardname" style="border: 1px solid #989898 !important;" placeholder="John More Doe">
						<label for="ccnum">Credit card number</label>
						<input type="text" id="ccnum" name="cardnumber" style="border: 1px solid #989898 !important;" placeholder="1111-2222-3333-4444">
						<label for="expmonth">Exp Month</label>
						<input type="text" id="expmonth" name="expmonth" style="border: 1px solid #989898 !important;" placeholder="September">
						
						<div class="row">
						  <div class="col-50">
							<label for="expyear">Exp Year</label>
							<input type="text" id="expyear" name="expyear" style="border: 1px solid #989898 !important;" placeholder="2018">
						  </div>
						  <div class="col-50">
							<label for="cvv">CVV</label>
							<input type="text" id="cvv" name="cvv" style="border: 1px solid #989898 !important;" placeholder="352">
						  </div>
						</div>
					</div>
					<br>
					<br>
				
					<button type="submit" class="flex-c-m size2 bg44 bo-rad-23 hov1 m-text3 trans-0-4" name="proceed_payment" > Place Order </button>
				</form>
				<?php }?>

		  	</div>
			</div>
		</div>
	  </div>
	</div>
	</div>
	</section>

<?php 
	$this->load->view('frontend/_includes/footer');
?>

<script>

 
function delivery_address1() {
	//alert("hi");
  if(document.getElementById("delivery_no").checked == true){
  document.getElementById("delivery_address_div").style.display = "block";
  }
  else{
  document.getElementById("delivery_address_div").style.display = "none";
  }
 }
 
function delivery_address2() {
	//alert("hi");
	//location.reload();
	//alert($('.add-class').val());
  if(document.getElementById("delivery_no").checked == true){
  document.getElementById("delivery_address_div").style.display = "block";
  }
  else{
  document.getElementById("delivery_address_div").style.display = "none";
  }
 }
 

 
$('.click').click(function() {
	if ($('span').hasClass("ti-heart")) {
			$('.click').removeClass('active')
		setTimeout(function() {
			$('.click').removeClass('active-2')
		}, 30)
			$('.click').removeClass('active-3')
		setTimeout(function() {
			$('span').removeClass('fa-star')
			$('span').addClass('fa-star-o')
		}, 15)
	} else {
		$('.click').addClass('active')
		$('.click').addClass('active-2')
		setTimeout(function() {
			$('span').addClass('fa-star')
			$('span').removeClass('fa-star-o')
		}, 150)
		setTimeout(function() {
			$('.click').addClass('active-3')
		}, 150)
		$('.info').addClass('info-tog')
		setTimeout(function(){
			$('.info').removeClass('info-tog')
		},1000)
	}
})
 
   	var state_val='';
	$(document).ready(function(){
	 
		$('input.del_state').on("blur", function(){
		  state_val=$('#del_state').val();
		      
		$('input#del_city').typeahead({
			name: 'del_city',
			remote:"<?php echo base_url('frontend/city_name?key=%QUERY&state=');?>"+state_val,
			limit : 10
		});
		
		});
		
		$('input#del_state').typeahead({
			name: 'del_state',
			remote:"<?php echo base_url('frontend/state_name?key=%QUERY');?>",
			limit : 10
		});
		$('input#del_zipcode').typeahead({
			name: 'del_zipcode',
			remote:"<?php echo base_url('frontend/pincode?key=%QUERY');?>",
			limit : 10
		});
});
  
  </script>
<script>
 
/*$(document).ready(function(){
	alert("sds");
  $("#cod").click(function(){
	 
    $("#online_payment").hide();
  });
  $("#online").click(function(){
    $("#online_payment").show();
  });
});
*/

function offer_check(id,name){
		
		if(id){
			// alert(name);
			 
				var url="<?php echo base_url('frontend/apply_offer_checkout');?>";
				$.ajax({
				  type: "POST",
				  url: url,
				  data: {"offer_code":id},
				  cache: false,
				  success: function(res){
					  //alert(res);
					 if(res==0){
						swal(name+ " is Invalid", "is Offer Not applied!", "error");
						//$("#coupon_code").val('');
					 }
					 else if(res){
						//alert(res);
						$("#card_id_refresh").html(res);
						swal(name, "is Offer applied successfully!", "success");
						//$("#coupon_discount").val(res);
						//$("#hidden_coupon_code").val(couple_code1);
							
					}
					
				  }
				});
		
				}
				else{
				swal("Coupon Code iS Empty!", "please enter the coupon Code", "error");
				
				}
	   }
	   
	function show_details(name,description){
	  swal(name, description, "");
	 }
	   
function apply_coupon(){
		
		var couple_code=document.getElementById("coupon_code").value; 
		var couple_code1=couple_code;
		if(couple_code){
			
		var url="<?php echo base_url('frontend/apply_coupon_checkout'); ?>";
				$.ajax({
				  type: "POST",
				  url: url,
				  data: {"couple_code":couple_code},
				  cache: false,
				  success: function(res){
					 if(res==0){
						swal(couple_code+ " is Invalid", "please enter the valid coupon Code", "error");
						$("#coupon_code").val('');
					 }
					 else if(res){
						//alert(res);
						$("#card_id_refresh").html(res);
						swal(couple_code, "is coupon applied successfully!", "success");
						//$("#coupon_discount").val(res);
						//$("#hidden_coupon_code").val(couple_code1);
							
					}
					
				  }
				});
		
				}
				else{
				swal("Coupon Code iS Empty!", "please enter the coupon Code", "error");
				
				}
	   }

	function remove_coupon(){
		location.reload();
    }   

function check() {
  if(document.getElementById("cod").checked = true){
  document.getElementById("online_payment").style.display = "none";
  }
  else{
  document.getElementById("online_payment").style.display = "block";
  }
 }
function check1() {
  if(document.getElementById("online").checked = true){
  document.getElementById("online_payment").style.display = "block";
  }
  else{
  document.getElementById("online_payment").style.display = "none";
  }
}
</script>
