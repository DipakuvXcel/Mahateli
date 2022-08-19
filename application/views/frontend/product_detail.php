<?php 
	$this->load->view('frontend/_includes/header');
	$this->load->helper('custom');

?>
<link rel="canonical" href="<?php echo base_url('product-details/'.$products->product_id); ?>" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<style>
 
select.form-control:not([size]):not([multiple]) {
    height: calc(2.25rem + 10px);
}
.checked1 {
	color: orange;
}
.nav {
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
    text-align: center;
}
.nav-tabs {
    border-bottom: 1px solid #ddd;
}
.nav {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}
.nav-tabs>li>a {  
    box-shadow: 0px 0px 1px 1px #e4e0e0;
	border:none;  
     border-radius: 0px;
}

.nav-tabs>li{  
	float: left;
    margin-bottom: -1px;
	width:20%;
	background: #e8e8e8;
	position: relative;
    display: block;
}
.nav-tabs>li>a:focus {  
	background: #171717;
    color:#fff;
}
.nav-tabs>li.active>a {  
	background: #171717;
	color:#fff;
}
.fade{
	border: 1px solid #e4e0e0;
	padding: 2%;
}
.tab-content .tab-pane{
	border: 1px solid #e4e0e0;
	padding: 1% 4%;
}
.contents ul li {
    margin: 0px;
    list-style-type: disc;
}
.hov1:hover{
	color: #fff;
}
.plusicon{
	 margin-top: 44px;
	 font-size: 20px;
    font-weight: 600;
	}
	.contents1 {
    font-size: 16px;
}
.p-r-0 {
	padding:0px!important;
}
@media (max-width: 420px) {
	.nav-tabs>li{  
		width:100%;
	}
	.plusicon{
		margin-left: 30%;
		margin-top: 0px;
	}
	.contents1> h4 {
    font-size: 14px;
}
	.contents1 {
    font-size: 12px;
}
}

@media (min-width: 420px and max-width: 1024px) {
	.hex-class {
    width: auto !important;
    
	}
	.contents1> h4 {
    font-size: 14px;
}
	.contents1 {
    font-size: 12px;
}
	 
}
 
/****** Style Star Rating Widget *****/
.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 

 
@media (max-width: 420px) {
.hex-class {
	width: 432px!important;
    margin-left: 9%;
    height: 220px;
}
 
.clipboard{
	   clip-path: polygon(11% 0, 90% 1%, 100% 50%, 88% 100%, 12% 99%, 0 50%);
	   width: 69%;
}
 
}

  .clipboard{
	clip-path: polygon(9% 0, 90% 1%, 100% 49%, 90% 99%, 8% 99%, 0 48%);
	    margin-top: -9%;
    margin-bottom: 4%;
}
.hex-class {
	  width: 500px; 
	    height: 170px;
}
 

.hex1 {
	 background-repeat: no-repeat;
  background-size: auto;
  background-position: center center;  
  background-size: cover;
	clip-path: polygon(19% 0, 79% 0, 100% 46%, 82% 100%, 18% 100%, 0 48%);
   width: 135px;
    height: 110px;
     margin-left: -7%;
 }
 .box {
    position: relative;
    margin-top: 4%;
    -ms-touch-action: none;
    touch-action: none;
}.shadowboard {
    pointer-events: none;
    opacity: 0;
    -webkit-transition: opacity 0.375s;
    transition: opacity 0.375s;
}

.shadowboard, .clipboard {
    position: absolute;
    top: 10px;
    left: 10px;
    right: 10px;
    bottom: 10px;
    background-color: #f1f1f1;
    background-size: cover;
    background-position: center center;
}



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

    <!--================Home Banner Area =================-->
    <!-- breadcrumb -->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="<?php echo base_url('products'); ?>" class="s-text16">
			Products
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			<?= $page_title; ?>
		</span>
	</div>
    <!--================End Home Banner Area =================-->
	
	<div class="container bgwhite p-t-10 p-b-40">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick3">
					 <?php //echo $_SESSION['guest_user_profile']->id."hi--------------";
						$table = 'product_both_together';
						$where = array('main_product_id' =>$products->product_id,'flag'=>0,'status'=>1);
						$both_together = $this->user_model->get_common($table, $where,'*',2);
						//print_r($both_together);
						 
						 
							 
						?>
						<div class="item-slick3" data-thumb="<?php echo upload_path.'product_prof/'.$products->image;?>" data-zoom-image="<?php echo upload_path.'product_prof/'.$products->image;?>">
							<?php 
								if(count($both_together)>0) 
									{ ?>
								<span class="persent1"   > Offers </span>
								<?php } ?>
								<?php 
								if($products->product_type==1)
									{ ?>
								 
									<img style="width: auto; position: absolute; right: 0px;"src="<?php echo upload_path.'1stInIndia.png';?>" alt="IMG-PRODUCT">
						
								<?php } ?>
							
							<div class="wrap-pic-w1">
								<img  id="img"  src="<?php echo upload_path.'product_prof/'.$products->image;?>" alt="IMG-PRODUCT">
							</div>
						</div>
				   <?php 
					$table = 'rating';
					$where = array('product_id' => $products->product_id, 'status' => 1);
					$tbl_rating = $this->user_model->get_common($table, $where,'*',2);

					$rate_sum=$this->db->query("SELECT SUM(rating) AS sum_rating FROM `rating` WHERE `product_id`=$products->product_id AND status=1");			
					$sum_rating1=$rate_sum->result();

					$sum_rating11=$sum_rating1[0]->sum_rating;
					$counttbl_rating=count($tbl_rating);
					$avg_rating=$sum_rating11/$counttbl_rating;
					$avg_rating = round($avg_rating);
					?>
					
					<?php 
					//print_r($product_image);
					for($i=0;$i<count($product_image);$i++){
					?>
						<div class="item-slick3" data-thumb="<?=upload_path.'product/'.$product_image[$i]->image_name;?>" data-zoom-image="<?=upload_path.'product/'.$product_image[$i]->image_name;?>">
							<div class="wrap-pic-w1">
								<img src="<?=upload_path.'product/'.$product_image[$i]->image_name;?>" alt="IMG-PRODUCT">
							</div>
						</div>
						 
					<?php } ?>
						 
					</div>
				</div>
				
				 <?php if($products->stack_with!="") { ?>
				 
				<div class=" wrap-slick3 flex-sb flex-w m-t-60">
				<div class="col-md-11   text-center" style="    box-shadow: 0px 0px 1px 0px;">
						<p><label class=" spline control-label  color0 p-t-10" >You May also Like</label></p>
						<div class="row" >
						<?php
				 
					$stack_with = explode(',', $products->stack_with);
					 					
					  //print_r($stack_with);
					 // echo count($stack_with);
					
					for($i=0;$i<count($stack_with);$i++){
						 
					?>
					<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 ">
						<a href="<?php echo base_url('product-details/'.$stack_with[$i]); ?>" class="block2-name dis-block s-text3 p-b-5">
								
						<div class="wrap-pic-w text-center">
								<img style="margin-left: 0%;max-height: 123px;" id="img"  src="<?php echo upload_path.'product_profile/'.get_product_profile_image($stack_with[$i]);?>" alt="IMG-PRODUCT">
							<?=substr(get_product_name($stack_with[$i]),0,15); ?>
							</div>
							<div class="block2-txt p-t-10 text-center">
									
								
						</div>
						</a>
						</div>
					<?php } ?>	
				</div>
				</div> 
				</div> 
					<?php } ?>	
				
			  
		</div>

			<div class="w-size13 p-t-30 respon5">
				<!--<h5 class="product-detail-name p-b-13">
					<?php echo get_cat_name($products->main_category); ?>
				</h5>-->
				<h3 class="product-detail-name p-b-13 <?php if($products->product_id==1){ echo 'color0';}?>">
				 <?=$products->product_name; ?>
				</h3>
				<?php for($j=0;$j<5;$j++){ ?>
					<span class="fa fa-star <?php if($j<$avg_rating){ echo 'checked1'; } ?>"  ></span>
				<?php } ?>
					<span><a href="#reviewratings" > review(<?= $counttbl_rating ? : 0; ?>)</a></span><br><br>
				<?php if($products->offer_price && $products->offer_price < $products->price)
					{ ?> 				
					<span class="block2-newprice m-text555">Rs. <?=$products->offer_price; ?></span>&nbsp; &nbsp; <span class="block2-oldprice m-text7">Rs. <?=$products->price; ?></span> 
				<?php } else{ ?>  
					<span class="block2-newprice m-text8" >Rs. <?=$products->price; ?> </span> 
				<?php } ?>	
				<?php if($products->offer_price && $products->offer_price < $products->price)
									{ 
									$discount_p=$products->price-$products->offer_price;
									$sale_price=$products->price-$discount_p;
									$discount=$discount_p/$products->price*100;
									?> 
									<span class="persent" > -<?=round($discount)?> % </span>
									<?php } ?>
				<hr>
				<div class="p-l-10 contents">
					<?php echo $products->key_highlights; ?>
				</div>
				<hr>
				 
				<!--<span> <?php echo get_flavour_name($products->flavour); ?> </span>
				<span class="m-text6 "> <?php echo $products->weight; ?> </span> -->
				<div class="row">
				<div class="col-md-12 ">
				<?php
				//echo "-".$products->flavour."-";
				if($products->flavour!=""){  ?>
					<div class="row " >
					<div class="col-md-3 col-xs-5">
						<label class="control-label">Flavour : </label><span style="color:red"> </span>
					</div>
					<div class="col-md-5 col-xs-7">
						<select id="flavour" name="flavour" class="form-control" onchange="change_flavour(this.value)" >
							<?php for($i=0;$i<count($flavour_product);$i++){ ?>
							<option value="<?= $flavour_product[$i]->product_id ?>" <?= set_select("flavour", ".$flavour_product[$i]->flavour.",$products->flavour==$flavour_product[$i]->flavour?true:'');?> > <?php echo get_flavour_name($flavour_product[$i]->flavour); ?> </option>
							<?php } ?>
						</select>
					</div>
					</div>
				<?php }  if($products->weight!=""){  ?> 
					
					<div class="row m-t-10" >
					<div class="col-md-3 col-xs-5">
						<label class="control-label">Weight : </label><span style="color:red"> </span>
					</div>
					<div class="col-md-5 col-xs-7">
						<select id="weight" name="weight" class="form-control" onchange="change_flavour(this.value)">
							<?php for($i=0;$i<count($weight_product);$i++){ ?>
							<option value="<?= $weight_product[$i]->product_id; ?>" <?= set_select("weight", ".$weight_product[$i]->weight.",$products->weight==$weight_product[$i]->weight?true:'');?>><?php echo $weight_product[$i]->weight; ?></option>
							<?php } ?>
						</select>
					</div>
					</div>
					<?php }    ?> 
					<div class="row m-t-10" >
						<div class="col-md-3 col-xs-5">
							<label class="control-label">Servings : </label><span style="color:red"> </span>
						</div>
						<div class="col-md-6 col-xs-7"><?php if($products->servings!=""){  ?> 
						<label class="control-label"><?php echo $products->servings; ?> </label><span style="color:red"> </span>
						<?php } else{ ?>
						 <label class="control-label">NA </label> 
						 <?php }  ?> </div>
					</div>
					
					<div class="row m-t-10" >
						<div class="col-md-3 col-xs-5">
							<label class="control-label">Size : </label><span style="color:red"> </span>
						</div>
						<div class="col-md-6 col-xs-7"><?php if($products->size!=""){  ?> 
						 <label class="control-label"><?php echo $products->size; ?> </label>
						<?php } else{ ?>
						 <label class="control-label">NA </label> 
						<?php }  ?>
						</div>
					</div>
					<hr>
				</div>
				</div>
 
				<div class="row ">
					<div class="col-md-12 p-l-30">
						<div class="  flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color0 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>
								<input class="size8 m-text18 t-center num-product" type="number" name="quantity" id="quantity" min=1 value="1">
								<button class="btn-num-product-up color0 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<button onclick="add_to_card('<?=$products->product_id?>','<?=$products->product_name?>','add','0')" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
									Add to Cart
								</button>
							</div>
							<div id="checkoutbtn" style="display:none;" class="btn-addcart-product-detail  size9 trans-0-4 m-t-10 m-l-15 m-b-10">
								<a style="color:#fff;" href="<?php echo base_url('checkout'); ?>" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
									CHECK OUT
								</a>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<?php 
						$table = 'product_both_together';
						$where = array('main_product_id' =>$products->product_id,'flag'=>1);
						$both_together_free = $this->user_model->get_common($table, $where,'*',2);
						//print_r($both_together_free);
						 if(count($both_together_free)>0){ 
						
						?>
				<div class="row m-t-10" >
					<div class="col-md-12">
						<p><label class="control-label color0" >FREEBIE PRODUCT</label></p>
						<div class="row">
						 <?php 
						 $product_arr1=array($products->product_id);
						 for($i=0;$i<count($both_together_free);$i++){
							  array_push($product_arr1,$both_together_free[$i]->product_id);
						?>
							<div class="col-md-2">
									<span> <img style="width: 100px;" src="<?=upload_path.'product_profile/'.get_product_profile_image($both_together_free[$i]->product_id);?>"> </span>
							 </div>

							<div class="col-md-10 m-t-20">
								<p> <?php echo get_product_name($both_together_free[$i]->product_id);?> </p>
							</div>
						<?php } ?>
						</div>
							<?php 
						$product_ids="";
						//print_r($product_arr1);
						foreach($product_arr1 as $val){ $product_ids=$val.",".$product_ids;}
						 $product_ids1=rtrim($product_ids, ',');
						//echo $product_ids1; ?>
						<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
							<button onclick="add_to_card_mult('<?=$product_ids1?>','<?=$products->product_name?>','add','0')" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Add to Cart
							</button>
						</div>
					</div>
				</div>
				<hr>
				<?php } ?>
				 <?php //echo $_SESSION['guest_user_profile']->id."hi--------------";
						 
						 
						 if(count($both_together)>0){
							 
						?>
				<div class="col-lg-12 m-t-10" >
					
					 
						 <?php 
						 $total_price=0;
						  //print_r($both_together);
						// $product_arr=array($products->product_id);
						 
						 for($i=0;$i<count($both_together);$i++){
							 $total_price+=$both_together[$i]->price;
							    $product_a=$products->product_id.",".$both_together[$i]->product_id;
								$product_arr= explode(",",$product_a);
								if($both_together[$i]->product_id!=""){
									
								if($both_together[$i]->free_product_id!=0){
							    $product_a1=$products->product_id.",".$both_together[$i]->product_id.",".$both_together[$i]->free_product_id;
								}else{
									  $product_a1=$products->product_id.",".$both_together[$i]->product_id;
								array_unshift($product_arr,$both_together[$i]->free_product_id);
								}
								
							   // $product_a1=$products->product_id.",".$both_together[$i]->product_id.",".$both_together[$i]->free_product_id;
								}else{
									if($both_together[$i]->free_product_id!=0){ 
							    $product_a1=$products->product_id.",".$both_together[$i]->free_product_id;
								}else{
									  $product_a1=$products->product_id.",".$both_together[$i]->product_id;
								array_unshift($product_arr,$both_together[$i]->free_product_id);
								}
									
									   
								}
								
								$product_arr=array();
							 
							 $product_arr1= explode(",",$product_a1);
							
							    //print_r($product_arr1);
							   $product_aa= implode(",",$product_arr1);
							  //echo count($product_arr1);
							 ?><div class="row">
							<p><label class="control-label color0" ><?=$both_together[$i]->name?></label></p>
						<br><div class="row">
						
							<?php
							 //array_push($pro_id,$products->product_id); print_r($pro_id);
							 $k=0;
							 foreach($product_arr1 as $val){ 
						?>
						 
							<div class="col-md-3">
								<span> <img style="width: 100px;" src="<?=upload_path.'product_profile/'.get_product_profile_image($val);?>"> </span>
								 <a href="<?php echo base_url('product-details/'.$val); ?>" class="block2-name dis-block s-text3 p-b-5">
								<p> <?php echo substr(get_product_name($val),0,20)?></p>
								</a>
							</div>
 
						 
						<?php if(count($product_arr1)>1 && $k < count($product_arr1)-1 ){  ?>
						<span class="plusicon  m-text8">+</span>
						<?php }  $k++;  }    ?><hr>  
					 
						<span class="plusicon  m-text8">= &nbsp;   </span>
						<?php if($products->offer_price && $products->offer_price < $products->price) { $p_price=$products->offer_price; }else { $p_price=$products->price;} ?>
						<span class="block2-newprice plusicon m-text555">Rs. <?php echo $both_together[$i]->price; //echo $p_price+$total_price; ?></span>
						</div>
						<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
							<button onclick="add_to_card_mult('<?=$product_aa?>','<?=$products->product_name?>','<?=$both_together[$i]->price?>','<?=$both_together[$i]->id?>','<?=$both_together[$i]->free_product_id?>')" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Add to Cart
							</button>
						</div>
					</div><hr><?php   }   ?>
				</div>
				<div class="clearfix clear"></div>
				
				<?php   }   ?>
			 
				

			</div>
		</div>
	 
	<?php if($products->product_id==1){ ?>
  <section class="relateproduct bgwhite   p-b-20" >
		<div class="container" style="margin-right: 2%;">
		<div class="sec-title p-b-30">
				<h3 class="color0 t-center" style="margin-left: -2%;">
					<span class="spline">Who benefits from MyFuel HMB?<span>
				</h3>
			</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div id="box" class="box hex-class"  >
				 <div class="shadowboard"></div>
					<div class="clipboard"  >
					<div class="m-l-100 m-t-40 contents1"  >
					<h4>ACTIVE LIFESTYLES</h4> 
						Those who make activity,
						exercise, and nutrition their
						way of life - who want to feel
						good, look good, and live life
						to the fullest.
					
					</div>
					</div>
					<div class="hex1"  style="background-image: url(<?php echo upload_path.'/benifit1.png'?>); "  ></div>
				 </div>
			 </div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
				<div id="box" class="box hex-class"  >
				 <div class="shadowboard"></div>
					<div class="clipboard"  >
					<div class="m-l-100 m-t-40 contents1"  >
					<h4>Healthy Aging</h4> 
						 Aging adults who want to
						stay active, avoid injury, and
						maintain mobility, physical
						independence, and quality of
						life in later years.
					
					</div>
					</div>
					<div class="hex1"  style="background-image: url(<?php echo upload_path.'/benifit2.png'?>); "  ></div>
				 </div>
				  </div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
				<div id="box" class="box hex-class"  >
				 <div class="shadowboard"></div>
					<div class="clipboard" >
					<div class="m-l-100 m-t-40 contents1"  >
					<h4>Performance driven</h4> 
						Motivated athletes who want
						to train smarter and get a
						competitive edge in power,
						strength, and performance.
					
					</div>
					
					</div>
					<div class="hex1" style="background-image: url(<?php echo upload_path.'/benifit3.png'?>); "   ></div>
				 </div>
				  </div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
				<div id="box" class="box hex-class"  >
				 <div class="shadowboard"></div>
					<div class="clipboard"  >
					<div class="m-l-100 m-t-40 contents1"  >
					<h4>Clinical nutrition And recovery</h4> 
					 Those looking to maintain
					muscle mass, reduce recovery
					time, and improve strength
					following illness, injury, or
					surgery.
					
					</div>
					
					
					</div>
					<div class="hex1"  style="background-image: url(<?php echo upload_path.'/benifit4.png'?>); "  ></div>
				 </div>
				 </div>
	
		</div>
	</div>
	</section>
	<?php } ?>
	
	<div class="container">
		 
		<ul class="nav nav-tabs ">
		  <li class="active"><a data-toggle="tab" href="#menu1">DESCRIPTION</a></li>
		  <li><a data-toggle="tab" href="#menu2">NUTRITION FACTS</a></li>
		  <li><a data-toggle="tab" href="#menu3">BENEFITS</a></li>
		  <li><a data-toggle="tab" href="#menu4">HOW TO USE</a></li>
		  <li><a data-toggle="tab" href="#menu5">STACK WITH</a></li>
		</ul>

		<div class="tab-content">
		  <div id="menu1" class="tab-pane fade in active">
			<h3>Product Description</h3>
			<?php if($products->description_image){ ?>
			<p><img class="img-responsive" src="<?=upload_path.'product/'.$products->description_image;?>" alt="Ingredients"></p> 
			<?php } ?>
			<div class="m-l-15 contents"><?=$products->description ? : 'NA'; ?></div>
		  </div>
		  <div id="menu2" class="tab-pane fade">
			<h3>Nutrition Facts </h3>
			<?php if($products->ingredients_image){ ?>
			<p><img class="img-responsive" src="<?=upload_path.'product/'.$products->ingredients_image;?>" alt="Ingredients"></p> 
			<?php }else{ echo 'NA'; }?>
		  </div>
		  <div id="menu3" class="tab-pane fade">
			<h3>Product Benefits</h3>
			<?php if($products->benefits_image){ ?>
			<p><img class="img-responsive" src="<?=upload_path.'product/'.$products->benefits_image;?>" alt="Ingredients"></p> 
			<?php } ?>
			<div class="m-l-15 contents"><?=$products->benefits ? : 'NA'; ?></div>
		  </div>
		  <div id="menu4" class="tab-pane fade">
			<h3>How To Use</h3>
			<?php if($products->how_to_use_image){ ?>
			<p><img class="img-responsive" src="<?=upload_path.'product/'.$products->how_to_use_image;?>" alt="Ingredients"></p> 
			<?php } ?>
			<div class="m-l-15 contents"><?=$products->how_to_use ? : 'NA'; ?></div>
		  </div>
		  <div id="menu5" class="tab-pane fade">
			<h3>Stack With</h3>
			
			<div class="m-l-15 contents">
			<?php if($products->stack_with!="") {?>
			<ul>
			<?php 
				$stack_with = explode(',', $products->stack_with);
				  for($i=0;$i<count($stack_with);$i++){ ?> 
				  <li><a target="_blank" href="<?php echo base_url('product-details/'.$stack_with[$i]); ?>" class="block2-name dis-block s-text3 p-b-5">
				 <?=get_product_name($stack_with[$i]); ?>
				 </a></li>
				<?php } ?></ul><?php }else echo 'NA'; ?>
			</div>
		  </div>
		</div>
		
	</div>
  
	<section class="relateproduct bgwhite p-t-40 p-b-10" id="reviewratings">
		<div class="container">
			<div class="sec-title p-b-30">
				<h3 class="color0 t-center">
					<span class="spline">Rating and Reviews<span>
				</h3>
			</div>
			<?php if(count($tbl_rating) > 0){ ?> 
			<div class="  p-r-20  p-t-20 p-b-20" style="min-height: 180px;overflow: auto;box-shadow: 0px 0px 3px 0px #a9a7a7;">
				<div class="col-md-4 col-lg-4 col-sm-3 col-xs-12">
					<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
						<h3 class="text-center"><?=$avg_rating?></h3> 
						<span>Ratings out of 5</span>
					</div> 
					<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
						<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
							<?php for($j=0;$j<5;$j++){ ?>
								<span class="fa fa-star <?php if($j<$avg_rating){ echo 'checked1'; } ?>" style="font-size: 24px;" ></span>
							<?php } ?>
						</div>
						<br>
						<br>
						<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
							<div class="progress">
								<div class="progress-bar <?php if($avg_rating==5) { echo 'w-100';} else if($avg_rating==4){ echo 'w-75';} else if($avg_rating==3){ echo 'w-50';}else if($avg_rating==2){ echo 'w-25';}else if($avg_rating==1){ echo 'w-25';}else{ echo 'w-0';}?>" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						</div>

						<input type="button" onclick="view_model()" class="btn hov1" value="RATE THIS PRODUCT">
					</div>
				</div>
			 
				<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 " style="border-left: 1px solid #d0cece;max-height: 650px;overflow: auto;">
					<?php
					for($i=0;$i<count($tbl_rating);$i++){
					?>
					<ul id="reviews_items " class="box p-l-20">
						<li>
							<div>
							<div class="name color0"><?=$tbl_rating[$i]->name?></div>
							<div class="rating">
							<?php for($j=0;$j<5;$j++){ ?>
								<span class="fa fa-star <?php if($j<$tbl_rating[$i]->rating){ echo 'checked1'; } ?>"  ></span>
							<?php } ?>
							 
							</div>
							<br>
							<div class="description"><?=$tbl_rating[$i]->description?></div>
							<div class="description"><span></span>
							</div>
							</div>
						</li>
					</ul>
					<hr>
					<?php } ?>
				</div>
			</div>
			<?php } else { ?>
				<div class="  p-t-20 p-b-20 text-center" style="box-shadow: 0px 0px 2px 0px #a9a7a7;">
					<p> No Reviews & Ratings </p>
					<input type="button" onclick="view_model()" class="btn hov1" value="RATE THIS PRODUCT">
				</div>
			<?php } ?>
		</div>
	</section>
		  
	<!-- Relate Product -->	  
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="sec-title p-b-60">
				 
				<h3 class="color0   t-center">
					<span class="spline">Related Products<span>
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					<?php 
					$table = 'tbl_wishlist';
					$where = array('user_id' =>$_SESSION['user_profile']->id);
					$tbl_wishlist = $this->user_model->get_common($table, $where,'*',2);
					$whishlistarr = array();
					foreach($tbl_wishlist as $tbl_wishlist1){
						$product_id = $tbl_wishlist1->product_id;
						array_push($whishlistarr,$product_id);
					}
					for($i=0;$i<count($rel_product);$i++){
						$month=strtotime($rel_product[$i]->added_date);
						$after_month=strtotime("+1 months",strtotime($rel_product[$i]->added_date));
						$date=strtotime(date('Y-m-d'));
						
					?>
					<div class="item-slick2 p-l-15 p-r-15">
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative ">
								<?php 
								 
							$where = array('main_product_id' =>$rel_product[$i]->product_id,'flag'=>0,'status'=>1);
						$both_together = $this->user_model->get_common('product_both_together', $where,'*',2);
						
								if(count($both_together)>0) 	{ ?>
								<span class="persent1" > Offers </span>
								<?php } ?>
								<?php 
								if($rel_product[$i]->product_type==1)
									{ ?>
									<img style="width: 27%; position: absolute; right: 0px;"src="<?php echo upload_path.'1stInIndia.png';?>" alt="IMG-PRODUCT">
						
								<?php } ?>
								<a href="<?php echo base_url('product-details/'.$rel_product[$i]->product_id); ?>" class="block2-name dis-block s-text3 p-b-5">
								
								<img src="<?php echo upload_path.'product_profile/'.$rel_product[$i]->image;?>" alt="IMG-PRODUCT">
								</a>
								<div class="block2-overlay trans-0-4">
								<?php if($this->session->userdata('user_profile') !='')
									{ ?>
									<a href="javascript:void(0);" class="<?php if(in_array($rel_product[$i]->product_id,$whishlistarr)){ echo 'hov-pointer trans-0-4 block2-btn-towishlist'; }else{ echo 'block2-btn-addwishlist hov-pointer trans-0-4'; } ?>">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>
								<?php } ?>	

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<button onclick="add_to_card('<?=$rel_product[$i]->product_id?>','<?=$rel_product[$i]->product_name?>','add','0')" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20 text-center">
								<a href="<?php echo base_url('product-details/'.$rel_product[$i]->product_id); ?>" class="block2-name dis-block s-text3 p-b-5">
									<?=$rel_product[$i]->product_name; ?>
								</a>
								<input type="hidden" class="product_id" name="product_id" value="<?= $rel_product[$i]->product_id; ?>" />

								<?php if($rel_product[$i]->offer_price && $rel_product[$i]->offer_price < $rel_product[$i]->price)
									{ ?> 				
										<span class="block2-oldprice m-text7">Rs. <?=$rel_product[$i]->price; ?></span>&nbsp; <span class="block2-newprice m-text8">Rs. <?=$product[$i]->offer_price; ?></span>
									<?php if($rel_product[$i]->offer_price && $rel_product[$i]->offer_price < $rel_product[$i]->price)
									{ 
									$discount_p=$rel_product[$i]->price-$rel_product[$i]->offer_price;
									$sale_price=$rel_product[$i]->price-$discount_p;
									$discount=$discount_p/$rel_product[$i]->price*100;
									?> 
									<span class="persent" > -<?=round($discount)?> % </span>
									<?php } ?>
									<?php } else{ ?> 
										<span class="block2-newprice m-text8" >Rs. <?=$rel_product[$i]->price; ?> </span> 
									<?php } ?>	
							</div>
						</div>
					</div>
					<?php } ?>
 
				</div>
			</div>

		</div>
	</section>
</div>
	<!-- Modal -->
	<div class="modal " id="viewModal1" role="dialog" style="top:10%;z-index: 11111;">
		<div class="modal-dialog modal-md">
		<!-- Modal content-->
		<div class="modal-content">
        <div class="modal-header bg44 m-text3">
			<h4 class="modal-title">WRITE REVIEW</h4>
			<button style="color:#fff;margin-left: 50%; " type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
		<div class="modal-body" id="view_order_details">
			<form onsubmit="return save_rating()"  autocomplete="off" action="javascript:void(0);" method="post" id="save_rating_form" >
				<div class="col-md-12" >							 
					<div class="form-group">
						<label class="control-label">Name</label><span style="color:red"> *</span>
						<input   class="form-control" type="hidden" name="product_id" id="product_id" value="<?=$products->product_id?>"  required />
						<input style="border: 1px solid #d0cece !important;" class="form-control" type="text" name="name" id="name" placeholder="Name "   required />
					</div> 
				</div>
				<div class="col-md-12" >			
					<div class="form-group">
						<label class="control-label">Email Id </label> 
						<input style="border: 1px solid #d0cece !important;" class="form-control" type="email" name="email" id="email" placeholder="Email "    required />
					</div>
				</div>
				<div class="col-md-12" >			
					<div class="form-group">
						<label class="control-label">Contact</label><span style="color:red"> *</span>
						<input style="border: 1px solid #d0cece !important;" class="form-control" type="number" name="contact" id="contact" placeholder="Email "    required />
					</div>
				</div>
				<div class="col-md-12" >	
					<div class="form-group">
						<label class="control-label">Description</label>
						<textarea style="border: 1px solid #d0cece !important;" class="form-control"   name="description" id="description" placeholder="Description "   /></textarea>
					</div>
				</div>
				<div class="col-md-12" >	
					<div class="form-group">
						<label class="control-label">Rating</label><br>
						<fieldset class="rating">
							<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
						</fieldset>
					</div>
				</div>
				<br>
				<div class="row" >
					<div class="col-md-12  " >
						<button type="submit" style="width: 30%; float: right;  height: 40px;" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" >SUBMIT</button>
					</div>
				</div>
			</form>
		</div>
		</div>
		</div>
	</div>

<?php 
	$this->load->view('frontend/_includes/footer');
?>
<script type="text/javascript" src="<?php echo assets_path; ?>/js/jquery.ez-plus.js"></script>

<script type="text/javascript">
 
$("#img").hover(function() {
	 
    $("#img").ezPlus();
});
    
   $('.slick3-dots').click(function() {
	    
	    $(".slick-active").ezPlus();
   });
    
	
	function view_model()
	{
	  $('#viewModal1').modal();
	}
     
	function save_rating()
	{ 	 
	    var myform = document.getElementById("save_rating_form");
		var fd = new FormData(myform);
		$.ajax({
		  url: "<?php echo base_url('frontend/save_rating');?>",
		  type: "POST",
		  data: fd,
		  cache: false,
		  processData: false,  // tell jQuery not to process the data
		  contentType: false,   // tell jQuery not to set contentType
			success: function (data) {
				//alert(data);
				if(data==1){
					$('#viewModal1').modal('hide');
			 	  swal("Success", "Review & Rating Submitted Successfully..", "success");
				 /* setTimeout(function(){ 
					location.reload();
				  }, 2000); */
				}else if(data==2){
			 	  swal("Error", "Incorrect details", "error");	 
				}else{
					$('#display_div').html('');
					$('#display_div').append(data);
				}
			}
		});  
	}
	
	
	function add_to_card_mult(product_id,name,price,offer_id,free_product_id){
	 //alert(free_product_id);
	 //alert(product_id);
			 
				//var quantity_val=$('#quantity').val();
			 
		var url="<?php echo base_url('frontend/add_to_card_mult'); ?>";
			$.ajax({
			  type: "POST",
			  url: url,
			  data: {"product_id":product_id,"action":'add',"price":price,"quantity":1,"offer_id":offer_id,"free_product_id":free_product_id},
			  cache: false,
			  success: function(res){
				 // alert(res);
				if(res==1){
					//alert('Quantity not available!');
					 swal(name, "Quantity not available!", "error");
				}
				else if(res){
					swal(name, "is added to cart !", "success");
					$('#head_cart_refresh').html('');
					$('#head_cart_refresh').html(res);
					$('#head_cart_refresh_mob').html('');
					$('#head_cart_refresh_mob').html(res);
					var cnt = $('#hidden_cart_cnt').val();
					$('#head_cart_cnt').html('');
					$('#head_cart_cnt').html(cnt);
					$('#head_cart_cnt_mob').html('');
					$('#head_cart_cnt_mob').html(cnt);
				}
				else{
					//alert("Failed to add cart.");
					swal(name, "is Failed to add cart!", "error");
				}
			  }
			});
		 
		}
	 

</script>

<script>
	function change_flavour(id){
		window.location.href="<?php echo base_url('product-details/'); ?>"+id;
	}
</script>