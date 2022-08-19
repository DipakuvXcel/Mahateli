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

		<h3 class="page-title">Profile</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><span>Profile</span></li>
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
								class="caption-subject bold uppercase blue-steel">Profile</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/dashboard');?>" class="btn btn-circle default">Back</a>
						</div>
					</div>
					<div class="portlet-body">

						<div class="form-body">
							<div class="row">
								<div class="col-md-2">
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label class="control-label"><b>Name : </b></label> 
										<label> <?= $profile->name; ?>  </label>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label class="control-label"><b>Email : </b></label> 
										<label> <?= $profile->email; ?>  </label>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->

							<div class="row">
								<div class="col-md-2">
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label class="control-label"><b>Contact : </b></label>
										<label> <?= $profile->contact; ?>  </label>
									</div>
								</div> 
								
							</div>
							<div class="row">
								<div class="col-md-2">
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label class="control-label"><b>State : </b></label> 
										<label> <?= $profile->state; ?>  </label>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label class="control-label"><b>City : </b></label> 
										<label> <?= $profile->city; ?>  </label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label"><b>Address : </b></label> 
										<label> <?= $profile->address1; ?>  </label>
									</div>
								</div>
							<!--/row-->
							</div>
				 
						</div>
					</div>
				<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>

		</div>
	<!-- END CONTENT BODY -->
	</div>
</div>
<!-- END CONTENT -->
<?php
$this->load->view ( 'admin/_includes/footer', $data );
?>