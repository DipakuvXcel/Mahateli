<?php 
  $this->load->view('frontend/_includes/header');
  $this->load->helper('custom');
  error_reporting(0);

?>
<link rel="stylesheet" href="<?php echo assets_path; ?>css/home.css" />

  <!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">

				<div class="item-slick1 item3-slick1" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/offer.png);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">							 
						</span>
						<!--<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">							 
						</h2>-->
						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<a href="<?php echo base_url('offers'); ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Get Offers
							</a>
						</div>
					</div>
				</div>	
				
				<div class="item-slick1 item3-slick1" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/offer2.png);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">							 
						</span>
						<!--<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">							 
						</h2>-->
						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<a href="<?php echo base_url('offers'); ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Get Offers
							</a>
						</div>
					</div>
				</div>	
				
				<div class="item-slick1 item3-slick1" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/myFuelB1.png);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">	 
						</span>
						<!--<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">							 
						</h2>-->
						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<a href="<?php echo base_url('products'); ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>	

				<div class="item-slick1 item2-slick1" style="background-image: url(<?php echo assets_path; ?>img/myFuelB6.png);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">	 
						</span>
						<!--<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">	 
						</h2>-->
						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="<?php echo base_url('products'); ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>	
				
				<div class="item-slick1 item1-slick1" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/myFuelB4.png);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn"> 
						</span>
						<!--<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">	 
						</h2>-->
						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<!-- Button -->
							<a href="<?php echo base_url('products'); ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item3-slick1" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/myFuelB5.png);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">	 
						</span>
						<!--<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">	 
						</h2>-->
						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<a href="<?php echo base_url('products'); ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>	
				
				<!--<div class="item-slick1 item3-slick1" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/banner5.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">							 
						</span>
						<!--<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">							 
						</h2>-->
						<!--<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<a href="<?php echo base_url('products'); ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>-->	
				
				<div class="item-slick1 item3-slick1" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/myFuelB3.png);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown"> 
						</span>
						<!--<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">
						</h2>-->
						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<a href="<?php echo base_url('products'); ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>	
				
			</div>
		</div>
		
		<div class="t-center expt-top" style="position: relative;">
			<a href="<?php echo base_url('talk_with_experts'); ?>" class="flex-c-m bo-rad-23 bg44 m-text3 bgwhite hov3 trans-0-4" style="font-weight: 600; padding: 10px 2%; display: inline-flex;" >
			Talk to an Expert
			</a>
		</div>
		
	</section>
	<!-- Banner -->
	
	<!-- New Product -->
	<section class="newproduct bgwhite p-t-45  ">
		<div class="container">
			<div class="sec-title p-b-50">
				<h3 class="m-text5 t-center">
					Featured Products
				</h3>
			</div>

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
					if(count($feat_product)>0)
					{
						//echo count($feat_product);
					for($i=0;$i<count($feat_product);$i++){
						$month=strtotime($feat_product[$i]->added_date);
						$after_month=strtotime("+1 months",strtotime($feat_product[$i]->added_date));
						$date=strtotime(date('Y-m-d'));
					?> 
					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative "><!--<?php if($feat_product[$i]->position==1){ echo "block2-labelsale";}else if($after_month>$date){?>block2-labelnew<?php } ?>"> -->
							<?php 
								 
							$where = array('main_product_id' =>$feat_product[$i]->product_id,'flag'=>0,'status!='=>0);
								$both_together = $this->user_model->get_common('product_both_together', $where,'*',2);
						
								if(count($both_together)>0) 	{ ?>
								<a href="<?php echo base_url('offers'); ?>" class="block2-name dis-block s-text3 p-b-5">
								<span class="persent1" > Offers </span>
								</a>
								<?php } ?><?php 
								if($feat_product[$i]->product_type==1)
									{ ?>
									<img style="width: 27%; position: absolute; right: 0px;"src="<?php echo upload_path.'1stInIndia.png';?>" alt="IMG-PRODUCT">
						
								<?php } ?>
							<a href="<?php echo base_url('product-details/'.$feat_product[$i]->product_id); ?>" class="block2-name dis-block s-text3 p-b-5">
								<img src="<?= upload_path.'product_profile/'.$feat_product[$i]->image; ?>" alt="IMG-PRODUCT">
							</a>	

								<div class="block2-overlay trans-0-4">
								<?php if($this->session->userdata('user_profile') !='')
									{ ?>
									<a href="javascript:void(0);" class="<?php if(in_array($feat_product[$i]->product_id,$whishlistarr)){ echo 'hov-pointer trans-0-4 block2-btn-towishlist'; }else{ echo 'block2-btn-addwishlist hov-pointer trans-0-4'; } ?>">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>
									<?php } ?>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button onclick="add_to_card('<?=$feat_product[$i]->product_id?>','<?=$feat_product[$i]->product_name?>','add','1')" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20 text-center">
								<a href="<?php echo base_url('product-details/'.$feat_product[$i]->product_id); ?>" class="block2-name dis-block s-text3 p-b-5">
									<?=$feat_product[$i]->product_name?> 
								</a>
								<input type="hidden" class="product_id" name="product_id" value="<?= $feat_product[$i]->product_id; ?>" />

								<?php if($feat_product[$i]->offer_price && $feat_product[$i]->offer_price < $feat_product[$i]->price)
									{ ?> 				
									<span class="block2-oldprice m-text7">Rs. <?=$feat_product[$i]->price; ?></span>&nbsp; <span class="block2-newprice m-text8">Rs. <?=$feat_product[$i]->offer_price; ?></span>
								<?php } else{ ?> 
									<span class="block2-newprice m-text8" >Rs. <?=$feat_product[$i]->price; ?> </span> 
								<?php } ?>
								<?php if($feat_product[$i]->offer_price && $feat_product[$i]->offer_price < $feat_product[$i]->price)
									{ 
									$discount_p=$feat_product[$i]->price-$feat_product[$i]->offer_price;
									$sale_price=$feat_product[$i]->price-$discount_p;
									$discount=$discount_p/$feat_product[$i]->price*100;
									?> 
									<span class="persent" > -<?=round($discount)?> % </span>
									<?php } ?>
							</div>
						</div>
					</div>
					<?php } } ?>
	
				</div>
			</div>

		</div>
	</section>

	<!-- Banner2 -->
	<section class="banner2 bg5 p-t-55  ">
		<div class="container">
		<div class="sec-title p-b-30">
				<h3 class="m-text5 t-center">
					Featured Categories
				</h3>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-4 m-l-r-auto p-t-15 p-b-15">
				<h4 class="t-center m-b-20"> Protein </h4>
					<div class="hov-img-zoom pos-relative">
						<img height="210px" src="<?php echo assets_path; ?>img/myFuelH1.png" alt="IMG-BANNER">
						<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15" style="margin-top: 15%;">
							<div class="w-size2 p-t-40" >
								<a href="<?php echo base_url('frontend/products/3'); ?>" style="border-radius: 12px;" class="flex-c-m size2 bg44 bo-rad-23 hov3 m-text3 trans-0-4" >
								LEARN MORE
								</a>
							</div> 
						</div>
					</div>
				</div>

				<div class="col-sm-12 col-md-12 col-lg-4 m-l-r-auto p-t-15 p-b-15" >
				<h4 class="t-center m-b-20"> Strength & Endurance </h4>
					<div class="hov-img-zoom pos-relative">
						<img height="210px" src="<?php echo assets_path; ?>img/myFuelH.png" alt="IMG-BANNER" />
						<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15" style="margin-top: 15%;">
							<div class="w-size2 p-t-40" >
								<a href="<?php echo base_url('frontend/products/4'); ?>" style="border-radius: 12px;" class="flex-c-m size2 bg44 bo-rad-23 hov3 m-text3 trans-0-4" >
								LEARN MORE
								</a>
							</div> 
						</div> 
					</div>
				</div>
				
				<div class="col-sm-12 col-md-12 col-lg-4 m-l-r-auto p-t-15 p-b-15">
				<h4 class="t-center m-b-20"> Health </h4>
					<div class="hov-img-zoom pos-relative">
						<img height="210px" src="<?php echo assets_path; ?>img/myFuelH2.png" alt="IMG-BANNER">
						<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15" style="margin-top: 15%;">
							<div class="w-size2 p-t-40" >
								<a href="<?php echo base_url('frontend/products/5'); ?>" style="border-radius: 12px;" class="flex-c-m size2 bg44 bo-rad-23 hov3 m-text3 trans-0-4" >
								LEARN MORE
								</a>
							</div> 
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	
	<!-- video--> 
	<section class="banner2 bg5 p-t-55 p-b-55">
		<div class="container">
			<div class="sec-title p-b-52">
				<h3 class="m-text5 t-center">
					- Videos -
				</h3>
			</div>
			<div class="row ">
			<div class="col-md-12 ">
			 
			<!--<video class="videoclass"   controls>
			  <source src="<?php echo assets_path; ?>img/sattva15_preview.mp4" type="video/mp4">
			  <source src="mov_bbb.ogg" type="video/ogg">
			  Your browser does not support HTML5 video.
			</video>-->
			
			<div class="wrapper">
			<div class="youtube" data-embed="<?php echo $video_product[0]->video_link;?>">
				<div class="play-button"></div>
			</div>
			</div>
		
			<!--<iframe width="100%" class="videosize" allowfullscreen="" src="https://www.youtube.com/embed/<?php echo $video_product[0]->video_link;?>"> </iframe>-->
 
			</div>
			</div>
		</div>
	</section>
	
	<section class="banner2 bg5 ">
		<div class="container">
		 
			<div class="row">
			<?php 
			if(count($video_product)<4){
				$till = count($video_product);
			}else{
				$till = 4;
			}
			for($i=1;$i<$till;$i++){?>
				<div class="col-lg-2 col-sm-3 col-md-3 hidden-blog"> 
				<div class="wrapper">
				<div class="youtube" data-embed="<?php echo $video_product[$i]->video_link;?>">
					<div class="play-button"></div>
				</div>
				</div>
					<!--<iframe width="175" height="125" allowfullscreen="" src="https://www.youtube.com/embed/<?php echo $video_product[$i]->video_link;?>">
					</iframe>-->
				</div> 
				<?php } ?>
				<div class="col-lg-2 col-md-3 col-sm-3"> 
				<a href="<?php echo base_url('videos'); ?>" style="border-radius: 12px;" class="flex-c-m size2 bg44 bo-rad-23 hov3 m-text3 trans-0-4 btnclass" >
				 MORE VIDEOS
				</a>
				</div> 
				
			</div>
		</div>
	</section>
	<!-- Blog -->
	
	<section class="banner2 bg5 p-t-55  ">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-6 m-l-r-auto p-t-15 p-b-15">
					<div class="hov-img-zoom pos-relative">
						<img class="becomep" src="<?php echo assets_path; ?>img/becomep.png" alt="IMG-PATNER">
					</div>
				</div>

				<div class="col-sm-12 col-md-12 col-lg-6 m-l-r-auto p-t-15 p-b-15 d-sm-block">
					<div class="bgwhite hov-img-zoom pos-relative p-b-20per-ssm"  style="border: 1px solid silver;">
					
					<?php if($this->session->flashdata("success_message")!=""){?>
					<div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fa-lg fa fa-check"></i><?php echo $this->session->flashdata("success_message");?>
					</div>
					<?php }?>
					<?php if($this->session->flashdata("error_message")!=""){?>
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fa-lg fa fa-warning"></i> <?php echo $this->session->flashdata("error_message");?>
					</div>
					<?php }?>
					<?php if(validation_errors()!=""){?>
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fa-lg fa fa-warning"></i><?php echo validation_errors();?>
					</div>
					<?php }?>
					<?php if( $this->upload->display_errors()!=""){?>
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fa-lg fa fa-warning"></i><?php echo  $this->upload->display_errors();?>
					</div>
					<?php }?> 
						  
						<form method="post" action="<?php echo base_url('frontend/save_request')?>">
							<h3 class="text-center p-t-30" style="color:#843b62">BECOME A PATNER</h3>
							<div class="col-md-7 formd p-b-20" >
							<div class="w-size10 text-center">
							<br>
								<div class="form-group">
									<input style="border: 1px solid #989898 !important;" class="form-control" type="text" name="name" id="name" placeholder="Enter Your Name*" value="<?= set_value('name'); ?>"  required />
								</div> 
								<div class="form-group">
									<input style="border: 1px solid #989898 !important;" class="form-control" type="tel" name="contact" id="contact" placeholder="Enter Your Contact Details*" value="<?= set_value('contact'); ?>"  required />
								</div>
								<div class="form-group">
									<input style="border: 1px solid #989898 !important;" class="form-control" type="email" name="email" id="email" placeholder="Enter Your Email-Id*" value="<?= set_value('email'); ?>" required />
								</div>
							</div>

							<div class="w-size2 p-t-30 p-b-20">
								<button class="flex-c-m size2 bg44 bo-rad-23 hov3 m-text3 trans-0-4 btnclass" style="    margin-left: 34%;">
									Submit
								</button>
							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php 
	if(count($blogs) > 0){ ?>
	<section class="banner2 bg5 p-t-55 p-b-55">
		<div class="container">
			<div class="sec-title p-b-52">
				<h3 class="m-text5 t-center">
					- Blog -
				</h3>
			</div>
			<div class="row">
				<?php 
				for($i=0;$i<2;$i++){
					$blogcomments=$this->db->query("select * from blog_comments WHERE blog_id='".$blogs[$i]->id."' ");
					$blog_comm = $blogcomments->result();
					$blog_comments = count($blog_comm);	
				?>
					<div class="col-sm-6 col-md-6 col-lg-6 m-l-r-auto p-t-15 p-b-15">
						<div class="hov-img-zoom pos-relative">
							<img class="blog-height" src="<?php echo upload_path."blogs/".$blogs[$i]->image; ?>" alt="IMG-BLOG">
							<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15">
								<a href="<?php echo base_url('frontend/blog_details/'.$blogs[$i]->id); ?>" > <span class="m-text9 p-t-45 fs-20-sm">
									<?= $blogs[$i]->title;?>
								</span></a>
								<a href="<?php echo base_url('frontend/blog_details/'.$blogs[$i]->id); ?>" class="s-text4 hov2 p-t-20 " style="font-weight: 600;">
									<?php $summary1 = substr($blogs[$i]->summary, 0, 250); echo $summary1."...";?>
								</a>
							</div>
						</div>
					</div>
				<?php }?>
 
			</div>
		</div>
	</section>
	<?php } 
	
	if(count($blogs) > 2){
	?>
	<section class="banner2 bg5 ">
		<div class="container">
			<div class="row">
			<?php
			if(count($blogs)<6){
				$till = count($blogs);
			}else{
				$till = 6;
			}
				for($m=2;$m<$till;$m++){
			?>
				<div class="col-lg-2 col-md-3 col-sm-3 hidden-blog"> 
					<a href="<?php echo base_url('frontend/blog_details/'.$blogs[$m]->id); ?>">
						<img src="<?php echo upload_path."blogs/".$blogs[$m]->image; ?>" style="width: 150px;border: 1px solid;" alt="IMG-BLOG">
					</a>
				</div> 
			<?php } ?> 
				<div class="col-lg-2 col-md-3 col-sm-3"> 
				<button style="border-radius: 12px;" class="flex-c-m size2 bg44 bo-rad-23 hov3 m-text3 trans-0-4 btnclass" style="margin-left: 32%;">
				 MORE BLOG
				</button>
				</div> 
			</div>
		</div>
	</section>
	<?php } ?>
	
	<?php  if(count($testimonial) > 0){ ?>
	<section class="blog bgwhite p-t-94 p-b-65">
		<div class="container">
			<div class="sec-title  ">
				<h3 class="m-text5 t-center">
					- Testimonials -
				</h3>
			</div>

			<div class=" ">
				<div class="col-md-12 col-center m-auto">
			 
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Carousel indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>   
				<!-- Wrapper for carousel items -->
				<div class="carousel-inner">
				<?php for($i=0;$i<count($testimonial);$i++){?>
					<div class="item carousel-item <?php if($i==0){ echo"active";}?>">
						<div class="img-box"><img src="<?php echo upload_path."testimonial/".$testimonial[$i]->image; ?>" alt="IMG-Testimonials"></div>
						<p class="testimonial"><?= $testimonial[$i]->message;?></p>
						<p class="overview"><b><?= $testimonial[$i]->name;?></b>,<br><?= $testimonial[$i]->desgination;?></p>
					</div>
					<!--<div class="item carousel-item">
						<div class="img-box"><img src="<?php echo upload_path."testimonial/".$testimonial[1]->image; ?>" alt=""></div>
						<p class="testimonial"><?= $testimonial[1]->message;?></p>
						<p class="overview"><b><?= $testimonial[1]->name;?></b>,<br><?= $testimonial[$i]->desgination;?></p>
					</div>
					<div class="item carousel-item">
						<div class="img-box"><img src="<?php echo upload_path."testimonial/".$testimonial[2]->image; ?>" alt=""></div>
						<p class="testimonial"><?= $testimonial[2]->message;?></p>
						<p class="overview"><b><?= $testimonial[2]->name;?></b>,<br><?= $testimonial[$i]->desgination;?></p>
					</div>-->
					
				<?php }?>
				</div>
				<!-- Carousel controls -->
				<a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</div> 

		</div>
		</div>
	</section>
	<?php } else { ?>
	<section class="blog bgwhite p-t-94 p-b-65">
	</section>
	<?php } ?>

	
<?php 
	$this->load->view('frontend/_includes/footer');
?>
