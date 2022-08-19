<?php 
	$this->load->view('frontend/_includes/header');
?>
<style>

.persent{
background: #8e8e8e;
padding: 3px 7px 3px 10px;
z-index: 100;
font-family: Montserrat-Regular;
font-size: 12px;
color: #fff;
font-weight: 600;

justify-content: center;
align-items: center;
width: 50px;
height: 22px;
border-radius: 11px;

top: 12px;
left: 12px;

}
.persent1{
background: #f1a831b8;
z-index: 100;
font-family: Montserrat-Regular;
font-size: 12px;
color: #fff;
font-weight: 600;
display: -webkit-box;
display: -webkit-flex;
display: -moz-box;
display: -ms-flexbox;
display: flex;
justify-content: center;
align-items: center;
width: 50px;
height: 22px;

position: absolute;
top: 12px;
left: 12px;

}

.persent2{
	background: #dc615fb8;
	z-index: 100;
	font-family: Montserrat-Regular;
	font-size: 12px;
	color: #fff;
	font-weight: 600;
	display: -webkit-box;
	display: -webkit-flex;
	display: -moz-box;
	display: -ms-flexbox;
	display: flex;
	justify-content: center;
	align-items: center;
	width: 105px;
	border-radius:5px;
	padding: 0px 0px 0px 4px;
	height: 25px;
	position: absolute;
	top: 0px;
	right: 0px;

}
</style>

	<link rel="stylesheet" type="text/css" href="<?php echo assets_path; ?>vendor/noui/nouislider.min.css">
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
		   <div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
			<a href="<?php echo base_url(''); ?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
			</a>
			<span class="s-text17">
			Products
			</span>
			</div>
	
	
	<?php  $cat_id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;?>
	<?php  $scat_id = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;?>
    <?php  $fev_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;?>
	<?php  $page_no = ($this->uri->segment(5)) ? $this->uri->segment(6) : 0;?>
	 <!--================Category Product Area =================-->
	
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-3 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Categories
						</h4>

						<ul class="p-b-54">
						 <li class="p-t-4 ">
							<a href="<?php echo base_url('frontend/products/0'); ?>" class="s-text13 <?php if($this->uri->segment(3)==0){ echo "active1";} ?>">
							   All 
							</a>
						</li>
						<?php 
					// print_r($category);
					
					for($i=0;$i<count($category);$i++){
						//echo $category[$i]->id;
					?>
							<li class="p-t-4 ">
								<a href="<?php echo base_url('frontend/products/'.$category[$i]->id); ?>" class="s-text13 <?php if($category[$i]->id==$cat_id){ echo "active1";} ?>">
									<?=$category[$i]->name?>
								</a>
							</li>
					<?php } ?>

							 
						</ul>

						<!--  -->
						<h4 class="m-text14 p-b-32">
							Flavour
						</h4>
						 
						<ul class="p-b-54">
						<?php 
					// print_r($flavour);
					
					for($i=0;$i<count($flavour);$i++){
					?>
							<li class="p-t-4">
								<a href="<?php echo base_url('frontend/filter_products/'.$cat_id.'/0/'.$flavour[$i]->id.'/'.$page_no); ?>" class="s-text13  <?php if($flavour[$i]->id==$fev_id){ echo "active1";} ?>">
									<?=$flavour[$i]->name?>
								</a>
							</li>
					<?php } ?>

							 
						</ul>
						 
						
						<!--<div class="filter-price p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-17">
								Price
							</div>

							<div class="wra-filter-bar">
								<div id="filter-bar"></div>
							</div>

							<div class="flex-sb-m flex-w p-t-16">
								<div class="w-size11">
									 
									<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
										Filter
									</button>
								</div>

								<div class="s-text3 p-t-10 p-b-10">
								<input type="text" name="price_low" value="500" id="price_low">
								<input type="text" name="price_high" id="price_high">
									Range: RS <span id="value-lower">500</span> - RS <span id="value-upper">10000</span>
								</div>
							</div>
						</div>-->

						 

						 
					</div>
				</div>

				<div class="col-sm-6 col-md-9 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<!--<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Default Sorting</option>
									<option>Popularity</option>
									<option>Price: low to high</option>
									<option>Price: high to low</option>
								</select>
							</div>

							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Price</option>
									<option>Rs 0.00 - Rs 500.00</option>
									<option>Rs 501.00 - Rs 1000.00</option>
									<option>Rs 1001.00 - Rs 1500.00</option>
									<option>Rs 1501.00 - Rs 2000.00</option>
									<option>Rs 2000.00+</option>

								</select>
							</div>-->
						</div>

						<span class="s-text8 p-t-5 p-b-5">
							 <?=count($product)?> results
						</span>
					</div>

					<!-- Product -->
					<div class="row">
					
					<?php 
					$table = 'tbl_wishlist';
					$where = array('user_id' =>$_SESSION['user_profile']->id);
					$tbl_wishlist = $this->user_model->get_common($table, $where,'*',2);
					$whishlistarr = array();
					foreach($tbl_wishlist as $tbl_wishlist1){
						$product_id = $tbl_wishlist1->product_id;
						array_push($whishlistarr,$product_id);
					}
					if(count($product)>0)
					{
					for($i=0;$i<count($product);$i++){
						$month=strtotime($product[$i]->added_date);
						$after_month=strtotime("+1 months",strtotime($product[$i]->added_date));
						$date=strtotime(date('Y-m-d'));
						
					?> 
					 
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
							
								<div class="block2-img wrap-pic-w of-hidden pos-relative  ">
										<?php $where = array('main_product_id' =>$product[$i]->product_id,'flag'=>0,'status!='=>0);
								$both_together = $this->user_model->get_common('product_both_together', $where,'*',2);
						
								if(count($both_together)>0) 	{ ?>
								<a href="<?php echo base_url('offers'); ?>" class="block2-name dis-block s-text3 p-b-5">
								<span class="persent1" > Offers </span>
								</a>
								<?php } ?>
								<?php 
								if($product[$i]->product_type==1)
									{ ?>
									<img style="width: 27%; position: absolute; right: 0px;"src="<?php echo upload_path.'1stInIndia.png';?>" alt="IMG-PRODUCT">
						
								<?php } ?>
								<a href="<?php echo base_url('product-details/'.$product[$i]->product_id); ?>" class="block2-name dis-block s-text3 p-b-5">
									<img src="<?= upload_path.'product_profile/'.$product[$i]->image; ?>" alt="IMG-PRODUCT">
								</a>
									<div class="block2-overlay trans-0-4">
									<?php if($this->session->userdata('user_profile') !='')
									{ ?>
										<a href="javascript:void(0);" class="<?php if(in_array($product[$i]->product_id,$whishlistarr)){ echo 'hov-pointer trans-0-4 block2-btn-towishlist'; }else{ echo 'block2-btn-addwishlist hov-pointer trans-0-4'; } ?>">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>
									<?php } ?>
										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button onclick="add_to_card('<?=$product[$i]->product_id?>','<?=$product[$i]->product_name?>','add','1')" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>
								

								<div class="block2-txt p-t-20">
									<a href="<?php echo base_url('product-details/'.$product[$i]->product_id); ?>" class="block2-name dis-block s-text3 p-b-5">
										 <?=$product[$i]->product_name?> 
									</a>
									<input type="hidden" class="product_id" name="product_id" value="<?= $product[$i]->product_id; ?>" />

									<?php if($product[$i]->offer_price && $product[$i]->offer_price < $product[$i]->price)
									{ ?> 				
										<span class="block2-oldprice m-text7">Rs. <?=$product[$i]->price; ?></span>&nbsp; <span class="block2-newprice m-text8">Rs. <?=$product[$i]->offer_price; ?></span>
									<?php if($product[$i]->offer_price && $product[$i]->offer_price < $product[$i]->price)
									{ 
									$discount_p=$product[$i]->price-$product[$i]->offer_price;
									$sale_price=$product[$i]->price-$discount_p;
									$discount=$discount_p/$product[$i]->price*100;
									?> 
									<span class="persent" > -<?=round($discount)?> % </span>
									<?php } ?>
									<?php } else{ ?> 
										<span class="block2-newprice m-text8" >Rs. <?=$product[$i]->price; ?> </span> 
									<?php } ?>	
									
									
									
								</div>
							</div>
						</div>
						<?php }?>
						</div>
						<!-- Pagination -->
						<div class="pagination flex-m flex-w p-r-50 float-right">
						<?php foreach ($links as $link) {?>
						
							<!--<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
							<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>-->
							<?php	echo "<li>". $link."</li>";?>
						
						<?php } ?>
						</div>
					<?php   }
						else{ ?>
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								 	<img src="<?= upload_path.'result_not_found.jpg' ?>" alt="IMG-PRODUCT">
						 
							</div>
							</div>
						
					<?php } ?>

			</div>
		</div>
	</section>
    <!--================End Category Product Area =================-->


<script src="<?php echo assets_path; ?>vendor/noui/nouislider.min.js"></script>
	
<script type="text/javascript">
		/*[ No ui ]
	    ===========================================================*/
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 500, 10000 ],
	        connect: true,
	        range: {
	            'min': 500,
	            'max': 10000
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];
		//alert($('#value-upper').val());
	    filterBar.noUiSlider.on('update', function( values, handle ) {
			//alert(Math.round(values[handle]));
			//if($("#price_low").val()<Math.round(values[handle])){
			//$("#price_low").val(Math.round(values[handle]));}
			//$("#price_high").val(Math.round(values[handle]));
	        skipValues[handle].innerHTML = Math.round(values[handle]) ;
	    });
		
	</script>

<?php 
	$this->load->view('frontend/_includes/footer');
?>
  