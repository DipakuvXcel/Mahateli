<?php 
$this->load->view('admin/_includes/header');
$this->load->helper('custom');
?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">City</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><span>City</span></li>
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
								class="caption-subject bold uppercase"> Add City</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/country');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add Country</a>
			                <a href="<?php echo base_url('admin/add_state');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add State</a>
							<a href="<?php echo base_url('admin/add_area');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add Area</a>	
								
						</div>
					</div>
					<div class="portlet-body">
		              
						<form id="add_student_form" class="horizontal-form" action="<?php echo base_url('admin/save_city');?>" method="post" enctype="multipart/form-data">
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
											
											<select id="state" name="state" class="form-control">
												<option value="">Select</option>
												<?php for($i=0;$i<count($state);$i++){ ?>
												<option value="<?= $state[$i]->id ?>"><?php echo $state[$i]->state_name; ?></option>
												<?php } ?>
											</select>
											
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">City Name</label><span style="color:red">*</span>
										<input id="city" name="city" class="form-control" type="text" value="<?= set_value('city'); ?>">
                                    	</div>
									</div>
								</div>
							   <div class="row">
								<div class="col-md-9"></div>
								<div class="col-md-3">
								<button type="submit" class="btn blue">
									<i class="fa fa-check"></i> Submit
								</button>
								<a type="button" class="btn default" href="<?php echo base_url('admin/add_city');?>">Cancel</a>
								</div>	 
								</div>
								
							</div>
							<!--<div class="form-actions right">
								<button type="submit" class="btn blue">
									<i class="fa fa-check"></i> Submit
								</button>
								<a type="button" class="btn default" href="<?php echo base_url('admin/stories');?>">Cancel</a>
							</div>-->
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
								<a href="<?php echo base_url('admin/category');?>"
									class="btn btn-circle default">
									Back</a>
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
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php for($i=0;$i<count($city);$i++){ ?>
									<tr class="odd gradeX">
										<td><?= $i+1; ?></td>
										<td><?php echo get_country_name($city[$i]->country); ?></td>
										<td><?php echo get_state_name($city[$i]->state); ?></td>
										<td><?= $city[$i]->city_name ?></td>
										<td> <?php if($city[$i]->status_id == 1) { echo 'Active'; }
											else if($city[$i]->status_id == 2) {	echo 'Inactive'; } 
											?>
										</td>
					                    <td>
						                    <?php if($city[$i]->status_id == 1){ ?>
				                    			<a href="<?= base_url('admin/update_city_status/2/'.$city[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe"
				                    				onclick="if(!confirm('Are you sure to make inactive?')) return false;"> Inactive </a>
												
											<?php }else if($city[$i]->status_id == 2){ ?>
												<a href="<?= base_url('admin/update_city_status/1/'.$city[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe"
													onclick="if(!confirm('Are you sure to make active?')) return false;"> Active </a>
											<?php } ?>
												<a href="<?= base_url('admin/edit_city/'.$city[$i]->id); ?>" class="btn default btn-xs purple-stripe"> Edit </a>

												<a href="<?php echo base_url('admin/update_city_status/0/'.$city[$i]->id) ;?>" class="btn default btn-xs red-soft-stripe" 
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
</script>