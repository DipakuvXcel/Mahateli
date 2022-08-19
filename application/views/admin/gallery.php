<?php $this->load->view('admin/_includes/header');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->

		<h3 class="page-title">Gallery</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="icon-home"></i> <a
					href="<?php echo base_url('admin'); ?>">Home</a> <i
					class="fa fa-angle-right"></i></li>
				<li><span>Gallery</span></li>
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
								class="caption-subject bold uppercase">Gallery</span>
						</div>
						<div class="actions">
							<a href="<?php echo base_url('admin/add_gallery');?>" class="btn btn-transparent green-meadow btn-outline btn-circle btn-sm active">
								Add Gallery </a>
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
		              <?php } echo $insert_id;?> 
						<table
							class="table table-striped table-bordered table-hover table-checkable order-column"
							id="managed_datatable" data-page-length='10'>
							<thead>
								<tr>
									<th>Sr.No.</th>
									<th>Image</th>
									<!--<th>Product No</th>-->
									<th>Image Name</th>
									<!--<th>Description</th>
									<th>Qty</th>
									<th>Min Qty</th>
									<th>Price</th>
									<!--<th>Offer Price</th>-->
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php for($i=0;$i<count($gallery);$i++){ ?>
									<tr class="odd gradeX">
										<td><?= $i+1; ?></td>
										<td>
											<img src="<?= upload_path.'gallery/'.$gallery[$i]->image; ?>" alt="<?= $gallery[$i]->title; ?>" height="60" width="100">
										</td>
										<!--<td><?= $gallery[$i]->product_number ?></td>-->
										<td><?= $gallery[$i]->title; ?></td>
										<!--<td><?= $gallery[$i]->description; ?></td>
										<td><?= $gallery[$i]->quantity; ?></td>
										<td><?= $gallery[$i]->min-quanty; ?></td>
										<td><?= $gallery[$i]->price; ?></td>
										<!--<td><?= $gallery[$i]->offer_price; ?></td>-->
										 
										<td> <?php if($gallery[$i]->status_id == 1) { echo 'Active'; }
											else if($gallery[$i]->status_id == 2) {	echo 'Inactive'; } ?></td>
					                    <td>
					                    	<!--<a href="<?php echo base_url('admin/ebook_details/'.$gallery[$i]->id); ?>" class="btn default btn-xs blue-sharp-stripe"> Details </a>-->
						                    <?php if($gallery[$i]->status_id == 1){ ?>
				                    			<a href="<?= base_url('admin/update_gallery/2/'.$gallery[$i]->id); ?>" class="btn default btn-xs yellow-gold-stripe"
				                    				onclick="if(!confirm('Are you sure to make inactive?')) return false;"> Inactive </a>
												
											<?php }else if($gallery[$i]->status_id == 2){ ?>
												<a href="<?= base_url('admin/update_gallery/1/'.$gallery[$i]->id); ?>" class="btn default btn-xs green-meadow-stripe"
													onclick="if(!confirm('Are you sure to make active?')) return false;"> Active </a>
											<?php } ?>
												<a href="<?php echo base_url('admin/edit_gallery/'.$gallery[$i]->id) ;?>" class="btn default btn-xs purple-stripe">Edit </a>
												<a href="<?php echo base_url('admin/update_gallery/0/'.$gallery[$i]->id) ;?>" class="btn default btn-xs red-soft-stripe" 
													onclick="if(!confirm('Are you sure to delete ? All the images will be deleted permanently.')) return false;">Delete </a>
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