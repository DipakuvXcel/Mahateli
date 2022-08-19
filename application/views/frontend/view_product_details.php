<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    	<div class="modal-content">
			<div class="modal-header">
			<input type="hidden" name="product_id" id="product_id" value=""/>
			
        		<h5 class="modal-title" id="viewModalTitle"><?php echo $product[0]->product_name;?></h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
         			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
			  <div class="row">
					<div class="col-md-5">
						<img src="<?= upload_path.'product/'.$product[0]->image; ?>" class="img-responsive" alt="a" width="100%" style="height: 270;">
					</div>

				    <?php
					    // product main category
						$table = 'product_category';
						$where = array('status_id !=' => 0,'id'=>$product[0]->main_category);
						$category = $this->user_model->get_common($table, $where,'*',2);
						$cat=$category[0]->name;
						
						//product sub category
						$where = array('status_id !=' => 0,'id'=>$product[0]->sub_category);
						$sub_category = $this->user_model->get_common('product_subcategory', $where,'*',2);
						if(empty($sub_category)){
						 $sub_cat="";
						}else{
							$sub_cat=$sub_category[0]->name;
						}
			          ?>
					<div class="col-md-7">
						<div class="tabbable"> 
							<ul class="list">
							<ul class="list">
							<li>
							   <span>Category</span> : <b><?php echo $cat;?></b>
								<?php if($sub_category){?>&nbsp
								<span>Sub Category</span> : <b><?php echo $sub_cat; }?></b>
							</li>
							<hr>
							
						    </ul>
								<li class=""><?php echo $product[0]->description; ?></li>
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