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

		<h3 class="page-title">Enquiries</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><a href="<?php echo base_url('admin/enquiries'); ?>">Enquiries</a><i
					class="fa fa-angle-right"></i></li>
				<li><span>Enquiry Details</span></li>
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
								class="caption-subject bold uppercase blue-steel">Enquiry Details</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/enquiries');?>" class="btn btn-circle default">Back</a>
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
						
						<form id="add_student_form" class="horizontal-form">
							<div class="form-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><b>Name</b></label> <input
												id="name" name="name"
												class="form-control" type="text" value="<?= $enquiry->name; ?>" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><b>Email</b></label> <input
												id="email" name="email"
												class="form-control" type="text" value="<?= $enquiry->email; ?>" readonly>
										</div>
									</div>
									<!--/span-->
								</div>
								<!--/row-->

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><b>Phone</b></label> <input
												id="phone" name="phone"
												class="form-control" type="text" value="<?= $enquiry->phone; ?>" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><b>Want to be a volunteer?</b></label> <input
												id="phone" name="phone"
												class="form-control" type="text" value="<?= $enquiry->part_volunteer==1?'Yes':'No'; ?>" readonly>
										</div>
									</div>
									<!--/span-->
								</div>
								<!--/row-->

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><b>Want to be part of next social event?</b></label> <input
												id="email" name="email"
												class="form-control" type="text" value="<?= $enquiry->part_next_event==1?'Yes':'No'; ?>" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><b>Do you want to start & lead a new social event?</b></label> <input
												id="email" name="email"
												class="form-control" type="text" value="<?= $enquiry->part_lead_event==1?'Yes':'No'; ?>" readonly>
										</div>
									</div>
								</div>
								<!--/row-->

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><b>Details</b></label> 
											<textarea id="address" name="address" class="form-control" readonly><?= $enquiry->more_details; ?></textarea>
										</div>
									</div>
								</div>
								<!--/row-->
							</div>
							<div class="form-actions right">
								<a href="<?php echo base_url('admin/enquiries')?>" class="btn default">Cancel</a>
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