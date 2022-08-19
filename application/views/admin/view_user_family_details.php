<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title"> User Family Details </h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> 
					<a href="<?php echo base_url('admin'); ?>">Home</a> 
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url('admin/users'); ?>">Users</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li><span> User Family Details</span></li>	
			</ul>
		</div>
		<!-- END PAGE HEADER-->

		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet light ">
					<div class="portlet-title">
						<div class="caption font-dark">
							<i class="icon-settings font-dark"></i> 
							<span class="caption-subject bold uppercase">User Family Details</span>
						</div>
						<div class="actions">
								<a href="<?php echo base_url('admin/users');?>" class="btn btn-circle default"> Back</a>
						</div>
					</div>
					<div class="portlet-body">
					
					<?php 
						if($this->session->flashdata("success_message")!="")
						{
					?>
						<div class="Metronic-alerts alert alert-info fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<i class="fa-lg fa fa-check"></i>  
							<?php echo $this->session->flashdata("success_message");?>
						</div>
					<?php 
						}
						if($this->session->flashdata("error_message")!="")
						{
					?>
						<div class="Metronic-alerts alert alert-danger fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<i class="fa-lg fa fa-warning"></i>  
							<?php echo $this->session->flashdata("error_message");?>
						</div>
					<?php 
						}
						if(validation_errors()!="")
						{
					?>
						<div class="Metronic-alerts alert alert-danger fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i>  
								<?php echo validation_errors();?>
			                </div>
					<?php 
						}
						if( $this->upload->display_errors()!="")
						{
					?>
			            <div class="Metronic-alerts alert alert-danger fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<i class="fa-lg fa fa-warning"></i>  
								<?php echo  $this->upload->display_errors();?>
			            </div>
					<?php 
						}
					?>
						<input type="hidden" name="id" value="<?= $user->id; ?>">
							<div class="form-body">
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">Full Name : </label> <?= $userdetails->first.' '.$userdetails->middle.' '.$userdetails->last; ?> 
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label bold">Contact : </label> <?= $userdetails->contact; ?> 
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">Email : </label>
											 <?= $userdetails->email; ?> 
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-4">
										<div class="form-group">
                                        <label class="control-label bold">Relation : </label>
											<?php
                                            $table = 'family_relation';
                                            $where = array('id' => $userdetails->relation_id);
                                            $family_relation = $this->user_model->get_common($table, $where,'*',1);

                                             if($userdetails->relation_id == ''){ echo 'NA'; }else{ $userdetails->relation_id==$family_relation->id; echo  $family_relation->family_relation_name;; } ?>
										</div>
									</div>
								</div>									
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">Birth Date : </label>
											<?php if($userdetails->date_of_birth == '0000-00-00'){ echo 'NA'; }else{ echo $userdetails->date_of_birth; } ?>
										</div>
									</div>
									
									<div class="col-md-1"></div>
									
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label bold">Marital Status : </label>
                                            <?php
                                            $table = 'marital_status';
                                            $where = array('id' => $userdetails->marital_status);
                                            $marital_status = $this->user_model->get_common($table, $where,'*',1);

											 if($userdetails->marital_status == ''){ echo 'NA'; }else{$userdetails->marital_status==$marital_status->id; echo $marital_status->marital_status_name; } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">Mother tongue  : </label>
											<?php if($userdetails->language == ''){ echo 'NA'; }else{ echo $userdetails->language; } ?>
										</div>
									</div>
									
									<div class="col-md-1"></div>
									
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label bold" style="font-weight:800;">Religion : </label>
											<?php if($userdetails->religion == ''){ echo 'NA'; }else{ echo $userdetails->religion; } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">Caste : </label>
											<?php if($caste->caste_name == ''){ echo 'NA'; }else{ echo $caste->caste_name; } ?>
										</div>
									</div>
									
									<div class="col-md-1"></div>
									
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label bold">Sub Caste: </label>
											<?php if($caste->sub_caste_name == ''){ echo 'NA'; }else{ echo $caste->sub_caste_name; } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold"> Gender: </label>
											<?php if($userdetails->gender == ''){ echo 'NA'; }else{ echo $userdetails->gender; } ?>
										</div>
									</div>
									
									<div class="col-md-1"></div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label bold">Status : </label> <?php 
											if($userdetails->status == 0) 
											{ 
												echo 'Delete'; 
											}elseif($userdetails->status == 1) 
											{ 
												echo 'Active'; 
											}else if($userdetails->status == 2) 
											{	
												echo 'Inactive'; 
											}else if($userdetails->status == 3) 
											{	
												echo 'Not Verified'; 
											}
										?>
										</div>
									</div>
								<div class="col-md-3" style="margin-top: -220px;">
									<label><span>Profile : <br></span><img alt=""style="width:200px;height:250px;" src="<?php echo upload_path; ?>/profile/<?=$userdetails->image;?>" /></label><br>
								</div>
								</div>

								<div class="row">
								<div class="col-md-4 col-md-push-1">
									<h4>Permanent / Residential Address :</h4>
								</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">Address : </label> <?= $reside->address; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">Landmark : </label>
                                            <?php if($reside->landmark == ''){ echo 'NA'; }else{ echo $reside->landmark; } ?>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-4">
										<div class="form-group">
										<label class="control-label bold">City : </label> <?= $reside->city; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">District : </label> <?= $reside->district; ?>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label bold">Pincode : </label> <?= $reside->pincode; ?>
										</div>
									</div>
								</div>
									<div class="row">
									<div class="col-md-4 col-md-push-1">
									<div class="form-group">
											<label class="control-label bold">State : </label> <?= $reside->state; ?>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-4">
									<div class="form-group">
											<label class="control-label bold">Country : </label>
											<?= $reside->country;?>
										</div>
									</div>
								</div>
							
								<div class="row">
								<div class="col-md-4 col-md-push-1">
									<h4>Address For Correspondence:</h4>
								</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-6 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">Address : </label> <?= $corrs->address; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">Landmark : </label> 
                                            <?php if($corrs->landmark == ''){ echo 'NA'; }else{ echo $corrs->landmark; } ?>
                                     	</div>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-4">
										<div class="form-group">
										<label class="control-label bold">City : </label> <?= $corrs->city; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">District : </label> <?= $corrs->district; ?>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label bold">Pincode : </label> <?= $corrs->pincode; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-md-push-1">
										<div class="form-group">
											<label class="control-label bold">State : </label> <?= $corrs->state; ?>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label bold">Country : </label>
											<?= $corrs->country;?>
										</div>
									</div>
								</div>								
							</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
		
		
</div>
<!-- END CONTENT -->

<?php
	//$data ['script'] = "";
	//$data ['initialize'] = "pageFunctions.init();";
	$this->load->view ( 'admin/_includes/footer', $data );
?>