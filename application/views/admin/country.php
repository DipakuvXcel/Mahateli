<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">Country</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><span>Country</span></li>
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
								class="caption-subject bold uppercase"> Add Country</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/add_state');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add State</a>
							<a href="<?php echo base_url('admin/add_city');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add City</a>
			                <a href="<?php echo base_url('admin/add_area');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add Area</a>
						</div>
					</div>
					<div class="portlet-body">
						<!--
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
			              -->
			             
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
						<form id="add_student_form" class="horizontal-form" action="<?php echo base_url('admin/save_country');?>"
							method="post" enctype="multipart/form-data">
							<div class="form-body">
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-2">
									<label class="control-label">Country Code</label><span style="color:red">*</span>
										<div class="form-group">
											<input id="code" name="code" class="form-control" type="text" value="<?= set_value('code'); ?>">
										</div>
									</div>
									<div class="col-md-4">
									<label class="control-label">Country</label><span style="color:red">*</span>
										<div class="form-group">
											<input id="country" name="country" class="form-control" type="text" value="<?= set_value('country'); ?>">
										</div>
									</div>
									<div class="col-md-3" style="margin-top: 2%;">
										<button type="submit" class="btn blue">
											<i class="fa fa-check"></i> Save
										</button>
										<a type="button" class="btn default" href="<?php echo base_url('admin/country');?>">Cancel</a>
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
								class="caption-subject bold uppercase">Country</span>
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
									<th>Country Code</th>
									<th>Country Name</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php for($i=0;$i<count($country);$i++){ ?>
									<tr class="odd gradeX">
										<td><?= $i+1; ?></td>
										<td><?= $country[$i]->country_code ?></td>
										<td><?= $country[$i]->country_name ?></td>
										
										<td> <?php if($country[$i]->status_id == 1) { echo 'Active'; }
											else if($country[$i]->status_id == 2) {	echo 'Inactive'; } 
											?></td>
					                    <td>
					                    	
						                    
						                    <?php if($country[$i]->status_id == 1){ ?>
				                    			<a href="<?= base_url('admin/update_country_status/2/'.$country[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe"
				                    				onclick="if(!confirm('Are you sure to make inactive?')) return false;"> Inactive </a>
												
											<?php }else if($country[$i]->status_id == 2){ ?>
												<a href="<?= base_url('admin/update_country_status/1/'.$country[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe"
													onclick="if(!confirm('Are you sure to make active?')) return false;"> Active </a>
											<?php } ?>
												<a href="<?= base_url('admin/edit_country/'.$country[$i]->id); ?>" class="btn default btn-xs purple-stripe"> Edit </a>

												<a href="<?php echo base_url('admin/update_country_status/0/'.$country[$i]->id) ;?>" class="btn default btn-xs red-soft-stripe" 
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
