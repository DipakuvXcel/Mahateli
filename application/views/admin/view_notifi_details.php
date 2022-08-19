<?php  
	if($notifi_detail[0]->type==1){
		$note=  base_url('admin/enquiries');
	}else if($notifi_detail[0]->type==2){
		$note= base_url('admin/appointment');
	}else if($notifi_detail[0]->type==3){
		$note= base_url('admin/subscribers');
	}else if($notifi_detail[0]->type==4){
		$note= base_url('admin/view_comments/'.$notifi_detail[0]->order_id);
	}else if($notifi_detail[0]->type==5){
		$note= base_url('admin/users');
	}else if($notifi_detail[0]->type==6){
		$note= base_url('admin/order_details/'.$notifi_detail[0]->order_id);
	}else if($notifi_detail[0]->type==7){
		$note= base_url('admin/product_review/'.$notifi_detail[0]->order_id);
	}
?>
<div class="row">
<div class="row">
<div style="margin-top:10px;margin-bottom:10px;" class="col-md-4 col-md-offset-5">
<i style="font-size:50px;" class="fa fa-exclamation-circle" aria-hidden="true"></i>
</div>
</div>
	<div style="text-align:center;" class="col-md-12"> <h4 style="font-weight: bold;"><?php echo $notifi_detail[0]->subject; ?></h4>	<br></div> 
	<div style="text-align:center;" class="col-md-12"><b>Message: </b> <?php echo $notifi_detail[0]->message; ?>	<br></div> 
	<div class="col-md-12"><b>Date: </b> <?php echo $notifi_detail[0]->created_date; ?>	<br></div> 
	
	<div class="col-md-3" style="float:right;"><a class="btn btn-info" href="<?php echo $note; ?>" >View Details</a><br></div> 
</div> 
