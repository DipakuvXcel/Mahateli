<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title"> User Family Details </h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> 
					<a href="<?php echo base_url('admin'); ?>">Home</a> 
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url('admin/users'); ?>">User</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li><span> User Family Details</span></li>	
			</ul>
		</div>
		<!-- END PAGE HEADER-->

		<div class="row">
			<div class="col-md-12">
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
									<span class="caption-subject bold uppercase">Users Family Details</span>
							 		<!-- <button onclick="pdf_all_user()" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;PDF</button> -->
									<a href="<?php echo base_url('admin/excel_family_users_details/'.$id);?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active fa fa-download"> Excel</a>
								
								</div>
							<div class="actions">
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
									<th>Relation</th>
									<th>Status</th>
									<th style="width:37%;">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									for($i=0;$i<count($user_family);$i++)
									{ 
										$table = 'family_relation';
										$where = array('id' => $user_family[$i]->relation_id);
										$family_relation = $this->user_model->get_common($table, $where,'*',1);
								?>
								<tr class="odd gradeX">
									<td><?= $i+1; ?></td>
									<td><?= $user_family[$i]->first.' '.$user_family[$i]->middle,' '.$user_family[$i]->last; ?></td>
									<td><?= $user_family[$i]->email; ?></td>
									<td><?= $user_family[$i]->contact; ?></td>
									<td><img src="<?php echo upload_path; ?>/profile/<?=$user_family[$i]->image; ?>" alt="<?= $user_family[$i]->first; ?>" height="100" width="60">
									<td><?= $family_relation->family_relation_name; ?></td>
									<td> 
										<?php 
											 if($user_family[$i]->status == 0) 
											{	
												echo 'Delete'; 
											}
                                            elseif($user_family[$i]->status == 1) 
											{ 
												echo 'Active'; 
											}else if($user_family[$i]->status == 2) 
											{	
												echo 'Inactive'; 
											}else if($user_family[$i]->status == 3) 
											{	
												echo 'Not Verified'; 
											}
										?>
									</td>
									<td>
										<?php if($user_family[$i]->status == 1) { ?>
											<a  href="<?= base_url('admin/update_user_status/2/'.$user_family[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe" onclick="if(!confirm('Are you sure to make inactive?')) return false;"> Inactive </a>
										<?php } else if($user_family[$i]->status== 2) { ?>
											<a  href="<?= base_url('admin/update_user_status/1/'.$user_family[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe" onclick="if(!confirm('Are you sure to make active?')) return false;"> Active </a>
										<?php } else if($user_family[$i]->status == 3) { ?>
											<a  href="<?= base_url('admin/update_user_status/1/'.$user_family[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe" onclick="if(!confirm('Are you sure to make active?')) return false;"> Verifiy </a>
										<?php } ?>
										
											<a style=""  href="<?= base_url('admin/view_user_family_details/'.$user_family[$i]->id); ?>" class="btn default btn-xs green-stripe">View Details </a>
											<a style=""  href="<?= base_url('admin/edit_family_users/'.$user_family[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe">Edit </a>									
											<a  href="<?php echo base_url('admin/update_user_family_status/0/'.$user_family[$i]->id) ;?>" class="btn default btn-xs red-soft-stripe" onclick="if(!confirm('Are you sure to delete ? Dealer will be deleted permanently.')) return false;">Delete </a>
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

					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
		
		
</div>
<!-- END CONTENT -->

<?php
	$data ['script'] = "dashboard.js";
	$data ['initialize'] = "pageFunctions.init();";
	$this->load->view ( 'admin/_includes/footer', $data );
?>