<?php $this->load->view('admin/_includes/header');?>
<style>
.student-info-container strong {
	font-weight: 600;
}
</style>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">Sub-users</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><a href="<?php echo base_url('admin/subusers'); ?>">Sub-users</a><i
					class="fa fa-angle-right"></i></li>
				<li><span>Sub-user Edit</span></li>
			</ul>

		</div>
		<!-- END PAGE HEADER-->

		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet light ">
					<div class="portlet-title">
						<div class="caption ">
							<i class="icon-settings blue-steel "></i> <span
								class="caption-subject bold uppercase blue-steel">Sub-users Edit</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/subusers');?>" class="btn btn-circle default">Back</a>
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
						
						<form id="add_student_form" action="<?php echo base_url('admin/update_subuser_details');?>"
							method="post" class="horizontal-form">
							<input type="hidden" name="id" value="<?= $subusers->id; ?>">
							<div class="form-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><b>Name</b></label><span style="color:red">*</span>
											<input id="name" name="name" class="form-control" type="text" value="<?= $subusers->name; ?>" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><b>Email</b></label><span style="color:red">*</span>
											<input id="email" name="email" class="form-control" type="text" value="<?= $subusers->email; ?>" >
										</div>
									</div>
									<!--/span-->
								</div>
								<!--/row-->

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><b>Phone</b></label><span style="color:red">*</span>
											<input id="contact" name="contact" class="form-control" type="text" value="<?= $subusers->phone; ?>" >
										</div>
									</div>
									   <!--<div class="col-md-6">
										  <div class="form-group">
											<label class="control-label"><b>Password</b></label> <input
												id="phone" name="phone"
												class="form-control" type="password" value="<?= $subusers->password; ?>" >
										</div>
									</div>-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><b>Details</b></label><span style="color:red">*</span> 
											<textarea id="user_desc" name="user_desc" class="form-control" ><?= $subusers->about; ?></textarea>
										</div>
									</div>
								</div>
									 
								 
									
								 
								<!--/row-->
							</div>
							<div class="form-actions right">
									<button type="submit" class="btn blue">
									<i class="fa fa-check"></i> Update
								</button>
								<a href="<?php echo base_url('admin/subusers')?>" class="btn default">Cancel</a>
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
$data ['script'] = "";
$data ['initialize'] = "pageFunctions.init();";
$this->load->view ( 'admin/_includes/footer', $data );
?>