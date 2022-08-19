
<?php 
	//$this->load->view('frontend/_includes/header');
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
.table-responsive{
	max-width:100%;
	overflow:auto;
	
}
</style>   
    
	 
<!-- Content page -->
<section class="bgwhite p-t-7 p-b-10">
	<div class="col-md-12">
		<div class="row">
		 

		<div class="col-sm-12 col-md-12 col-lg-12 ">
			<section class="bgwhite tab-pane  " id="display_div">
			</section>
			<section class="bgwhite tab-pane  " id="profile_section_div">
				<div class=" ">
					<div class="p-b-40">
						<div class="blog-detail-txt p-t-33">
							<div class="row m-b-30">
								<div class="col-md-5">
									<h4 class="p-b-11 m-text24">
										My Orders:
									</h4>
								</div>
								<div class="col-md-5">
									 
								</div>
							</div>
							<hr> </hr>
							<div class="portlet-body">
							<div class="form-body">
								<div class="table-responsive">
								<table style="width:100%" class="table table-striped table-bordered table-hover table-checkable order-column" data-page-length='10'>
									<thead>
										<tr>
											<th>Sr.No.</th>
											<th style="min-width:90px;">Date</th>
											<th>Order No.</th>
											<!--<th>user Name</th>
											<th>Contact</th>-->
											<th>Total Qty</th>
											<th>Amount</th>
											<th>Total GST</th>
											<th>Total Discount</th>
											<th>Final Amount</th>
											<th style="min-width:100px;">Order Status</th>
											<th style="width: 14%;">Actions</th>
										</tr>
									</thead>
								<tbody>
								<?php 
								$qtyexcced=0;
								for($i=0;$i<count($order);$i++){

									$user_id=$order[$i]->user_id;
									$user1=$this->db->query("SELECT * FROM `user` WHERE `id`=$user_id");			
									$user=$user1->row();
									
									$arrstc=array(4,5);
									$arrstd=array(6,7);
					
									$total_discount = $order[$i]->discount_amt + $order[$i]->coupon_discount_amt;
									
									if($order[$i]->order_status==1){
										$order_status="Pending";
									}else if($order[$i]->order_status==2){
										$order_status="Dispatch";
									}else if($order[$i]->order_status==3){
										$order_status="Deliver";
									}else if($order[$i]->order_status==4){
										$order_status="Cancelled";
									}else if($order[$i]->order_status==5){
										$order_status="Cancel request send";
									}else if($order[$i]->order_status==6){
										$order_status="Deleted";
									}else if($order[$i]->order_status==7){
										$order_status="Delete request send";
									}
								?>
								
									<tr class="odd gradeX" <?php if(in_array($order[$i]->order_status,$arrstc)){?> style="background: #f7c0c0 !important;" <?php } else if(in_array($order[$i]->order_status,$arrstd)){ ?> style="background: indianred !important;" <?php } ?>>
										<td ><?= $i+1; ?></td>
										<td><?php echo(date("d-m-Y", strtotime($order[$i]->order_date))); ?></td>
										<td><?= $order[$i]->order_no; ?></td>
										<!--<td><?= $user->name; ?></td>
										<td><?= $user->contact; ?></td>-->
										<td><?= $order[$i]->total_qty; ?></td>
										<td><?= $order[$i]->amount;?></td>
										<td><?= $order[$i]->gst_amt; ?></td>
										<td><?= $total_discount; ?></td>
										<td><?= $order[$i]->total_amt; ?></td>
										
										<td> <?php echo $order_status; ?> </td>

										<td>
											<button type="button"  onclick="view_order(<?= $order[$i]->id; ?>)" ><i class="fa fa-eye"></i> View</button><br>
											
											<?php if($order[$i]->order_invoice){ ?>
												<a href="<?= upload_path.'order_invoice/'.$order[$i]->order_invoice; ?>" download><i class="fa fa-download"></i> Download</a><br>
											<?php } else { ?> 
												<a href="<?= upload_path.'order_document/'.$order[$i]->document; ?>" download><i class="fa fa-download"></i> Download</a><br>
											<?php } ?> 
											 
											<?php if($order[$i]->order_status==1){ ?>
												<a style="margin-bottom: 1%;" href="javascript:void(0);" onclick="cancel_delete_order(5,'<?= $order[$i]->id?>','<?= $order[$i]->user_id ?>','<?= $order[$i]->payment_type ?>')"><i class="fa fa-ban"></i> Cancel</a> <br>
											<?php } ?>
											
											<?php if($order[$i]->payment_type=='online'){ ?>
												<a style="margin-bottom: 1%;" href="javascript:void(0);" onclick="view_order_payment('<?= $order[$i]->id?>','<?= $order[$i]->user_id ?>','<?= $order[$i]->payment_type ?>')"><i class="fa fa-eye"></i> View Payment Details</a> <br>
											<?php } ?>
										   
											<?php if($order[$i]->order_status==1){ ?> 
												<!--<a href="javascript:void(0);" onclick="cancel_delete_order(7,'<?= $order[$i]->id?>','<?= $order[$i]->user_id ?>','<?= $order[$i]->payment_type ?>')"><i class="fa fa-trash"></i> Delete </a><br>-->
											<?php } ?> 
										</td>
									</tr>
								<?php } ?>
								</tbody>
								</table>
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
	
	
	 <!-- Modal -->
  <div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg44 m-text3">
          
          <h4 class="modal-title">Order Details</h4>
		  <button style="color:#fff;" type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="view_order_details">
         
		</div>
        <div class="modal-footer" style="padding: 2px;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  

<?php 
	//$this->load->view('frontend/_includes/footer');
?>

<script>
  
	function profile_section()
	{  
		$("#cart_section").removeClass('sale-noti1');
		$("#wishlist_section").removeClass('sale-noti1');
		$("#profile_section").addClass('sale-noti1');
		$('#display_div').hide();
		$('#profile_section_div').show();
	}

	function view_order(id)
	{
	var url="<?php echo base_url('frontend/view_order_details');?>";
	$.post(url,{"id":id},function(res){
		//alert(res);
		if(res){
			$('#viewModal').modal();
			$("#view_order_details").html(res);
		}else{
			alert("Data not found!");
		}
	});
	}

	function cancel_delete_order(status,id,user_id,payment_type)
	{
		if(status==5 || status==7)
		{
			if(status==5)
			{
				var result = confirm("Want to cancel order?");
			}
			else if(status==7) 
			{
				var result = confirm("Want to delete order?");
			}
			if (result) 
			{
				if(payment_type=='online'){
					var url="<?php echo base_url('frontend/cancel_delete_order_refund/?id=');?>"+id;
					window.location.href = url;
				}else{
					
					var url="<?php echo base_url('frontend/cancel_delete_order');?>";
				
				$.post(url,{"id":id,"status":status,"user_id":user_id},function(res)
				{
					//alert(res);
					if(res==1 && status==5)
					{
						alert("Order Cancelled successfully.");
						location.reload();
					}
					else if(res==1 && status==7)
					{
						alert("Order deleted successfully.");
						location.reload();
					}
					else
					{
						alert("Order status not update! try again...");
					}
				});
			} 
			} 
		} 
	} 


	function view_order_payment(id,user_id,payment_type)
	{
		if(payment_type=='online')
		{
			var url="<?php echo base_url('frontend/order_payment_enquiry/?id=');?>"+id;
			window.location.href = url;
				 
			$.post(url,{"id":id,"user_id":user_id},function(res)
			{
				 
			});
		} 
	} 

	function change_order_status(status,id,dealer_id)
	{
		if(status==3 || status==5)
		{
		if(status==3)
		{
			var result = confirm("Want to cancel order?");
		}else if(status==5) {
			var result = confirm("Want to delete order?");
		}
		if (result) {
			var url="<?php echo base_url('frontend/change_order_status');?>";
			$.post(url,{"id":id,"status":status,"dealer_id":dealer_id},function(res){
				//alert(res);
				if(res==1 && status==3){
					alert("Order Cancelled successfully.");
					location.reload();
				}else if(res==1 && status==5){
					alert("Order deleted successfully.");
					location.reload();
				}else{
					alert("Order status not update! try again...");
				}
			});
		}
		}
	}    
	
</script>