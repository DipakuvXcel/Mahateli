<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">Services</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><span>Services</span></li>
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
								class="caption-subject bold uppercase">Services</span>
						</div>
						
						<div class="actions">
							<a href="<?php echo base_url('admin/add_services');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add Services </a>
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
		              <?php print_r($services); }?>
					 
					  <div class="table-responsive" id="bind_products">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="managed_datatable" data-page-length='10'>
							<thead>
								<tr>
									<th>Sr.No.</th>
									<th>Image</th>
									<!--<th>Product No</th>-->
									<th>Service Name</th>
									<th>Category</th>
									<th>Sub-category</th>
									<th>Description</th>
									<!--<th>Qty</th>
									<th>Min Qty</th>
									<th>Price</th>
									<th>Position</th>
									<!--<th>Offer Price</th>-->
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody >
								<?php for($i=0;$i<count($services);$i++){
									
									if($services[$i]->main_category==1){
										$cat = 'Customized Designing';
									}else{
										$cat = 'Upholstery';
									}
									if($services[$i]->sub_category){									
										$catq = $this->db->query('SELECT * FROM product_category WHERE id='.$services[$i]->sub_category.'');
										$catarr= $catq->result();
										$subcat=$catarr[0]->name;
									}else{
										$subcat = '-';
									}

										
								?>
									<tr class="odd gradeX">
										<td><?= $i+1; ?></td>
										<td>
											<img src="<?= upload_path.'services/'.$services[$i]->image; ?>" alt="<?= $services[$i]->product_name; ?>" height="60" width="100">
										</td>
										<td><?= $services[$i]->name; ?></td>
										<td><?= $cat; ?></td>
										<td><?= $subcat; ?></td>
										<td><?= $services[$i]->description; ?></td>
									 
										<td> <?php if($services[$i]->status_id == 1) { echo 'Active'; }
											else if($services[$i]->status_id == 2) {	echo 'Inactive'; } ?></td>
					                    <td>
					                    	<!--<a href="<?php echo base_url('admin/service_details/'.$services[$i]->id); ?>" class="btn default btn-xs blue-sharp-stripe"> Details </a>-->
						                    <?php if($services[$i]->status_id == 1){ ?>
				                    			<a href="<?= base_url('admin/update_service_status/2/'.$services[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe"
				                    				onclick="if(!confirm('Are you sure to make inactive?')) return false;"> Inactive </a>
												
											<?php }else if($services[$i]->status_id == 2){ ?>
												<a href="<?= base_url('admin/update_service_status/1/'.$services[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe"
													onclick="if(!confirm('Are you sure to make active?')) return false;"> Active </a>
											<?php } ?>
												<a href="<?php echo base_url('admin/edit_service/'.$services[$i]->id) ;?>" class="btn default btn-xs purple-stripe">Edit </a>
												<a href="<?php echo base_url('admin/update_service_status/0/'.$services[$i]->id) ;?>" class="btn default btn-xs red-soft-stripe" 
													onclick="if(!confirm('Are you sure to delete!')) return false;">Delete </a>
										</td>
									</tr>
								<?php } ?>
					        </tbody>
						</table>
						</div>
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
function change_position(position,product_id,sub_category,child_category)
{
	//alert(position);
	//alert(product_id);
	//alert(sub_category);
	var url="<?php echo base_url('admin/change_product_position');?>";
	$.post(url,{"product_id":product_id,"position":position,"sub_category":sub_category,"child_category":child_category},function(res){
		//alert(res);
		if(res){
			//location.reload();
			//$('#bind_products').html('');
			$('#bind_products').html(res);
			alert("Product position changed successfully.");

		}else{
			alert("Product position not change! try again...");
		}
	});

} 
</script> 