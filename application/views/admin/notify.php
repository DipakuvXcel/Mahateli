<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->


<style>
.notice {
    padding: 15px;
    background-color: #fafafa;
    border-left: 6px solid #7f7f84;
    margin-bottom: 10px;
    -webkit-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
       -moz-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
            box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
}
.notice-sm {
    padding: 10px;
    font-size: 80%;
}
.notice-lg {
    padding: 35px;
    font-size: large;
}
.notice-success {
    border-color: #80D651;
}
.notice-success>strong {
    color: #80D651;
}
.notice-info {
    border-color: #45ABCD;
}
.notice-info>strong {
    color: #45ABCD;
}
.notice-warning {
    border-color: #FEAF20;
}
.notice-warning>strong {
    color: #FEAF20;
}
.notice-danger {
    border-color: #d73814;
}
.notice-danger>strong {
    color: #d73814;
}
</style>
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">
			Notification messages
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><a href="<?php echo base_url('admin/notify'); ?>">Notification</a>
					
					
			</ul>
		</div>
		<!-- END PAGE HEADER-->

	<div class="col-md-12" style="border-bottom: 1px #b1b1b1 solid;" >
		<div class="">
		<input type="checkbox" id="select_All" class="checkall pull-left" name="select_all" />
		</div>
		<div class="col-md-2">Select All </div>

		<button type="button" class="btn btn-transparent btn-danger btn-outline btn-circle btn-sm active pull-right" aria-hidden="true" id="delete_button" onclick="delete_notification();" disabled>Delete</button>
		<button class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active pull-right" aria-hidden="true" id="read_button" onclick="read_notification();" disabled>Read</button>
		<br>
		<br>
		<div class="clear clearfix"> </div>
	</div>
		
	<div class="row">
	<div class="col-md-12">
			
		<?php 
		$counter=3;
		//print_r($notifi);
		for($i=0;$i<count($notifi);$i++){  ?>
		<input type="checkbox" id="checkbox1" class="checkbox1" name="check" value="<?= $notifi[$i]->id?>" />
		<?php
		if($notifi[$i]->type==1){ 
			$note=  base_url('admin/interested_user');
		?>
			<a onclick="view_notifi(<?= $notifi[$i]->id ?>)" href="javascript:void(0);" ><div <?php if($notifi[$i]->read_status==0){ ?> style="background: antiquewhite;" <?php } ?> class="notice notice-success">
				<strong>New Enquiry &nbsp :</strong>&nbsp Message 
			</div></a>
		<?php }else if($notifi[$i]->type==2){ 
			$note= base_url('admin/appointment');
		?>
			<a onclick="view_notifi(<?= $notifi[$i]->id ?>)" href="javascript:void(0);" ><div <?php if($notifi[$i]->read_status==0){ ?> style="background: antiquewhite;" <?php } ?> class="notice notice-danger">
				<strong>New Appointment &nbsp :</strong>&nbsp  Request
			</div></a>
		<?php }else if($notifi[$i]->type==3){ 
			$note= base_url('admin/subscribers');
		?>
			<a onclick="view_notifi(<?= $notifi[$i]->id ?>)" href="javascript:void(0);" ><div <?php if($notifi[$i]->read_status==0){ ?> style="background: antiquewhite;" <?php } ?> class="notice notice-info">
				<strong>New Subscriber &nbsp :</strong>&nbsp Subscribe
			</div></a>
		<?php }else if($notifi[$i]->type==4){ 
			$note= base_url('admin/view_comments/'.$notifi[$i]->order_id);
		?>
			<a onclick="view_notifi(<?= $notifi[$i]->id ?>)" href="javascript:void(0);" ><div <?php if($notifi[$i]->read_status==0){ ?> style="background: antiquewhite;" <?php } ?> class="notice notice-warning">
				<strong>Comment on &nbsp :</strong>&nbsp Blog
			</div></a>
	<?php }else if($notifi[$i]->type==5){ 
			$note= base_url('admin/users/');
		?>
			<a onclick="view_notifi(<?= $notifi[$i]->id ?>)" href="javascript:void(0);" ><div <?php if($notifi[$i]->read_status==0){ ?> style="background: antiquewhite;" <?php } ?> class="notice notice-info">
				<strong>New user &nbsp :</strong>&nbsp Registered
			</div></a>
	<?php }else if($notifi[$i]->type==6){ 
			$note= base_url('admin/order_details/'.$notifi[$i]->order_id);
		?>
			<a onclick="view_notifi(<?= $notifi[$i]->id ?>)" href="javascript:void(0);" ><div <?php if($notifi[$i]->read_status==0){ ?> style="background: antiquewhite;" <?php } ?> class="notice notice-success">
				<strong>New Order &nbsp :</strong>&nbsp Placed
			</div></a>
	<?php } else if($notifi[$i]->type==7){ 
			$note= base_url('admin/product_review/'.$notifi[$i]->order_id);
		?>
			<a onclick="view_notifi(<?= $notifi[$i]->id ?>)" href="javascript:void(0);" ><div <?php if($notifi[$i]->read_status==0){ ?> style="background: antiquewhite;" <?php } ?> class="notice notice-success">
				<strong>New Review & Rating &nbsp :</strong>&nbsp on Product
			</div></a>
	<?php } } ?>

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
//$data ['script'] = "payments.js";
//$data ['initialize'] = "pageFunctions.init();";
$this->load->view ( 'admin/_includes/footer', $data );
?>
<script>
$("#date").datepicker("setDate", new Date());
//$("#edate").datepicker("setDate", new Date());


	$(".my-datepicker").datepicker({ 
        minDate: 0,
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: '-100:0'
    });
</script>

<script type="text/javascript">
	//select All
	$(document).ready(function(){
		
	});

	$('.checkall').on('click',function(){
		
        if(this.checked){
			//alert("select all");
            $('.checkbox1').each(function(){
				this.checked = true;
				$('#read_button').removeProp('disabled');
				$('#delete_button').removeProp('disabled');
            });
        }else{
			//alert("unselect all");
            $('.checkbox1').each(function(){
				this.checked = false;
				$('#read_button').prop("disabled","disabled");   
				$('#delete_button').prop("disabled","disabled");  
            });
        }
		
    });
    
	//disableing button until checkbox is checked
	$('.checkbox1').click(function(){
	var chklen = $('.checkbox1:checked').length;
		if(chklen > 0){
			$('#read_button').removeProp('disabled');
			$('#delete_button').removeProp('disabled');  
		}else{
			$('#read_button').prop("disabled","disabled");   
			$('#delete_button').prop("disabled","disabled"); 
		}
		
		// select all checkbox check and uncheck
		if($('.checkbox1:checked').length == $('.checkbox1').length){
            $('.checkall').prop('checked',true);
        }else{
            $('.checkall').attr('checked',false);
        }
		
	});


	function read_notification()
	{
		var checkedValue = null; 
		var arr=[];
		var inputElements = document.getElementsByClassName('checkbox1');
		
		for(var i=0;inputElements[i]; ++i)
		{
			if(inputElements[i].checked)
			{
				checkedValue = inputElements[i].value;
				arr.push(checkedValue);
			}
		}
		
		var url="<?php echo base_url('admin/read_notification'); ?>";
		$.post(url,{'array_read':arr},function(res){
			  if(res){
				  alert("Read Notifications successfully");
				  location.reload();
			  }  
		 });
		
	}

	function delete_notification() 
	{
		var checkedValue = null; 
		var arr=[];
		var inputElements = document.getElementsByClassName('checkbox1');
		
		for(var i=0;inputElements[i]; ++i)
		{
			if(inputElements[i].checked)
			{
				checkedValue = inputElements[i].value;
				arr.push(checkedValue);
			}
		}

		var r = confirm("Are you sure you want to delete notification? Once Deleted you cannot retrieve it again");
		if (r == true) {
		  var url="<?php echo base_url('admin/delete_notification'); ?>";
			$.post(url,{'array_read':arr},function(res){
				  if(res){
					  alert("Notifications Deleted successfully");
					  location.reload();
				  }
				  
			 });
		} else {
		  //txt = "You pressed Cancel!";
		}
		
	}

</script>