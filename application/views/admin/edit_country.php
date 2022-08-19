<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">
			Edit Country
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><a href="<?php echo base_url('admin/country'); ?>">Country</a>
					<i class="fa fa-angle-right"></i></li>
				<li><span> Edit Country</span>	
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
								class="caption-subject bold uppercase"> Edit Country</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/country');?>" class="btn btn-circle default"> Back</a>
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
						  
						<form id="add_student_form" class="horizontal-form" action="<?php echo base_url('admin/update_edit_country');?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?= $country->id; ?>">
							<div class="form-body">
								  
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-2">
									<label class="control-label">Country Code</label><span style="color:red">*</span>
										<div class="form-group">
											<input id="code" name="code" class="form-control" type="text" value="<?= set_value('code', $country->country_code); ?>">
										</div>
									</div>
									<div class="col-md-4">
										<label class="control-label">Country Name</label><span style="color:red">*</span>
										<div class="form-group">
											<input id="country" name="country" class="form-control" type="text" value="<?= set_value('country', $country->country_name); ?>">
										</div>
									</div>
	 
									<div class="col-md-3" style="margin-top: 2%;">
									<button type="submit" class="btn blue">
										<i class="fa fa-check"></i> Update
									</button>
									<a type="button" class="btn default" href="<?php echo base_url('admin/country');?>">Cancel</a>
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
