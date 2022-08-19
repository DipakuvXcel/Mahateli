<?php 
	$this->load->view('admin/_includes/header');
?>
 
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
	<!-- BEGIN PAGE HEADER-->
	<h3 class="page-title">Admin Users</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> 
				<a href="<?php echo base_url('admin'); ?>">Home</a> 
				<i class="fa fa-angle-right"></i></li>
				<li><span>Admin Users</span></li>
			</ul>
		</div>
	<!-- END PAGE HEADER-->

	<!-- Tab Start --> 
		<div class="row">
        	<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade p-3 active in" id="one" role="tabpanel" aria-labelledby="one-tab">
					<div class="col-md-12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet light ">
							<div class="portlet-title">
								<div class="caption font-dark">
									<i class="icon-settings font-dark"></i> 
									<span class="caption-subject bold uppercase">Admin Users</span>
							 		<!-- <button onclick="pdf_all_user()" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;PDF</button> -->
									<a href="<?php echo base_url('admin/excel_all_user');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active fa fa-download"> Excel</a>
								
								</div>
							<div class="actions">
							<button class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active fa fa-paper-plane" onclick="send_mail(1);"> Send Mail</button>
                    		<a href="<?php echo base_url('admin/add_admin_user');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active fa fa-plus">Add Admin Users</a>
						</div>
					</div>
					<div class="portlet-body">
							<?php 
								if($this->session->flashdata("success_message")!="")
								{
							?>
		                <div class="Metronic-alerts alert alert-info fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<i class="fa-lg fa fa-check"></i>  
							<?php echo $this->session->flashdata("success_message");?>
		                </div>
							<?php 
								}
								if($this->session->flashdata("error_message")!="")
								{
							?>
		                <div class="Metronic-alerts alert alert-danger fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<i class="fa-lg fa fa-warning"></i>  
							<?php echo $this->session->flashdata("error_message");?>
		                </div>
							<?php 
							}
							if(validation_errors()!="")
							{?>
		               		<div class="Metronic-alerts alert alert-danger fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<i class="fa-lg fa fa-warning"></i>  
							<?php echo validation_errors();?>
		                </div>
						 	<?php 
							}
							?>
					  	<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="managed_datatable" data-page-length='10'>
							<thead>
								<tr>
									<th>Sr.No.</th>
									<th style="width:20%;">Admin Name</th>
                  					<th>Email</th>
									<th>Contact</th>
									<th>Image</th>
									<th>Address</th>
									<th>Status</th>
									<th style="width:30%;">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									for($i=0;$i<count($user);$i++)
									{ 
										$table = 'user_details';
										$where = array('user_id' => $user[$i]->id);
										$user_detail = $this->user_model->get_common($table, $where,'*',1);
										$table = 'resident_address';
										$where = array('user_id' => $user[$i]->id);
										$resident_address = $this->user_model->get_common($table, $where,'*',1);
								?>
								<tr class="odd gradeX">
									<td><?= $i+1; ?></td>
									<td><?= $user_detail->first.' '.$user_detail->middle,' '.$user_detail->last; ?></td>
									<td><?= $user[$i]->email; ?></td>
									<td><?= $user[$i]->contact; ?></td>
									<td><img src="<?php echo upload_path; ?>/profile/<?=$user[$i]->image; ?>" alt="<?= $user[$i]->email; ?>" height="80" width="60">
									</td>
									<td><?= $resident_address->address ." " . $resident_address->city. " ". $resident_address->state." ". $resident_address->country . " ".$resident_address->pincode ; ?></td>
									<td> 
										<?php 
											if($user[$i]->status_id == 1) 
											{ 
												echo 'Active'; 
											}else if($user[$i]->status_id == 2) 
											{	
												echo 'Inactive'; 
											}else if($user[$i]->status_id == 3) 
											{	
												echo 'Not Verified'; 
											}
										?>
									</td>
									<td>
										<?php if($user[$i]->status_id == 1) { ?>
											<a  href="<?= base_url('admin/update_admin_user_status/2/'.$user[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe" onclick="if(!confirm('Are you sure to make inactive?')) return false;"> Inactive </a>
										<?php } else if($user[$i]->status_id == 2) { ?>
											<a  href="<?= base_url('admin/update_admin_user_status/1/'.$user[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe" onclick="if(!confirm('Are you sure to make active?')) return false;"> Active </a>
										<?php } else if($user[$i]->status_id == 3) { ?>
											<a  href="<?= base_url('admin/update_admin_user_status/1/'.$user[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe" onclick="if(!confirm('Are you sure to make active?')) return false;"> Verifiy </a>
										<?php } ?>
										
											<a style=""  href="<?= base_url('admin/admin_user_details/'.$user[$i]->id); ?>" class="btn default btn-xs green-stripe">View Details </a>
											<a style=""  href="<?= base_url('admin/edit_admin_users/'.$user[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe">Edit </a>
																							
											<button class="btn btn-green btn-xs" id="send_sngl_btn_<?php echo $user[$i]->id;?>" data-toggle="modal" data-target="#send_singlemail"  onclick="putSendtoMailid('<?php echo $user[$i]->email;?>')" > Mail <i class="fa fa-envelope"></i></button> &nbsp;
											
											<a  href="<?php echo base_url('admin/update_admin_user_status/0/'.$user[$i]->id) ;?>" class="btn default btn-xs red-soft-stripe" onclick="if(!confirm('Are you sure to delete ? Dealer will be deleted permanently.')) return false;">Delete </a>
									</td>
								
								</tr>
								<?php 
									} 
								?>
					        </tbody>
						</table>
					</div>
				</div>
			</div>
				<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>	
</div>
</div>
	
</div>
	<!-- Tab End -->
	
</div>

</div>
<!-- END CONTENT -->

<!--send_bulk_email_popup_div-->
<div class="modal modal-flex fade" id="sendemailform" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="flexModalLabel">Send Email To Users</h4>
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

<!--send_single_email_popup_div-->
<div class="modal modal-flex fade" id="send_singlemail" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="flexModalLabel">Send Email</h4>
			</div>
			<form name="send_single_email_form" id="send_single_email_form" action="javascript:void(0)" method="post" >
                <div class="modal-body">
                    <!--preview_total_div-->
					<div class="totalaligndiv">
						<div class="row">
							<div class="col-md-12">
                           	 	<div class="input-group bmargindiv1 col-md-12">
                                	<span class="input-group-addon ndrftextwidth text-left">Send To :</span>
									<input type="text" name="send_to" id="send_to" value="" style="    width: 100%;" readonly>
                           		</div>
                        	</div>
						</div>
						
						<br>

						<div class="row">
                        	<div class="col-md-12">
                            	<div class="input-group bmargindiv1 col-md-12">
                                	<span class="input-group-addon ndrftextwidth text-left">Subject :</span>
                                	<input type="text" class="form-control" placeholder="Subject" name="sngl_subject" id="sngl_subject" maxlength="200">
                           		</div>
                        	</div>
						</div>
						
						<br>

						<div class="row">
                        	<div class="col-md-12">
                            	<div class="input-group bmargindiv1 col-md-12">
									<span class="input-group-addon ndrftextwidth text-left">Mail Content :</span>
									<textarea id="sngl_mail_body" name="sngl_mail_body" class="form-control" maxlength="1000" rows="2"  style="margin: 0px -0.5px 0px 0px; height: 120px; resize:none;"></textarea>
                            	</div>
                        	</div>
						</div>
						<br>
                       <div class="clearfix"></div>
                    </div>
                    <!--end_preview_total_div-->
                </div>
            </form>
			<div class="modal-footer">
				<button class="btn btn-info btn-md" onclick="sendMailToSingleUser()">Send</button>&nbsp;<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<!-- /.modal-content -->
    </div>
	<!-- /.modal-dialog -->
</div>
	
<?php
	$data ['script'] = "dashboard.js";
	$data ['initialize'] = "pageFunctions.init();";
	$this->load->view ( 'admin/_includes/footer', $data );
?>

<script type="text/javascript">

	$(document).ready(function()
	{
		$('#managed_datatable_all').dataTable();
	});

	function send_mail(all_users)
	{
		var status=1;
		var url="<?php echo base_url('admin/getuserList');?>";
		$.post(url,{"status":status,"all_users":all_users},function(res){
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
	
	function sendEmailToMultiple_users()
	{
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

		if((check > 0) && subject && mail_body )
		{
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
		}
		else
		{
			$('#mailsendbtn').prop('disabled', false);
			alert("Please enter all fields");
		}
	}
	
	function CheckAllUser()
	{
		if($("#chk_all_id").is(':checked')) {
            $(".chk_all_class").prop("checked", true);
		} else {
			$(".chk_all_class").prop("checked", false);
		}
	}

	function CheckspecificUser()
	{
		if($("#specific_user_list").is(':checked'))
		 {
			 $(".chk_unchk_class").prop("checked", false);
		} 
		else 
		{
			
			 $(".chk_unchk_class").prop("checked", false);
		}
	}
	
	function putSendtoMailid(email,id)
	{
		$("#send_to").val(email);
	}
	
	// For Email
	function sendMailToSingleUser()
	{
		var subject=$("#sngl_subject").val().trim();
		var mail_body=$("#sngl_mail_body").val().trim();
		
		if(subject && mail_body)
		{
			var user_data=$("#send_single_email_form").serialize();
			var url="<?php echo base_url('admin/sendMailToSingleUser');?>";
			$.post(url,{"user_data":user_data},function(res)
			{
				if(res)
				{
					$("#send_single_email_form")[0].reset(); // reset the form 
					//$('#modal').modal('toggle');
					$('#send_singlemail').modal('hide'); // close the modal
					 //window.location.href="<?php echo SUB_DIR.'User/userDetailList/';?>";
					alert("Mail sent successfully.");
				}
				else
				{
					alert("Mail didn't send.");
				}
			});
		}
		else
		{
			alert("Plese enter all fields.");
		}
	}
	
	function excel_all_user()
	{ 
		 window.location='excel_all_user';
	}
	  
	function pdf_all_user()
	{ 
		window.location='pdf_all_user';
	}	  
  </script>
  
	
