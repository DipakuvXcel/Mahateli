<?php 	
	$this->load->helper('custom');
?>

	<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    	<div class="modal-content">
			<div class="modal-header">
			<input type="hidden" name="product_id" id="product_id" value=""/>
			
        		<h5 class="modal-title" id="viewModalTitle1"><?php echo $services[0]->name;?></h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
         			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
			  <div class="row">
					<div class="col-md-5">
						<img src="<?= upload_path.'services/'.$services[0]->image; ?>" class="img-responsive" alt="a" width="100%" style="height: 270;">
					</div>

				    <?php
					    // product main category
					
						if($services[0]->main_category==1){
							$cat = 'Customized Designing';
						}else{
							$cat = 'Upholstery';
						}
						//product sub category
					
							$sub_cat=get_cat_name($services[0]->sub_category);
						
			          ?>
					<div class="col-md-7">
						<div class="tabbable"> 
							<ul class="list">
							<ul class="list">
							<li>
							   <span>Category</span> : <b><?php echo $cat;?></b>
								<?php if($sub_cat){?><br>
								<span>Sub Category</span> : <b><?php echo $sub_cat; }?></b>
							</li>
							<hr>
							
						    </ul>
								<li class=""><?php echo $services[0]->description; ?></li>
							</ul>
							<div class="tab-content">
								<div>
									<p>
										
									</p>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<!--<div class="row">
           				<div class="col-12">
              				<div class="text-center">
			 					<button  name="show more" class="main_btn" onclick="single_product()" action="javascript:void(0);"> Show More</button> 
              				</div>
            			</div>
          			</div>-->
				<!--div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div-->	
			</div>
  		</div>
	</div>



	