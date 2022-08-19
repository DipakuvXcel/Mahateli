<?php 
	$this->load->helper('custom');
?>
<div class="row">
 		
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 m-b-20 m-l-20 m-r-20" style=" padding: 20px; box-shadow: 0px 0px 4px #969191;">
		<h5>Billing Address</h5><br>
		<?php 
		$user_id=$_SESSION['user_profile']->id;
		$user1=$this->db->query("SELECT * FROM `user` WHERE `id`=$user_id");			
		$user=$user1->row();
		?>
		<label><span>Name  : </span><?= $user->name;?></label><br>
		<label><span>Email : </span><?= $user->email;?></label><br>
		<label><span>Contact No : </span><?= $user->contact;?></label><br>
		<label><?= $user->address1;?></label><br>
		<label><span>City : </span><?= $user->city;?></label><br>
		<label><span>State : </span><?= $user->state;?></label><br>
		<label><span>Pin Code : </span><?= $user->pincode;?></label>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 m-b-20  m-l-20 m-r-20" style=" padding: 20px; box-shadow: 0px 0px 4px #969191;">
		<?php 
		$user_id=$_SESSION['user_profile']->id;
		$user2=$this->db->query("SELECT * FROM `cust_address` WHERE `user_id`=$user_id and id=$addr_id");			
		$cust_address=$user2->row();
		if(count($cust_address)>0){	 
		?>
		<h5>Delivery Address</h5><br>
			<label><span>Name  : </span><?= $cust_address->name;?></label><br>
			<label><span>Contact No : </span><?= $cust_address->contact;?></label><br>
			<label><span>Alternate Contact No : </span><?= $cust_address->contact2;?></label><br>
			<label><?= $cust_address->address;?></label><br>
			<label><span>City : </span><?= $cust_address->city;?></label><br>
			<label><span>State : </span><?= $cust_address->state;?></label><br>
			<label><span>Pin Code : </span><?= $cust_address->pin_code;?></label>
		
		<?php } else{?>
		
		<h5>Delivery Address</h5><br>
			<label><span>Name  : </span><?= $user->name;?></label><br>
			<!--<label><span>Email : </span><?= $user->email;?></label><br>-->
			<label><span>Contact No : </span><?= $user->contact;?></label><br>
			<label><?= $user->address1;?></label><br>
			<label><span>City : </span><?= $user->city;?></label><br>
			<label><span>State : </span><?= $user->state;?></label><br>
			<label><span>Pin Code : </span><?= $user->pincode;?></label>
		<?php } ?>
	</div>
	
<div class="table-responsive">   
	<table class="table table-striped table-bordered table-hover table-checkable order-column" >
		<thead>
			<tr>
				<!--<th>Sr.No.</th>-->
				<th>Order No.</th>
				<th>Date</th>
				<!--<th>user Name</th>
				<th>Email</th>
				<th>Contact</th>-->
				<!--<th>Address</th>-->
				<th>Total Qty</th>
				<th>Total GST</th>
				<th>Total Amount</th>
				<th>Total Discount</th>
				<th>Final Amount</th>
				<th>Order Status</th>
				<th>Payment Type</th>
			</tr>
		</thead>
		<tbody>
			<?php for($i=0;$i<count($order);$i++){ 
				if($order[$i]->order_status==1){
					$order_status="Pending";
				}else if($order[$i]->order_status==2){
					$order_status="Dispatch";
				}else if($order[$i]->order_status==3){
					$order_status="Deliver";
				}else if($order[$i]->order_status==4){
						$order_status="Cancelled by Dealer";
				}else if($order[$i]->order_status==5){
					$order_status="Cancelled by Admin";
				}else if($order[$i]->order_status==6){
					$order_status="Deleted by Dealer";
				}else if($order[$i]->order_status==7){
					$order_status="Deleted by Admin";
				} 
				$arrstc=array(3,4);
				$arrstd=array(5,6);

				$total_discount = $order[$i]->discount_amt + $order[$i]->coupon_discount_amt;
				
				?>
				<tr class="odd gradeX">
					<!--<th><?= $i+1; ?></th>-->
					
					<td><?= $order[$i]->id?></td>
					<td style="min-width: 72px; padding: 11px 4px; text-align: center;" ><?php echo(date("d-m-Y", strtotime($order[$i]->order_date))); ?></td>
					<!--<td style="min-width: 100px; padding: 11px 4px; text-align: center;"><?= $order[$i]->name ?></td>
					<td><?= $order[$i]->email; ?></td>
					<td><?= $order[$i]->mobile; ?></td>-->
					<td><?= $order[$i]->total_qty; ?></td>
					<td><?= $order[$i]->gst_amt; ?></td>
					<td><?= $order[$i]->amount; ?></td>
					<td><?= $total_discount; ?></td>
					<td><?= $order[$i]->total_amt; ?></td>
					<td><?= $order_status; ?></td>
					<td><?= ucfirst($order[$i]->payment_type); ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>	
<br>
	
<div class="table-responsive"> 				
<table style="margin:0 10px 0px 10px;" class="table table-bordered">
    <thead style="background-color:#f5f5f5;">
      <tr>
        <th>Product name</th>
        <th>Quantity</th>
		<th>Unit Cost</th>
		<th>Gst</th>
		<!--<th>Remark</th>-->
		<th>Total</th>
      </tr>
    </thead>
    <tbody>
	<?php for($i=0;$i<count($products);$i++) {?>
      <tr>
        <td><?= $products[$i]->product_name; ?></td>
        <td><?= $products[$i]->quantity; ?></td>
		<td><?= $products[$i]->price; ?></td>
		<td><?= $products[$i]->gst.'%'; ?></td>
		<!--<th><?= $products[$i]->description; ?></th>-->
		<td><?= $products[$i]->total_amt; ?></td>
      </tr>
	<?php } ?>  
       
    </tbody>
  </table>
</div>

	<?php if($order[0]->offer_id!=0 || $order[0]->coupon_code!="") { ?>
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 m-t-20 m-b-20 m-l-20 m-r-20" style=" padding: 20px; box-shadow: 0px 0px 4px #969191;">
		<h5>Applied Offer / Coupon Details: </h5><br>
		<?php if($order[0]->offer_id!=0) { ?> 
		<label><span>Offer Name  : </span><?= get_offer_name($order[0]->offer_id);?></label><br>
		<?php } ?>
		<?php if($order[0]->coupon_code!="") { ?>
		<label><span>Coupon Code : </span><?php if($order[0]->coupon_code!="") echo $order[0]->coupon_code; else echo "-";?></label><br>
		<label><span>Coupon Discount : -</span><?php echo $order[0]->discount_per.'%';?></label><br>
		<label><span>Coupon Discount Amount : Rs. </span><?php echo $order[0]->coupon_discount_amt;?></label><br>
		<?php } ?>
	</div>
	<?php } ?>
</div>

  <br>
  <div class="col-md-12">
	 <div class="col-md-6" style="float:left;">
		<a href="<?php echo upload_path.'order_document/'.$order[0]->document; ?>"  download><i class="fa fa-download "></i>  Download Order Receipt</a>
	 </div>
	
	<?php if($order[0]->order_invoice){ ?>
	<div class="col-md-6" style="float:right;">
	<a  href="<?php echo upload_path.'order_invoice/'.$order[0]->order_invoice; ?>" download><i class="fa fa-download"></i> Download Order Invoice Uploaded by Admin</a>
	</div>
	<?php } ?>
	
  </div> 
