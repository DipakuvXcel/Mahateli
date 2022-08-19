<?php 
	$this->load->view('frontend/_includes/header');
	$this->load->helper('custom');
	error_reporting(0);
?>

<style>

.single-post-area .navigation-top {
    padding-top: 0px;
    padding-bottom: 10px;
    border-top: none;
}
</style>

    <!-- breadcrumb -->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="index.html" class="s-text16">
			Home 
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<a href="<?php echo base_url('blogs'); ?>" class="s-text16">
			Blogs
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
			<?= $blogs[0]->title;?>
		</span>
	</div>
	
       <?php 
		$blog_id = $blogs[0]->id;
		$blogcomments=$this->db->query("select * from blog_comments WHERE blog_id='$blog_id' AND status_id=1 ");
		$blog_comm = $blogcomments->result();
		$blog_comments = count($blog_comm);	
	   ?>
	<!-- content page -->
	<section class="bgwhite p-t-60 p-b-25">
		<div class="container">
			<div class="row">
			<?php 
			if(count($blogs) > 0){ ?>
				<div class="col-md-8 col-lg-9 p-b-80">
					<div class="p-r-50 p-r-0-lg">
						<div class="p-b-40">
							<div class="blog-detail-img   dis-block hov-img-zoom">
								<?php if($blogs[0]->category == 3) { ?>
									<video width="100%" controls autoplay>
									  <source src="<?= upload_path.'blogs/'.$blogs[0]->image; ?>" type="video/mp4">
									  <source src="<?= upload_path.'blogs/'.$blogs[0]->image; ?>" type="video/3gp">
									  Your browser does not support the video tag.
									</video>
								<?php }else {?> 
									<img width="100%" src="<?= upload_path.'blogs/'.$blogs[0]->image; ?>" alt="image"/>
								<?php } ?>
							</div>

							<div class="blog-detail-txt p-t-33">
								<h4 class="p-b-11 m-text24">
									<?= $blogs[0]->title;?>
								</h4>

								<div class="s-text8 flex-w flex-m p-b-21">
									<span>
										<?= "by ".$blogs[0]->story_by;?>
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										<?php echo date('j-M,Y',strtotime($blogs[0]->date)); ?>
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										<?php $catgory= get_blog_cat_name($blogs[0]->category);echo $catgory;?>
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
									   <?php echo $blog_comments;?>
									</span>
								</div>

								<p class="p-b-25">
								<?php echo $blogs[0]->story;?>
								</p>
							</div>
						</div>
						
						<div class="comments-area">
							<h5><?php echo $blog_comments;?> Comments</h5>
							<hr>

							<?php for($i=0; $i < $blog_comments;$i++) {?>
							<div class="comment-list">
							<div class="single-comment justify-content-between d-flex">
							  <div class="user justify-content-between d-flex">
								  <!--div class="thumb">
									  <img src="<?= assets_path;?>img/blog/c1.png" alt="">
								  </div-->
									<div class="desc">
									  <p class="comment">
									  <?= $blog_comm[$i]->comment?>
									  <div class="d-flex justify-content-between">
										<div class="d-flex align-items-center">
										  <p style="color: #2a2a2a; font-weight: 700;">
											<?= $blog_comm[$i]->name?> - &nbsp; 
										  </p>
										  <p class="date"><?php $date=date_create($blog_comm[$i]->created_date);
											echo date_format($date, 'j F Y'); ?> </p>
										</div>
										 
									  </div>
									  
									</div>
							  </div>
							</div>
							</div>
							<hr>
							<?php } ?>			
						</div>

						<!-- Leave a comment -->
						<form class="leave-comment" action="<?php echo base_url('frontend/save_comment') ?>" id="commentForm" method="POST">
						
							<h4 class="m-text25 p-b-14">
								Leave a Comment
							</h4>

							<p class="s-text8 p-b-40">
								Your email address will not be published. Required fields are marked *
							</p>
							
							<input class="form-control" name="id" id="id" type="hidden" value="<?php echo $blogs[0]->id;?>">

							<textarea class="dis-block s-text7 size18 bo12 p-l-18 p-r-18 p-t-13 m-b-20" name="comment" placeholder="Comment..."><?= set_value('comment'); ?></textarea>

							<div class="bo12 of-hidden size2 m-b-20">
								<input class="sizefull s-text7 p-l-18 p-r-18" type="text" name="name" id="name" value="<?= set_value('name'); ?>" placeholder="Name *">
							</div>

							<div class="bo12 of-hidden size2 m-b-20">
								<input class="sizefull s-text7 p-l-18 p-r-18" name="email" id="email" value="<?= set_value('email'); ?>" type="email" placeholder="Email *">
							</div>

							<div class="bo12 of-hidden size2 m-b-30">
								<input class="sizefull s-text7 p-l-18 p-r-18" type="text" name="website" id="website" value="<?= set_value('website'); ?>" placeholder="Website">
							</div>

							<div class="w-size24">
								<!-- Button -->
								<button type="submit" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
									Post Comment
								</button>
							</div>
						</form>
					</div>
				</div>
				
			<?php }else{
				echo ' <div class="col-lg-9 blog-post-hr post-section"><h2> Blog Not Activate OR Blog Not Published...</h2></div>';
			} ?>

				<div class="col-md-4 col-lg-3 p-b-80">
					<div class="rightbar">
						<!-- Search -->
						<!--<div class="pos-relative bo11 of-hidden">
							<input class="s-text7 size16 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search">

							<button class="flex-c-m size5 ab-r-m color1 color0-hov trans-0-4">
								<i class="fs-13 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>-->

						<!-- Categories -->
						<h4 class="m-text23 p-b-34">
							Categories
						</h4>

						<form id="filter_form" action="<?= base_url('frontend/filter_blogs') ?>" method="post">
						<input type="hidden" name="keyword" id="keyword" value="">
						<input type="hidden" name="category" id="category" value="<?= $category ?>">
						<ul>
						    <li class="p-t-6 p-b-8 bo6"> 
							  <a class="s-text13 p-t-5 p-b-5 <?php if($blogs_cat=='') { echo "active1";  }?>" onclick="filter_story('');" href="javascript:void(0)">All</a> 
							</li>
						<?php for($i=0;$i<count($blogs_cat);$i++){?>
							<li class="p-t-6 p-b-8 bo6">
								<a href="javascript:void(0)" class="s-text13 p-t-5 p-b-5 <?php if($category==$blogs_cat[$i]->id){ echo "active1" ;}?>"  onclick="filter_story('<?= $blogs_cat[$i]->id ?>');">
									<?php echo $blogs_cat[$i]->name;?>
								</a>
							</li>

						<?php }?>
						</ul>
						</form>

						<h4 class="m-text23 p-t-65 p-b-34">
							Recent Blogs
						</h4>
						<ul class="bgwhite">
							<?php for($i=0;$i<count($blogs2);$i++){?>
							<li class="flex-w p-b-20">
								<a href="<?php echo base_url('frontend/blog_details/'.$blogs2[$i]->id); ?>" class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
									<?php if($blogs2[$i]->category == 3) { ?>
										<video width="100%" controls>
										  <source src="<?= upload_path.'blogs/'.$blogs2[$i]->image; ?>" type="video/mp4">
										  <source src="<?= upload_path.'blogs/'.$blogs2[$i]->image; ?>" type="video/3gp">
										  Your browser does not support the video tag.
										</video>
									<?php }else {?> 
										<img src="<?= upload_path.'blogs/'.$blogs2[$i]->image; ?>" alt="image"/>
									<?php } ?>
								</a>

								<div class="w-size23 p-t-5">
									<a href="<?php echo base_url('frontend/blog_details/'.$blogs2[$i]->id); ?>" class="s-text20">
									 <?=$blogs2[$i]->title;?>
									</a>

									<span class="dis-block s-text17 p-t-6">
									 <p><?php $date=date_create($blogs[$i]->date);
											echo date_format($date, 'j F Y'); ?></p>
									</span>
								</div>
							</li>
							<?php }?>
						</ul>

						<!-- Tags -->
						<h4 class="m-text23 p-t-50 p-b-25">
							Tags
						</h4>

						<form id="filter_form" action="<?= base_url('frontend/filter_blogs') ?>" method="post">
							<input type="hidden" name="keyword" id="keyword" value="">
							<input type="hidden" name="category" id="category" value="<?= $category ?>">
							<div class="wrap-tags flex-w">
								<?php for($i=0;$i<count($blog_keywords);$i++){?>
								<a class="tag-item <?php if (in_array($blog_keywords[$i]->keyword, $keyword)){echo 'checked';}else{echo '';}?>" href="javascript:void(0);">
									<label style="margin: 0px;cursor: pointer;padding: 0px;" >
											<input style="position:fixed; z-index:-1;" class="tags" type="checkbox"  value="<?=$blog_keywords[$i]->keyword;?>"  <?php if (in_array($blog_keywords[$i]->keyword, $keyword)){echo 'checked';}else{echo '';}?> ><?php echo $blog_keywords[$i]->keyword;?>
									</label>
								</a>
								<?php } ?>
							</div>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================Blog Area =================-->
<?php 
	$this->load->view('frontend/_includes/footer');
?>

<script>

function filter_story(cat){
		//alert(cat);
		$('#category').val(cat);
        /* var filter = $('#filter').val();
        if(filter != ''){
			$("#keyword").val('');
		}else if(filter == 'all'){
			$("#keyword").val('');
        } */
		$('#filter_form').submit();
    }

    $('.tags').click(function(ele){
		var keyword = new Array();
		$(".tags:checked").each(function(){
			keyword.push($(this).val());
		});
		//alert(keyword);
		$("#keyword").val(keyword);
		$('#filter_form').submit();
    })
	</script>