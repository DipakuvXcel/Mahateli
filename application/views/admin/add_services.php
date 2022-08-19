<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">
			Add Services 
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><a href="<?php echo base_url('admin/services'); ?>">Services</a>
					<i class="fa fa-angle-right"></i></li>
				<li><span> Add Services </span>	
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
								class="caption-subject bold uppercase"> Add Service </span>
						</div>
						<div class="actions">
							
								<a href="<?php echo base_url('admin/services');?>"
									class="btn btn-circle default">
									Back</a>
						</div>
					</div>
					<div class="portlet-body">
					
							<?php if($this->session->flashdata("success_message")!=""){?>
			                <div class="Metronic-alerts alert alert-info fade in">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true"></button>
								<i class="fa-lg fa fa-check"></i>  <?php echo $tsave_imagehis->session->flashdata("success_message");?>
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
			              
			             
		              
						<form id="add_student_form" class="horizontal-form" action="<?php echo base_url('admin/save_services');?>"
							method="post" enctype="multipart/form-data">
							<div class="form-body">
								<div class="row">
									<div class="col-md-4 col-md-push-2">
										<div class="form-group">
											<label class="control-label">Service Name</label><span style="color:red">*</span>
											<input id="product_name" name="product_name" class="form-control" type="text" value="<?= set_value('product_name'); ?>">
										</div>
									</div>
									<div class="col-md-4 col-md-push-2">
										<div class="form-group">
											<label class="control-label">Service Image</label><span style="color:red">*</span><br>
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<img id="blah" src="#" style="display:none;" alt="your image" />
												<div class="input-group input-large">
													<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
														<i class="fa fa-file fileinput-exists"></i>&nbsp; 
														<span class="fileinput-filename"> </span>
													</div>
													<span class="input-group-addon btn default btn-file"> 
														<span class="fileinput-new"> Select file </span> 
														<span class="fileinput-exists"> Change </span> 
														<input type="file" name="image" onchange="readURL(this);" accept="image/*">
													</span> 
													
													<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput" onclick="removeSingleImg()">X</a>
														
												</div>
											</div>
											<span class="help-block"> Allowed file types .jpg, .png</span>
										</div>
									</div>
						     	</div>
									
								<div class="row">
									<div class="col-md-4 col-md-push-2">
										<div class="form-group">
											<label class="control-label">Main Category</label><span style="color:red">*</span>
											
											<select id="main_category" name="main_category" class="form-control" onChange="service_subcat(this.value);" >
												<option value="">--Select--</option>
												<option value="1">Customized Designing</option>
												<option value="2">Upholstery</option>
											</select>
											
										</div>
									</div>
									<div class="col-md-4 col-md-push-2" id="service_subcat">
										<div class="form-group">
											<label class="control-label">Sub Category</label><span style="color:red">*</span>
											
											<select id="sub_category" name="sub_category" class="form-control"  >
												<option value="">--Select--</option>
												<?php for($i=0;$i<count($category);$i++){ ?>
												<option value="<?= $category[$i]->id ?>"><?php echo $category[$i]->name; ?></option>
												<?php } ?>
											</select>
											
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Services Description</label>
										<textarea id="product_desc" name="product_desc" class="form-control" rows="3"><?= set_value('product_desc'); ?></textarea>
									</div>
								</div>

								</div>

							<div class="form-actions right">
								<button type="submit" class="btn blue">
									<i class="fa fa-upload"></i> Upload
								</button>
								<a type="button" class="btn default" href="<?php echo base_url('admin/services');?>">Cancel</a>
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
//$data ['script'] = "payments.js";
//$data ['initialize'] = "pageFunctions.init();";
$this->load->view ( 'admin/_includes/footer', $data );
?>

<script>
	
	function service_subcat(subcat_id){
		if(subcat_id==1){
			$('#service_subcat').show();
		}else{
			$('#service_subcat').hide();
		}
	}
	
	function readURL(input) {
		
        if (input.files && input.files[0]) {
			$('#blah').show();
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(98)
                    .height(90);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
	
	function removeSingleImg(){
		$('#blah').hide();
	}
</script>