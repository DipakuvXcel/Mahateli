<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">
			Edit Video
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><a href="<?php echo base_url('admin/gallery'); ?>"></a>
					<i class="fa fa-angle-right"></i></li>
				<li><span> Edit Video</span>	
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
								class="caption-subject bold uppercase"> Edit Video</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/video');?>"class="btn btn-circle default">
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
			              
			             
		              
						<form id="add_student_form" class="horizontal-form" action="<?php echo base_url('admin/update_video_details');?>"
							method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?= $video->id; ?>">
							<div class="form-body">
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label">Enter Youtube Video Id</label><span style="color:red">*</span>
											<input type="text" name="video_link" id="video_link" class="form-control" value="<?= set_value('video_link', $video->video_link); ?>" >
										</div>
									</div>
									<div class="col-md-2 col-md-push-1" >
										<iframe width="200" height="100" src="<?= 'https://www.youtube.com/embed/'.$video->video_link; ?>">
										</iframe>
									</div>
									<div class="col-md-4 col-md-push-2">
										<div class="form-group">
											<label class="control-label">Video Title</label><span style="color:red">*</span>
											<input id="video_title" name="video_title" class="form-control" type="text" value="<?= set_value('video_title', $video->slogan); ?>">
										</div>
									</div>
									
									<!--<div class="col-md-2 col-md-push-1" >
									<video width="100" height="100" controls>
											  <source src="<?= upload_path.'videos/'.$video->video_link; ?>" type="video/mp4">
											  <source src="<?= upload_path.'videos/'.$video->video_link; ?>" type="video/3gp">
											  Your browser does not support the video tag.
										</video>
									</div>
									
									<div class="col-md-4 col-md-push-1" id="video_id" >
										<div class="form-group">
											<label class="control-label">Upload Video</label><span style="color:red">*</span><br>
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="input-group input-large">
													<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
														<i class="fa fa-file fileinput-exists"></i>&nbsp; 
														<span class="fileinput-filename"> </span>
													</div>
													<span class="input-group-addon btn default btn-file"> 
														<span class="fileinput-new"> Select file </span> 
														<span class="fileinput-exists"> Change </span> 
														<input type="file" name="video" accept="video/mp4">
													</span> 
													<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> X </a>
														
												</div>
											</div>
											<span class="help-block"> Allowed file type .mp4</span>
										</div>
									</div>-->
									<!--<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Video Slogan Marathi</label><span style="color:red">*</span>
											<input id="ma_slogan" name="ma_slogan" class="form-control" type="text" value="<?= set_value('ma_slogan', $video->ma_slogan); ?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Discount Line</label>
											<input id="disc" name="disc" class="form-control" type="text" value="<?= set_value('disc', $video->disc); ?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Discount Line Marathi</label>
											<input id="ma_disc" name="ma_disc" class="form-control" type="text" value="<?= set_value('ma_disc', $video->ma_disc); ?>">
										</div>
									</div>-->
									
								</div>
			
							</div>
							<div class="form-actions right">
								<button type="submit" class="btn blue">
									<i class="fa fa-check"></i> Update
								</button>
								<a type="button" class="btn default" href="<?php echo base_url('admin/video');?>">Cancel</a>
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
$data ['script'] = "payments.js";
$data ['initialize'] = "pageFunctions.init();";
$this->load->view ( 'admin/_includes/footer', $data );
?>