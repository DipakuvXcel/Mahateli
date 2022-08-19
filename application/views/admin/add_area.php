<?php 
$this->load->view('admin/_includes/header');
$this->load->helper('custom');
?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">Area-Pincode</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><span>Area-Pincode</span></li>
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
								class="caption-subject bold uppercase"> Add Area-Pincode</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/country');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add Country</a>
			                <a href="<?php echo base_url('admin/add_state');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add State</a>
							<a href="<?php echo base_url('admin/add_city');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add City</a>	
								
						</div>
					</div>
					<div class="portlet-body">
		              
						<form id="add_student_form" class="horizontal-form" action="<?php echo base_url('admin/save_area');?>" method="post" enctype="multipart/form-data">
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
								  
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Country</label><span style="color:red">*</span>
											
											<select id="country" name="country" onchange="selectCountry(this.value)" class="form-control">
												<option value="">Select</option>
												<?php for($i=0;$i<count($country);$i++){ ?>
												<option value="<?= $country[$i]->id ?>"><?php echo $country[$i]->country_name.' ('.$country[$i]->country_code.')'; ?></option>
												<?php } ?>
											</select>
											
										</div>
									</div>
									
									<div class="col-md-4" id="bindState">
										<div class="form-group">
											<label class="control-label">State</label><span style="color:red">*</span>
											
											<select id="state" name="state" class="form-control" onchange="selectState(this.value)">
												<option value="">Select</option>
												<?php for($i=0;$i<count($state);$i++){ ?>
												<option value="<?= $state[$i]->id ?>"><?php echo $state[$i]->state_name; ?></option>
												<?php } ?>
											</select>
											
										</div>
									</div>
									
									<div class="col-md-4" id="bindCity">
										<div class="form-group">
											<label class="control-label">City</label><span style="color:red">*</span>
											
											<select id="city" name="city" class="form-control">
												<option value="">Select</option>
												<?php for($i=0;$i<count($city);$i++){ ?>
												<option value="<?= $city[$i]->id ?>"><?php echo $city[$i]->city_name; ?></option>
												<?php } ?>
											</select>
											
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Area</label><span style="color:red">*</span>
											<input id="area" name="area" class="form-control" type="text" value="<?= set_value('area'); ?>">
                                    	</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Pincode</label><span style="color:red">*</span>
											<input id="pincode" name="pincode" class="form-control" min="10000" type="number" value="<?= set_value('pincode'); ?>">
                                    	</div>
									</div>
									<div class="col-md-3" style="margin-top: 2%;">
										<button type="submit" class="btn blue">
											<i class="fa fa-check"></i> Submit
										</button>
										<a type="button" class="btn default" href="<?php echo base_url('admin/add_area');?>">Cancel</a>
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
								class="caption-subject bold uppercase">Category</span>
								<!--<a href="<?php echo base_url('admin/downloadStory');?>">Download</a>-->
						</div>
						 
						<div class="actions">
							<a href="<?php echo base_url('admin/country');?>" class="btn btn-circle default"> Back</a>
						</div>
					</div>
					<div class="portlet-body">
							 
						<table
							class="table table-striped table-bordered table-hover table-checkable order-column"
							id="managed_datatable" data-page-length='10'>
							<thead>
								<tr>
									<th>Sr.No.</th>
									<th>Country</th>
									<th>State</th>
									<th>City</th>
									<th>Area</th>
									<th>Pincode</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php for($i=0;$i<count($area);$i++){ ?>
									<tr class="odd gradeX">
										<td><?= $i+1; ?></td>
										<td><?php echo get_country_name($area[$i]->country_id); ?></td>
										<td><?php echo get_state_name($area[$i]->state_id); ?></td>
										<td><?php echo get_city_name($area[$i]->city_id); ?></td>
										<td><?= $area[$i]->area_name ?></td>
										<td><?= $area[$i]->pin_code ?></td>
										<td> <?php if($area[$i]->status_id == 1) { echo 'Active'; }
											else if($area[$i]->status_id == 2) {	echo 'Inactive'; } 
											?>
										</td>
					                    <td>
						                    <?php if($area[$i]->status_id == 1){ ?>
				                    			<a href="<?= base_url('admin/update_area_status/2/'.$area[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe"
				                    				onclick="if(!confirm('Are you sure to make inactive?')) return false;"> Inactive </a>
												
											<?php }else if($area[$i]->status_id == 2){ ?>
												<a href="<?= base_url('admin/update_area_status/1/'.$area[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe"
													onclick="if(!confirm('Are you sure to make active?')) return false;"> Active </a>
											<?php } ?>
												<a href="<?= base_url('admin/edit_area/'.$area[$i]->id); ?>" class="btn default btn-xs purple-stripe"> Edit </a>

												<a href="<?php echo base_url('admin/update_area_status/0/'.$area[$i]->id) ;?>" class="btn default btn-xs red-soft-stripe" 
													onclick="if(!confirm('Are you sure to delete?')) return false;">Delete </a>
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

<script>
	function selectCountry(id){  

		var url="<?php echo base_url('admin/bindState'); ?>";
		$.post(url,{"id":id},function(res){
			 $("#bindState").html(res);
		});  
	}
	
	function selectState(id){  

		var url="<?php echo base_url('admin/bindCity'); ?>";
		$.post(url,{"id":id},function(res){
			 $("#bindCity").html(res);
		});  
	}
</script>