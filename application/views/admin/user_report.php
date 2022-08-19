<?php 
	$this->load->view('admin/_includes/header');
?>
 
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
	<!-- BEGIN PAGE HEADER-->
	<h3 class="page-title">Users Report</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> 
				<a href="<?php echo base_url('admin'); ?>">Home</a> 
				<i class="fa fa-angle-right"></i></li>
				<li><span>Users Report</span></li>
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
									<span class="caption-subject bold uppercase">Users Report</span>
							 			
								</div>
							<div class="actions">
							<!-- <button onclick="pdf_all_user()" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;PDF</button> -->
                            <a href="<?php echo base_url('admin/excel_all_user');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active fa fa-download"> Excel</a>
							
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
									<th>User Name</th>
                  					<th>Email</th>
									<th>Contact</th>
									<th>Image</th>
									<th>Address</th>
									<th>Relation</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$counter=1;
									for($i=0;$i<count($user);$i++)
									{ 
										$table = 'user_details';
										$where = array('user_id' => $user[$i]->id,'status !=' => 0);
										$user_detail = $this->user_model->get_common($table, $where,'*',1);
										$table = 'resident_address';
										$where = array('user_id' => $user[$i]->id,'status !=' => 0);
										$resident_address = $this->user_model->get_common($table, $where,'*',1);
								?>
								<tr class="odd gradeX">
									<td><?php echo $counter ?></td>
									<td><?= $user_detail->first.' '.$user_detail->middle,' '.$user_detail->last; ?></td>
									<td><?php if($user[$i]->email == ''){ echo 'NA'; }else{ echo $user[$i]->email; } ?> </td>
									<td><?php if($user[$i]->contact == ''){ echo 'NA'; }else{ echo $user[$i]->contact; } ?></td>
									<td><img src="<?php echo upload_path; ?>/profile/<?=$user[$i]->image; ?>" alt="<?= $user[$i]->email; ?>" height="80" width="60">
									</td>
									<td><?= $resident_address->address ." " . $resident_address->city. " ". $resident_address->state." ". $resident_address->country . " ".$resident_address->pincode ; ?></td>
									<td>Register User</td>
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
								</tr>
								<?php 
									$table = 'user_family_details';
									$where = array('user_id ' => $user[$i]->id,'status !=' => 0);
									$table = 'user_family_details';
									$user_family = $this->user_model->get_common($table, $where,'*',2,'');
								
									for($j=0;$j<count($user_family);$j++)
									{ 
										$table = 'family_relation';
										$where = array('id' => $user_family[$j]->relation_id,'status !=' => 0);
										$family_relation = $this->user_model->get_common($table, $where,'*',1);
                                        $table = 'resident_address';
										$where = array('family_id' => $user_family[$j]->id,'status !=' => 0);
										$resident_address = $this->user_model->get_common($table, $where,'*',1);
								?>
								<tr class="odd gradeX">
								<td><?php echo $counter ?></td>
									<td><?= $user_family[$j]->first.' '.$user_family[$j]->middle,' '.$user_family[$j]->last; ?></td>
									<td><?= $user_family[$j]->email; ?></td>
									<td><?= $user_family[$j]->contact; ?></td>
									<td><img src="<?php echo upload_path; ?>/profile/<?=$user_family[$j]->image; ?>" alt="<?= $user_family[$j]->first; ?>" height="100" width="60">
                                	<td><?= $resident_address->address ." " . $resident_address->city. " ". $resident_address->state." ". $resident_address->country . " ".$resident_address->pincode ; ?></td>
									<td><?= $family_relation->family_relation_name; ?></td>
									<td> 
										<?php 
											 if($user_family[$j]->status == 0) 
											{	
												echo 'Delete'; 
											}
                                            elseif($user_family[$j]->status == 1) 
											{ 
												echo 'Active'; 
											}else if($user_family[$j]->status == 2) 
											{	
												echo 'Inactive'; 
											}else if($user_family[$j]->status == 3) 
											{	
												echo 'Not Verified'; 
											}
										?>
									</td>
								
								</tr>
								<?php 
									} 
									++$counter;
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

	
	function CheckAllUser()
	{
		if($("#chk_all_id").is(':checked')) {
            $(".chk_all_class").prop("checked", true);
		} else {
			$(".chk_all_class").prop("checked", false);
		}
	}

	
	function putSendtoMailid(email,id)
	{
		$("#send_to").val(email);
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
  
	
