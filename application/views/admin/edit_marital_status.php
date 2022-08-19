<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">
			Edit Marital Status
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><a href="<?php echo base_url('admin/add_city'); ?>">Marital Status</a>
					<i class="fa fa-angle-right"></i></li>
				<li><span> Edit Marital Status</span>	
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
								class="caption-subject bold uppercase"> Edit Marital Status</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/add_marital_status');?>" class="btn btn-circle default"> Back</a>
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
			              
			              <?php if( $this->upload->display_errors()!=""){?>
			                <div
								class="Metronic-alerts alert alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i>  <?php echo  $this->upload->display_errors();?>
			                </div>
			              <?php }?> 
						  
						<form id="add_student_form" class="horizontal-form" action="<?php echo base_url('admin/update_edit_marital_status');?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?= $marital_status->id; ?>">
							<div class="form-body">
								  
								<div class="row">
									<div class="col-md-3"></div>
									 
									<div class="col-md-4">
										<label class="control-label">Marital Status Name</label><span style="color:red">*</span>
										<div class="form-group">
											<input id="marital_status" name="marital_status" class="form-control" type="text" value="<?= set_value('marital_status', $marital_status->marital_status_name); ?>">
										</div>
									</div>
	 
									<div class="col-md-3" style="margin-top: 2%;">
									<button type="submit" class="btn blue">
										<i class="fa fa-check"></i> Update
									</button>
									<a type="button" class="btn default" href="<?php echo base_url('admin/add_marital_status');?>">Cancel</a>
									</div>	 
								</div>

							</div>
							 
						</form>
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
$this->load->view ( 'admin/_includes/footer', $data );
?>
