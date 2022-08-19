<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<style>

	.dashboard-stat .details .number 
	{
		padding-top: 25px;
		text-align: right;
		font-size: 20px;
		line-height: 36px;
		letter-spacing: -1px;
		margin-bottom: 0;
		font-weight: 300;
	}

	.checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"], .radio input[type="radio"], .radio-inline input[type="radio"] 
	{
		position: absolute;
		margin-left: -10px;
		margin-top: 4px;
	}	
</style>

<script>
 
	function showdiv1()
	{
		$('#display_Web').hide();
		$('#edit_Web').show();
	}


	function showdiv2()
	{
		$('#display_Web').show();
		$('#edit_Web').hide();
	}


	function add_Web()
	{ 		
		$("#Web_form").submit(function(e) 
		{
			if (e.isDefaultPrevented()) 
			{
			} 
			else 
			{
			
				e.preventDefault();
				document.getElementById("btn2").disabled = true;
				var myform = document.getElementById("Web_form");
				var fd = new FormData(myform);
				$.ajax({
					url: '<?php echo base_url("admin/update_Web");?>',
					type: "POST",
					data: fd,
					cache: false,
					processData: false,  // tell jQuery not to process the data
					contentType: false,   // tell jQuery not to set contentType
						success: function (data) 
						{
							alert(data);
							if(data==1){
								alert("Web Details Updated Successfully..");
							}else{
								alert("Web Details Not Updated...try again!");
							}
							
							location.reload();
							
						}
				});
			
			}
		});
	}
</script>


<?php 
	$this->db->select('*'); 
	$query = $this->db->get('about_shop_own'); 
	$this->db->where('status', 1);
	$Web_data = $query->result();		
?>
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
			Dashboard <?php //print_r($Web_data);
			 echo $Web_data[0]->Web_name;?>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> 
				<a href="<?php echo base_url('admin/dashboard');?>">Home</a>
				<i class="fa fa-angle-right"></i></li>
				<li><span>Dashboard</span></li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN DASHBOARD STATS 1-->
		<?php
			if($this->session->flashdata("success_message")!="")
			{
		?>
            <div class="Metronic-alerts alert alert-info fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
				<i class="fa-lg fa fa-check"></i>  <?php echo $this->session->flashdata("success_message");?>
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
		?>
		<?php if($_SESSION['profile']->flag == 0 || $_SESSION['profile']->flag == 1 || $_SESSION['profile']->flag == 2){ ?>
			<div class="row">
				<a href="<?= base_url('admin/users')?>" >
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red">
						<div class="visual">
							<i class="fa fa-users"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?= $total_user->total; ?>">0</span>
							</div>
							<div class="desc">Total Users</div>
						</div>
					</div>
				</div>
				</a>
				
				<a href="<?= base_url('admin/enquiries')?>" >
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green">
						<div class="visual">
							<i class="fa fa-phone"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?= $total_enquiry->total; ?>">0</span>
							</div>
							<div class="desc">Total Enquiry</div>
						</div>
					</div>
				</div>
				</a>
				
				<a href="<?= base_url('admin/add_foundation')?>" >
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?= $total_foundation->total; ?>">0</span>
							</div>
							<div class="desc">Total Foundation</div>
						</div>
					</div>
				</div>
				</a>
				
				<!--<a href="<?= base_url('admin/interested_user')?>" >
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple">
						<div class="visual">
							<i class="fa fa-globe"></i>
						</div>
						<div class="details">
						<div class="number">
							<span data-counter="counterup" data-value="<?= $total_services->total; ?>"></span>
						</div>
						<div class="desc">Total Services</div>
						</div>
					</div>
				</div>
				</a>
			</div>
		
			<div class="row">
				<a href="<?= base_url('admin/appointment')?>" >
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue">
						<div class="visual">
							<i class="fa fa-Webping-cart"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?= $total_appointment->total; ?>">0</span>
							</div>
							<div class="desc">Total Appointments</div>
						</div>
					</div>
				</div>
				</a>
				
				<a href="<?= base_url('admin/subscribers')?>" >
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?= $total_subscribers->total; ?>">0</span>
							</div>
							<div class="desc">Total Subscribers</div>
						</div>
					</div>
				</div>
				</a>

				<a href="<?= base_url('admin/brands')?>" >
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?= $total_brands->total; ?>">0</span>
							</div>
							<div class="desc">Total Brand</div>
						</div>
					</div>
				</div>
				</a>
				
				<a href="<?= base_url('admin/category')?>" >
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green">
						<div class="visual">
							<i class="fa fa-globe"></i>
						</div>
						<div class="details">
						<div class="number">
							<span data-counter="counterup" data-value="<?= $total_category->total; ?>"></span>
						</div>
						<div class="desc">Total Category</div>
						</div>
					</div>
				</div>
				</a>
			</div> -->
		<br>
		<!--table for pending orders-->
		 
		
<div class="row" >
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="fa fa-home"></i> 
					<span class="caption-subject bold uppercase">About</span>
				</div>
			</div>		
  			
			<div class="content-wrapper">
  				<!-- Content Header (Page header) -->

    			<!-- Main content -->
				<section id="section1" class="content">
     				<div class="row">
	  					<div class="col-md-12 ">
          					<div class="box box-warning">
								<div class="box-body">
									<div id="display_Web">
										<div class="col-md-12" style="padding-top:10px">
											<div class="form-group">
												<div class="col-md-2">
                                   					<label><b>Web logo:</b></label>
                            					</div>
												<div class="col-md-8">
													<img src="<?=base_url();?>assets/images/<?=$Web_data[0]->logo;?>" height="55px" width="92px" class="img-responsive">
												</div>
                            					<div class="col-md-2">
                                 					<button id="btn1" onclick="showdiv1()" type="button" class="btn btn-warning">Edit</button>
                           						</div>
					  						</div>
										</div>
										<!------------------------------------------------ -->	
										<div class="col-md-12" style="padding-top:10px">
											<div class="form-group">
												<div  class="col-md-2">
													<label><b>Web Number:</b></label>
												</div>
												<div class="col-md-3" id="sid1">
								 	 				<label><?php echo $Web_data[0]->website_number; ?></label>
												</div>
							 
												<div  class="col-md-2">
													<label><b>Web Name:</b></label>
												</div>
												
												<div class="col-md-3" id="sn1">
													<label><?php echo $Web_data[0]->website_name; ?></label> 
												</div>
					  						</div>
										</div>
										<!------------------------------------------------ -->				

										<div style="padding-top:10px;" class="col-md-12">
											<div class="form-group">
												<div class="col-md-2">
													<label><b>Owner name:</b></label>
												</div>
												<div class="col-md-3" id="on1">
								 					<label><?php echo $Web_data[0]->owner_name; ?></label>
												</div>
							
												<div  class="col-md-2">
													<label><b>PAN No:</b></label>
												</div>
												<div class="col-md-3" id="gst1">
													<label><?php echo $Web_data[0]->website_pan; ?></label>
												</div> 
											</div>
										</div>
										<!------------------------------------------------ -->
				 
										<div style="padding-top:10px;" class="col-md-12">
											<div class="form-group">
												<div  class="col-md-2">
													<label><b>Mobile No:</b></label>
												</div>
												<div class="col-md-3" id="mn1">
													<label><?php echo $Web_data[0]->website_contact; ?></label>
												</div>
												
												<div  class="col-md-2">
													<label><b>Mobile No:</b>(alternate)</label>
												</div>
												<div class="col-md-3" id="mn1">
													<label><?php if($Web_data[0]->website_contact1!=""){ echo $Web_data[0]->website_contact1; }else{echo "-";}?></label>
												</div>
											</div>
										</div>	
										<!------------------------------------------------ -->

										<div class="col-md-12" style="padding-top:10px">
											<div class="form-group">
												<div  class="col-md-2">
													<label><b>Mail id:</b></label>
												</div>
												<div class="col-md-3" id="mid1">
													<label><?php echo $Web_data[0]->website_email; ?></label>
												</div>
												<div  class="col-md-2">
													<label><b>Mail id:</b>(alternate)</label>
												</div>
												<div class="col-md-3" id="mid1">
													<label><?php if($Web_data[0]->website_email1!=""){ echo $Web_data[0]->website_email1; }else{echo "-";}?></label>
												</div>
											</div>
										</div>
											<!------------------------------------------------ -->
										<div class="col-md-12" style="padding-top:10px">
											<div class="form-group">
												<div  class="col-md-2">
													<label><b>Address:</b></label>
												</div>
												<div class="col-md-3" id="add1">
												<label ><?php echo $Web_data[0]->website_address; ?> </label>     
												</div>
												<div  class="col-md-2">
													<label><b>Address:</b>(alternate)</label>
												</div>
												<div class="col-md-3" id="add1">
												
												<label ><?php if($Web_data[0]->website_address1!=""){echo $Web_data[0]->website_address1; }else{echo "-";}?> </label>
													
												</div>
											</div>
										</div>
										<!------------------------------------------------ -->

										<div class="col-md-12" style="padding-top:10px">
											<div class="form-group">
												<div  class="col-md-2">
													<label><b>Website:</b></label>
												</div>
												<div class="col-md-3" id="vatid1">
												<label ><?php echo $Web_data[0]->website_url; ?></label>      
												</div>
												</div>
											</div>

										<!------------------------------------------------ --> 
										<div class="col-md-12" style="padding-top:10px">
											<div class="form-group">
												<div  class="col-md-2">
													<label><b>Bank:</b></label>
												</div>
												<div class="col-md-3" id="vatid1">
												<label ><?php echo $Web_data[0]->bank_name; ?></label>      
												</div>
												<div  class="col-md-2">
													<label><b>Account Name:</b></label>
												</div>
												<div class="col-md-3" id="terms1">
												<label ><?php echo $Web_data[0]->account_name; ?></label>  
												</div> 
											</div>
										</div>
										<!------------------------------------------------ --> 
						
										<div class="col-md-12" style="padding-top:10px">
											<div class="form-group">
												<div  class="col-md-2">
													<label><b>Account Number:</b></label>
												</div>
												<div class="col-md-3" id="vatid1">
												<label ><?php echo $Web_data[0]->account_number; ?></label>      
												</div>
												<div  class="col-md-2">
													<label><b>IFSC Code:</b></label>
												</div>
												<div class="col-md-3" id="terms1">
												<label ><?php echo $Web_data[0]->ifsc_code; ?></label>     
												</div>
											</div>
										</div>
										<!------------------------------------------------ --> 	
						
										<div class="col-md-12" style="padding-top:10px; margin-bottom: 1%;">
											<div class="form-group">
												<div  class="col-md-2">
													<label><b>Terms & Conditions:</b></label>
												</div>
												<div class="col-md-8" id="terms1">
												<label ><?php echo $Web_data[0]->website_terms_conditions; ?></label>
													
											</div>
										</div>
									</div>
									<!------------------------------------------------ -->
							</div>
						</div>
						<!-------------------------------------------------- -->
						<div class="box-body" id="edit_Web" style="display:none;">
							<form id="Web_form" onsubmit="return add_Web()" autocomplete="off"   method="POST" class="form-horizontal group-border-dashed" action="javascript:void(0);" enctype="multipart/form-data">
								<input type="hidden" class="form-control" value="<?php echo $Web_data[0]->website_id; ?>" name="Web_id" id="Web_id">
									<div class="col-md-12" style="padding-top:10px">
                           				<div class="form-group">
											<div  class="col-md-2">
								 				<label> Web logo(150X60px)</label>
                                			</div>
								
                                			<div class="col-md-3" >
												<img src="<?=base_url();?>assets/images/<?=$Web_data[0]->logo;?>" height="50" width="60" class="img-responsive">
                                      			<input type="file" class="form-control" name="logo" id="logo">
                                			</div>
                                			<div  class="col-md-2">
                                    			<label> Web Number</label>
                                			</div>
                               	 			<div class="col-md-3" >
                                     	 		<input type="text" class="form-control" value="<?php echo $Web_data[0]->Web_number; ?>" name="Web_number" id="Web_number">
                                			</div>
                           	 			</div>
                        			</div>
									<!------------------------------------------------ -->				
					
									<div class="col-md-12" style="padding-top:10px">
										<div class="form-group">
											<div  class="col-md-2">
												<label> Web Name</label>
											</div>
								
											<div class="col-md-3" >
												<input type="text" class="form-control" value="<?php echo $Web_data[0]->Web_name; ?>" name="Web_name" id="Web_name" required>
											</div>
								
											<div class="col-md-2">
												<label>Owner name</label>
											</div>
										
											<div class="col-md-3">
												<input type="text" class="form-control" value="<?php echo $Web_data[0]->owner_name; ?>" name="owner_name" id="owner_name">
											</div>
										</div>
									</div>
									<!------------------------------------------------ -->			
									<div class="col-md-12" style="padding-top:10px">
										<div class="form-group">
											<div  class="col-md-2">
												<label> Mobile No</label>
											</div>
											
											<div class="col-md-3" >
												<input type="text" class="form-control" value="<?php echo $Web_data[0]->Web_contact; ?>" name="Web_contact" id="Web_contact">
											</div>
											<div  class="col-md-2">
												<label> Mobile No(optional)</label>
											</div>
											
											<div class="col-md-3" >
												<input type="text" class="form-control" value="<?php echo $Web_data[0]->Web_contact1; ?>" name="Web_contact1" id="Web_contact1">
											</div>
										</div>
									</div>
									<!------------------------------------------------ -->
									<div class="col-md-12" style="padding-top:10px">	
										<div class="form-group">
											<div  class="col-md-2">
												<label> Mail id</label>
											</div>
											
											<div class="col-md-3" >
												<input type="email" class="form-control" value="<?php echo $Web_data[0]->Web_email; ?>" name="Web_email" id="Web_email">
											</div>
											
											<div  class="col-md-2">
												<label> Mail id(optional)</label>
											</div>
											
											<div class="col-md-3" >
												<input type="email" class="form-control" value="<?php echo $Web_data[0]->Web_email1; ?>" name="Web_email1" id="Web_email1">
											</div>
										</div>
									</div>
									<!------------------------------------------------ -->
									<div class="col-md-12" style="padding-top:10px">
										<div class="form-group">
											<div  class="col-md-2">
												<label>Address:</label>
											</div>
											
											<div class="col-md-3" >
												<textarea class = "form-control" rows="3" name="Web_address" id="Web_address" placeholder = ""><?php echo $Web_data[0]->Web_address; ?></textarea>
											</div>
											
											<div  class="col-md-2">
												<label>Address:(optional)</label>
											</div>
											
											<div class="col-md-3" >
												<textarea class = "form-control" rows="3" name="Web_address1" id="Web_address1" placeholder = ""><?php echo $Web_data[0]->Web_address1; ?></textarea>
											</div>
										</div>
									</div>
									<!------------------------------------------------ -->				
									<div class="col-md-12" style="padding-top:10px">
										<div class="form-group">
											<div  class="col-md-2">
												<label> PAN No</label>
											</div>
										
											<div class="col-md-3" >
												<input type="text" class="form-control"  value="<?php echo $Web_data[0]->Web_pan; ?>" name="Web_pan" id="Web_pan">
											</div>
											
											<div  class="col-md-2">
												<label> VAT No</label>
											</div>
										
											<div class="col-md-3" >
												<input type="text" class="form-control"  value="<?php echo $Web_data[0]->Web_van; ?>" name="Web_van" id="Web_van">
											</div>
										</div>
									</div>
									<!------------------------------------------------ -->
									<div class="col-md-12" style="padding-top:10px">
										<div class="form-group">
											<div  class="col-md-2">
												<label> GST No</label>
											</div>
										
											<div class="col-md-3" >
												<input type="text" class="form-control"  value="<?php echo $Web_data[0]->Web_gstno; ?>" name="Web_gstno" id="Web_gstno">
											</div>
											
											<div  class="col-md-2">
												<label>Website:</label>
											</div>
											
											<div class="col-md-3" >
												<input type="url"  class="form-control" value="<?php echo $Web_data[0]->Web_website; ?>" name="Web_website" id="Web_website" >
											</div>
										</div>
									</div>						
									<!------------------------------------------------ -->
									<div class="col-md-12" style="padding-top:10px">
										<div class="form-group">
											<div  class="col-md-2">
												<label> Bank:</label>
											</div>
										
											<div class="col-md-3" >
												<input type="text" class="form-control"  value="<?php echo $Web_data[0]->bank_name; ?>" name="bank_name" id="bank_name">
											</div>
											
											<div  class="col-md-2">
												<label>Account Name:</label>
											</div>
											
											<div class="col-md-3" >
											
											<input type="text"  class="form-control" value="<?php echo $Web_data[0]->account_name; ?>" name="account_name" id="account_name" >
											</div>
										</div>
									</div>
									<!------------------------------------------------ -->
									<div class="col-md-12" style="padding-top:10px">
										<div class="form-group">
											<div  class="col-md-2">
												<label> Account Number:</label>
											</div>
										
											<div class="col-md-3" >
												<input type="text" class="form-control"  value="<?php echo $Web_data[0]->account_number; ?>" name="account_number" id="account_number">
											</div>
											
											<div  class="col-md-2">
												<label>IFSC Code:</label>
											</div>
											
											<div class="col-md-3" >
											
											<input type="text"  class="form-control" value="<?php echo $Web_data[0]->ifsc_code; ?>" name="ifsc_code" id="ifsc_code" >
											</div>
										</div>
									</div>
									<!------------------------------------------------ -->
									<div class="col-md-12" style="padding-top:10px">
										<div class="form-group">
											<div  class="col-md-2">
												<label>Terms & Conditions:</label>
											</div>
										
											<div class="col-md-8" >
											<textarea class = "form-control" rows="3"  name="Web_terms_conditions" id="Web_terms_conditions" placeholder = ""><?php echo $Web_data[0]->Web_terms_conditions; ?></textarea>
											</div>
										</div>
									</div>
									<!------------------------------------------------ -->
									<div class="col-md-12" align="center">
										<div class="form-group" style="padding-top:20px">
											<div class="col-md-6">
											
											<button id="btn2" style="margin-left:20px;"  type="submit" class="btn btn-primary">Save</button>
											
											<button style="margin-left:20px" onclick="showdiv2()" type="button" class="btn btn-danger">Cancel</button>
											</div>
										</div>
									</div>
									<!-------------------------------------------------- -->			
							</form>
						</div>
			  		</div>
  					</div>
 					</div>
 					</div>
				</section>
			</div>
		</div>
	<!-- END CONTENT BODY -->
	</div>
	<?php }else{ ?>
		<div class="row">
		<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i> <span
						class="caption-subject bold uppercase">Contact Your Admin</span>
				</div>
				<div class="actions">
				 	
				</div>
			</div>
			<div class="portlet-body">
		</div>	
		</div>	
		</div>	
		</div>	
	<?php	} ?>
<!-- END CONTENT -->
 </div>
</div>
</div>


<?php
	$data ['script'] = "dashboard.js";
	$data ['initialize'] = "pageFunctions.init();";
	$this->load->view ( 'admin/_includes/footer', $data );
?> 
<link href="<?php echo assets_path; ?>css/bootstrapValidator.min.css"rel="stylesheet" type="text/css" />   
<script src="<?php echo assets_path;?>js/bootstrapValidator.min.js"></script>
<script>
	var base_url = "<?php echo base_url(); ?>";
	
	$(document).ready(function() 
	{

		$('#Web_form').bootstrapValidator(
		{
			fields: {
				Web_name: 
				{
					validators: 
					{
						notEmpty: 
						{
							message: 'Please Enter Web Name'
						} 
					}
				}, 
			},
			
		}).on('reset', function (event)
		{
			$('#Web_form').data('bootstrapValidator').resetForm();
		});
	
    });
</script>