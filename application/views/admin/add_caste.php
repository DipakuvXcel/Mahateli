<?php 
$this->load->view('admin/_includes/header');
?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">Caste</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><span>Caste</span></li>
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
								class="caption-subject bold uppercase"> Add Caste</span>
						</div>
						<div class="actions">
						</div>
					</div>
					<div class="portlet-body">
		              
						<form id="add_student_form" class="horizontal-form" action="<?php echo base_url('admin/save_caste');?>" method="post" enctype="multipart/form-data">
							<div class="form-body">
								<div class="row">
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
                                  <div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Caste</label><span style="color:red">*</span>
										<input id="caste" name="caste" class="form-control" type="text" value="<?= set_value('caste'); ?>">
                                    	</div>
									</div>
								<div class="col-md-3" style="padding-top: 6px;">
                                    <br>
                                <div class="form-group">
								<button type="submit" class="btn blue">
									<i class="fa fa-check"></i> Submit
								</button>
								<a type="button" class="btn default" href="<?php echo base_url('admin/add_caste');?>">Cancel</a>
								</div>	 
								</div>	 
								</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
		
		<!-- ------------------------------ -->

		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet light ">
					<div class="portlet-title">
						<div class="caption font-dark">
							<i class="icon-settings font-dark"></i> <span
								class="caption-subject bold uppercase">Caste</span>
								<!--<a href="<?php echo base_url('admin/downloadStory');?>">Download</a>-->
						</div>
						 
						<div class="actions">
						</div>
					</div>
					<div class="portlet-body">
							 
						<table
							class="table table-striped table-bordered table-hover table-checkable order-column"
							id="managed_datatable" data-page-length='10'>
							<thead>
								<tr>
									<th>Sr.No.</th>
									<th>Caste</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody >
								<?php for($i=0;$i<count($caste);$i++){
																		
								?>
									<tr class="odd gradeX">
										<td><?= $i+1; ?></td>
										<td><?= $caste[$i]->caste_name; ?></td>	 
										<td> <?php if($caste[$i]->status == 1) { echo 'Active'; }
											else if($caste[$i]->status == 2) {	echo 'Inactive'; } ?></td>
					                    <td>
					                        <?php if($caste[$i]->status == 1){ ?>
				                    			<a href="<?= base_url('admin/update_caste/2/'.$caste[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe"
				                    				onclick="if(!confirm('Are you sure to make inactive?')) return false;"> Inactive </a>
												
											<?php }else if($caste[$i]->status == 2){ ?>
												<a href="<?= base_url('admin/update_caste/1/'.$caste[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe"
													onclick="if(!confirm('Are you sure to make active?')) return false;"> Active </a>
											<?php } ?>
												<a href="<?php echo base_url('admin/edit_caste/'.$caste[$i]->id) ;?>" class="btn default btn-xs purple-stripe">Edit </a>
												<a href="<?php echo base_url('admin/update_caste/0/'.$caste[$i]->id) ;?>" class="btn default btn-xs red-soft-stripe" 
													onclick="if(!confirm('Are you sure to delete!')) return false;">Delete </a>
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