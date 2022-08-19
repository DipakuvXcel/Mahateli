<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">Sub-Users</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><span>Sub-users</span></li>
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
								class="caption-subject bold uppercase">Sub-users</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/add_user');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
							Add Sub-users</a>
						</div>
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
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<!--<th>Password</th>-->
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php for($i=0;$i<count($subusers);$i++){ ?>
									<tr class="odd gradeX">
										<td><?= $i+1; ?></td>
										<td><?= $subusers[$i]->name ?></td>
										<td><?= $subusers[$i]->email; ?></td>
										<td><?= $subusers[$i]->phone; ?></td>
										<!--<td><?= $subusers[$i]->password; ?></td>-->
										<td> <?php if($subusers[$i]->status_id == 1) { echo 'Active'; } 
										else if($subusers[$i]->status_id == 2) {	echo 'Inactive'; }?>
										</td>
					                    <td>
											 <?php if($subusers[$i]->status_id == 1){ ?>
				                    			<a href="<?= base_url('admin/update_subusers/2/'.$subusers[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe"
				                    				onclick="if(!confirm('Are you sure to make inactive?')) return false;"> Inactive </a>
												
											<?php }else if($subusers[$i]->status_id == 2){ ?>
												<a href="<?= base_url('admin/update_subusers/1/'.$subusers[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe"
													onclick="if(!confirm('Are you sure to make active?')) return false;"> Active </a>
											<?php } ?>
					                    	<a href="<?php echo base_url('admin/subusers_details/'.$subusers[$i]->id); ?>" class="btn default btn-xs blue-sharp-stripe"> Details </a>
											<a href="<?php echo base_url('admin/edit_subuser/'.$subusers[$i]->id); ?>" class="btn default btn-xs blue-sharp-stripe"> Edit </a>
											<a href="<?php echo base_url('admin/update_subusers/0/'.$subusers[$i]->id) ;?>" class="btn default btn-xs red-soft-stripe" 
												onclick="if(!confirm('Are you sure to delete ? Subuser will be deleted permanently.')) return false;">Delete </a>
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
<?php
$data ['script'] = "dashboard.js";
$data ['initialize'] = "pageFunctions.init();";
$this->load->view ( 'admin/_includes/footer', $data );
?>