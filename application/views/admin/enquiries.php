<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">Enquiries</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><span>Enquiries</span></li>
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
								class="caption-subject bold uppercase">Enquiries</span>
						</div>
						<div class="actions">
						<button class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active" onclick="send_mail(0);">Send Mail</button>
						<!-- <button class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active" onclick="send_sms(0);">Send SMS</button> -->
                    	        
						</div>
						<!--<div class="actions">
							<a href="<?php echo base_url('admin/add_testimonial');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add testimonial </a>&nbsp;
						</div>-->
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
						<table
							class="table table-striped table-bordered table-hover table-checkable order-column"
							id="managed_datatable" data-page-length='10'>
							
							<thead>
								<tr>
									<th>Sr.No.</th>
									<th>Date</th>
									<th>Name</th>
									<th>Email</th>
									<th>Conatct</th>
									<!-- <th>Subject</th> -->
									<th>Message</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php for($i=0;$i<count($enquiries);$i++){ ?>
									<tr class="odd gradeX">
										<td><?= $i+1; ?></td>
										<td><?= date('Y-m-d',strtotime($enquiries[$i]->created_date));?></td>
										<td><?= $enquiries[$i]->name ?></td>
										<td><?= $enquiries[$i]->email; ?></td>
										<td><?= $enquiries[$i]->contact; ?></td>
										<!-- <td><?= $enquiries[$i]->subject; ?></td> -->
										<td><?= $enquiries[$i]->message; ?></td>
										<td> <?php if($enquiries[$i]->status_id == 1) { echo 'Active'; }
											else if($enquiries[$i]->status_id == 2) {	echo 'Inactive'; } 
											else if($enquiries[$i]->status_id == 3) {	echo 'Pending'; } ?></td>
					                    <td>
					                    	<?php if($enquiries[$i]->status_id == 3){ ?>
						                    	<a href="<?php echo base_url('admin/update_enquiry_status/1/'.$enquiries[$i]->id); ?>" class="btn default btn-xs blue-sharp-stripe" 
						                    		onclick="if(!confirm('Are you sure to approve?')) return false;"> Approve </a>

						                    <?php }else if($enquiries[$i]->status_id == 1){ ?>
				                    			<a href="<?= base_url('admin/update_enquiry_status/2/'.$enquiries[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe"
				                    				onclick="if(!confirm('Are you sure to make inactive?')) return false;"> Inactive </a>
												
											<?php }else if($enquiries[$i]->status_id == 2){ ?>
												<a href="<?= base_url('admin/update_enquiry_status/1/'.$enquiries[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe"
													onclick="if(!confirm('Are you sure to make active?')) return false;"> Active </a>
											<?php } ?>
												<a href="<?php echo base_url('admin/update_enquiry_status/0/'.$enquiries[$i]->id) ;?>" class="btn default btn-xs red-soft-stripe" onclick="if(!confirm('Are you sure to delete ?')) return false;">Delete </a>
												<button id='myBtn' class="btn default btn-xs blue-stripe" onclick='send_mail("<?php echo $enquiries[$i]->id;?>")'>Send Email </button>
												<!-- <button id='myBtn' class="btn default btn-xs purple-stripe" onclick='send_sms("<?php echo $enquiries[$i]->id;?>")'>Send SMS</button> -->
											</td>	
									</tr>
								<?php } ?>
					        </tbody>
						</table>
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>

	</div>
	<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<!--send_bulk_email_popup_div-->
<div class="modal modal-flex fade" id="sendemailform" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="flexModalLabel">Send Email To Enquiry Users</h4>
			</div>
			<form name="send_email_form" id="send_email_form" action="javascript:void(0)" method="post" >
			<div class="modal-body">
			 
					<div class="row">
					<div class="col-md-12">
						<div class="input-group bmargindiv1 col-md-12">
							<span class="input-group-addon ndrftextwidth text-left">Subject :</span>
							<input type="text" class="form-control" placeholder="Subject" name="subject" id="subject" maxlength="200">
						</div>
					</div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-12">
						<div class="input-group bmargindiv1 col-md-12">
							<span class="input-group-addon ndrftextwidth text-left">Content :</span>
							<textarea id="mail_body" name="mail_body" class="form-control" maxlength="1000" rows="2"  style="margin: 0px -0.5px 0px 0px; height: 120px; resize:none;"></textarea>
						</div>
					</div>
					</div>
					<br>
					
					<div class="row">
					<div class="col-md-12">
						<div class="input-group bmargindiv1 col-md-12">
							<span class="input-group-addon ndrftextwidth text-left">Send to :</span>
							 
							<div style="padding:2px 10px 0px 10px; height:147px; overflow-x:hidden; overflow-y:scroll;" id="showuserlistview">
								
							<div class="clearfix"></div>
							</div>
						</div>
					</div>
					</div>
					<br>
					<div class="clearfix"></div>
				
				<!--end_preview_total_div-->
			</div>
			</form>
			<div class="modal-footer">
				<button class="btn btn-primary btn-md" id="mailsendbtn" onclick="sendEmailToMultiple_users()">Submit</button>&nbsp;<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--end_send_bulk_email_popup_div-->


<!-- <div class="modal modal-flex fade" id="sendesmsform" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="flexModalLabel">Send SMS To Enquiry Users</h4>
			</div>
			<form name="send_sms_form" id="send_sms_form" action="javascript:void(0)" method="post" >
				<div class="modal-body">
					<div class="row">
					<div class="col-md-12">
						<div class="input-group bmargindiv1 col-md-12">
							<span class="input-group-addon ndrftextwidth text-left">Message :</span>
							<textarea id="sms_body" name="sms_body" class="form-control" maxlength="1000" rows="2"  style="margin: 0px -0.5px 0px 0px; height: 120px; resize:none;"></textarea>
						</div>
					</div>
					</div>
					<br>
					
					<div class="row">
					<div class="col-md-12">
						<div class="input-group bmargindiv1 col-md-12">
							<span class="input-group-addon ndrftextwidth text-left">Send to :</span>
							
							<div class="col-md-12 newpadding-left-zero">
								<label class="checkbox-inline">
									<input type="checkbox" class="chk_unchk_class_sms"  name="chk_all_id_sms" id="chk_all_id_sms" checked="checked" onclick="CheckAllUser_sms()" >Check All
								</label>
							</div>
							<div class="clearfix"></div>
							<div style="height:20px;"></div> 
							<div id="showuserlistview_sms1" style="display:none;">
							<div style="padding:2px 10px 0px 10px; height:100px; overflow-x:hidden; overflow-y:scroll;" id="citylistview_sms" >
								
							<div class="clearfix"></div>
							</div>
							<hr>
							</div>

							<div style="padding:2px 10px 0px 10px; height:147px; overflow-x:hidden; overflow-y:scroll;" id="showuserlistview_sms" >
								
							<div class="clearfix"></div>
							</div>
						</div>
					</div>
					</div>
					<br>
					<div class="clearfix"></div> -->
				
				<!--end_preview_total_div-->
				<!-- </div>
			</form>
			<div class="modal-footer">
				<button class="btn btn-primary btn-md" id="smssendbtn" onclick="sendSMSToMultiple_users()">Submit</button>&nbsp;<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div> -->
		<!-- /.modal-content -->
	<!-- </div> -->
	<!-- /.modal-dialog -->
</div>
<!--end_send_bulk_email_popup_div-->
<?php
$data ['script'] = "dashboard.js";
$data ['initialize'] = "pageFunctions.init();";
$this->load->view ( 'admin/_includes/footer', $data );
?>

<script type="text/javascript">

	$(document).ready(function(){
		$('#managed_datatable_all').dataTable({
			"pagingType": "full_numbers"
		});

		/* $('#managed_datatables').dataTable({
			"pagingType": "full_numbers"
		}); */
	});

	function send_mail(all_users){
		var status=1;
		var url="<?php echo base_url('admin/getenquiryuserMails');?>";
		$.post(url,{"status":status,'id':all_users},function(res){
			if(res !=0){
				$("#showuserlistview").html(res);
				$('#sendemailform').modal('show');
			}else{
				$("#showuserlistview").html("");
				$('#sendemailform').modal('show');
				alert("No user found!");
			}
		});	
	}

	// function send_sms(all_users){
	// 	var status=1;
	// 	var url="<?php echo base_url('admin/getenquiryuserContacts');?>";
	// 	$.post(url,{"status":status,"all_users":all_users},function(res){
	// 		if(res !=0){
	// 			$("#showuserlistview_sms").html(res);
	// 			$('#sendesmsform').modal('show');
	// 		}else{
	// 			$("#showuserlistview_sms").html("");
	// 			$('#sendesmsform').modal('show');
	// 			alert("No user found!");
	// 		}
	// 	});	
	// }
	
	function sendEmailToMultiple_users(){
		//var mail_from=$("#mail_from").val().trim();
		var subject=$("#subject").val().trim();
		var mail_body=$("#mail_body").val().trim();
		var checkboxes = document.getElementsByName('specific_user_list[]');
		
		var selected = [];
		for (var i=0; i<checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				selected.push(checkboxes[i].value);
			}
		}
		var check = selected.length;
		$('#mailsendbtn').prop('disabled', true);

		if((check > 0) && subject && mail_body ){
			var user_data=$("#send_email_form").serialize();
			var url="<?php echo base_url('admin/sendEmailToMultiple_users');?>";
			$.post(url,{"user_data":user_data},function(res){
				//alert(res);
				if(res){
					$('#mailsendbtn').prop('disabled', false);
					$("#send_email_form")[0].reset(); // reset the form 
					$('#sendemailform').modal('hide'); // close the modal
					alert("Mail sent successfully.");
				}else{
					$('#mailsendbtn').prop('disabled', false);
					alert("Mail didn't send.");
				}
			});
		}else{
			$('#mailsendbtn').prop('disabled', false);
			alert("Please enter all fields");
		}
	}
	
	function CheckAllUser(){
		if($("#chk_all_id").is(':checked')) {
            $(".chk_all_class").prop("checked", true);
		} else {
			$(".chk_all_class").prop("checked", false);
		}
	}

	function CheckAllUser1(){
		if($("#chk_all_id1").is(':checked')) {
            $(".chk_all_class1").prop("checked", true);
		} else {
			$(".chk_all_class1").prop("checked", false);
		}
		var checkboxes = document.getElementsByName('city[]');
		var selected = [];
		for (var i=0; i<checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				selected.push(checkboxes[i].value);
			}
		}
		var check = selected.length;
		if(check > 0){
			var url="<?php echo base_url('admin/getlocationuserList');?>";
			$.post(url,{"city":selected},function(res){
				if(res !=0){
					$("#showuserlistview").html(res);
					$('#sendemailform').modal('show');
				}else{
					$("#showuserlistview").html("");
					$('#sendemailform').modal('show');
					alert("No user found!");
				}
			});	
		}else{
			$("#showuserlistview").html("");
		}
	}
	function CheckspecificUser(){
		if($("#specific_user_list").is(':checked')) {
           // $("#specific_user_list").prop("checked", true);
			 $(".chk_unchk_class").prop("checked", false);
		} else {
			
			//$("#specific_user_list").prop("checked", false);
			 $(".chk_unchk_class").prop("checked", false);
		}
	}
	function CheckspecificUser1(){
		if($("#mail_to_user1").is(':checked')) {
           // $("#specific_user_list").prop("checked", true);
			 $(".chk_unchk_class1").prop("checked", false);
		} else {
			
			//$("#specific_user_list").prop("checked", false);
			 $(".chk_unchk_class1").prop("checked", false);
		}
		
		var checkboxes = document.getElementsByName('city[]');
		var selected = [];
		for (var i=0; i<checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				selected.push(checkboxes[i].value);
			}
		}
		var check = selected.length;
		if(check > 0){
			var url="<?php echo base_url('admin/getlocationuserList');?>";
			$.post(url,{"city":selected},function(res){
				if(res !=0){
					$("#showuserlistview").html(res);
				}else{
					$("#showuserlistview").html("");
					alert("No user found!");
				}
			});	
		}else{
			$("#showuserlistview").html("");
		}
	}

	function ShowHideDiv1() {
        var chkYes = document.getElementById("chkYes1");
        var dvPassport = document.getElementById("showuserlistview1");
        dvPassport.style.display = chkYes.checked ? "block" : "none";
		if(chkYes.checked){
			var url="<?php echo base_url('admin/getlocationList');?>";
			$.post(url,{"location":1},function(res){
				if(res !=0){
					$("#citylistview").html(res);
				}
			});
		}else{
			 dvPassport.style.display = chkYes.checked ? "block" : "none";
			var status=1;
			var url="<?php echo base_url('admin/getuserList');?>";
			$.post(url,{"status":status,"all_users":1},function(res){
				if(res !=0){
					$("#showuserlistview").html('');
					$("#showuserlistview").html(res);
					//$('#sendemailform').modal('show');
				}else{
					$("#showuserlistview").html("");
					//$('#sendemailform').modal('show');
					alert("No user found!");
				}
			});	
		}
    }
	
	function CheckAllUser_sms(){
		if($("#chk_all_id_sms").is(':checked')) {
            $(".chk_all_class_sms").prop("checked", true);
		} else {
			$(".chk_all_class_sms").prop("checked", false);
		}
	}
	
	function CheckAllUser_sms1(){
		if($("#chk_all_id_sms1").is(':checked')) {
            $(".chk_all_class_sms1").prop("checked", true);
		} else {
			$(".chk_all_class_sms1").prop("checked", false);
		}
		var checkboxes = document.getElementsByName('city_sms[]');
		var selected = [];
		for (var i=0; i<checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				selected.push(checkboxes[i].value);
			}
		}
		var check = selected.length;
		if(check > 0){
			var url="<?php echo base_url('admin/getlocationusersmsList');?>";
			$.post(url,{"city":selected},function(res){
				if(res !=0){
					$("#showuserlistview_sms").html(res);
				}else{
					$("#showuserlistview_sms").html("");
					alert("No user found!");
				}
			});	
		}else{
			$("#showuserlistview_sms").html("");
		}
	}
	function CheckspecificUser_sms(){
		if($("#sms_to_user").is(':checked')) {
           // $("#specific_user_list").prop("checked", true);
			 $(".chk_unchk_class_sms").prop("checked", false);
		} else {
			
			//$("#specific_user_list").prop("checked", false);
			 $(".chk_unchk_class_sms").prop("checked", false);
		}
	}
	
	function CheckspecificUser_sms1(){
		if($("#mail_to_user1").is(':checked')) {
           // $("#specific_user_list").prop("checked", true);
			 $(".chk_unchk_class1").prop("checked", false);
		} else {
			
			//$("#specific_user_list").prop("checked", false);
			 $(".chk_unchk_class_sms1").prop("checked", false);
		}
		
		var checkboxes = document.getElementsByName('city_sms[]');
		var selected = [];
		for (var i=0; i<checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				selected.push(checkboxes[i].value);
			}
		}
		var check = selected.length;
		if(check > 0){
			var url="<?php echo base_url('admin/getlocationusersmsList');?>";
			$.post(url,{"city":selected},function(res){
				if(res !=0){
					$("#showuserlistview_sms").html(res);
				}else{
					$("#showuserlistview_sms").html("");
					alert("No user found!");
				}
			});	
		}else{
			$("#showuserlistview_sms").html("");
		}
	}
	
	function ShowHideDiv_sms() {
        var chkYes = document.getElementById("chkYes_sms");
        var dvPassport = document.getElementById("showuserlistview_sms1");
        dvPassport.style.display = chkYes.checked ? "block" : "none";
		if(chkYes.checked){
			var url="<?php echo base_url('admin/getlocationsmsList');?>";
			$.post(url,{"location":1},function(res){
				if(res !=0){
					$("#citylistview_sms").html(res);
				}
			});
		}else{
			 dvPassport.style.display = chkYes.checked ? "block" : "none";
			var status=1;
			var url="<?php echo base_url('admin/getlocationusersmsList');?>";
			$.post(url,{"status":status,"all_users":0},function(res){
				if(res !=0){
					$("#showuserlistview_sms").html('');
					$("#showuserlistview_sms").html(res);
					//$('#sendemailform').modal('show');
				}else{
					$("#showuserlistview_sms").html("");
					//$('#sendemailform').modal('show');
					alert("No user found!");
				}
			});	
		}
    }
	// send sms
	function sendSMSToMultiple_users(){
		//var mail_from=$("#mail_from").val().trim();
		//var subject=$("#subject").val().trim();
		var mail_body=$("#sms_body").val().trim();
		var checkboxes = document.getElementsByName('sms_to_user[]');
		
		var selected = [];
		for (var i=0; i<checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				selected.push(checkboxes[i].value);
			}
		}
		var check = selected.length;
		$('#smssendbtn').prop('disabled', true);

		if((check > 0) && subject && mail_body ){
			var user_data=$("#send_sms_form").serialize();
			var url="<?php echo base_url('admin/sendSMSToMultiple_users');?>";
			$.post(url,{"user_data":user_data},function(res){
				//alert(res);
				if(res){
					$('#smssendbtn').prop('disabled', false);
					$("#send_sms_form")[0].reset(); // reset the form 
					$('#sendesmsform').modal('hide'); // close the modal
					alert("SMS sent successfully.");
				}else{
					$('#smssendbtn').prop('disabled', false);
					alert("SMS didn't send.");
				}
			});
		}else{
			$('#mailsendbtn').prop('disabled', false);
			alert("Please enter all fields");
		}
	}
	
	
	  
  </script>
  
	