<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">
			Add Sub-user
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><a href="<?php echo base_url('admin/enquiries'); ?>">Sub-User</a>
					<i class="fa fa-angle-right"></i></li>
				<li><span> Add Sub-user</span>	
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
								class="caption-subject bold uppercase"> Add sub-user</span>
						</div>
						<div class="actions">
							
								<a href="<?php echo base_url('admin/subusers');?>"
									class="btn btn-circle default">
									Back</a>
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
			              
			             
		              
						<form id="add_student_form" class="horizontal-form" autocomplete="off" action="<?php echo base_url('admin/save_user');?>"
							method="post" enctype="multipart/form-data">
							<div class="form-body">
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Name</label><span style="color:red">*</span>
											<input id="name" name="name" class="form-control" type="text" value="<?= set_value('name'); ?>">
											
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Email</label><span style="color:red">*</span>
											<input id="email" name="email" class="form-control" type="text" value="<?= set_value('email'); ?>">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Contact</label><span style="color:red">*</span>
											<input id="contact" name="contact" class="form-control" type="text" value="<?= set_value('contact'); ?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Password</label><span style="color:red">*</span>
											<input id="pwd" name="pwd" class="form-control" type="password" value="<?= set_value('pwd'); ?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Confirm Pssword</label><span style="color:red">*</span>
											<input name="cpassword" class="form-control" maxlength="12" type="password"  value="<?= set_value('cpassword'); ?>" alt="Only 12 Character Allowed">
										</div>
									</div>
								</div>
								
								<div class="row">
                                  	<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Description</label><span style="color:red">*</span>
											<textarea id="user_desc" name="user_desc" class="form-control" rows="3"><?= set_value('user_desc'); ?></textarea>
										</div>
									</div>
								</div>
	
							</div>
							<div class="form-actions right">
								<button type="submit" class="btn blue">
									<i class="fa fa-check"></i> Submit
								</button>
								<a type="button" class="btn default" href="<?php echo base_url('admin/subusers');?>">Cancel</a>
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

<script>
	var base_url = "<?php echo base_url(); ?>";
</script>

<?php
$data ['script'] = "";
$data ['initialize'] = "pageFunctions.init();";
$this->load->view ( 'admin/_includes/footer', $data );
?>

<script>
	//CKEDITOR.replace( 'editor1' );
	//CKEDITOR.replace( 'editor2' );
	$(".my-datepicker").datepicker({ 
        minDate: 0,
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: '-100:0'
    });
</script>