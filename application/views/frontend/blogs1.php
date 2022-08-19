<?php 
	$this->load->view('frontend/_includes/header');
	$this->load->helper('custom');
	$this->load->library('encrypt');
	//error_reporting(0);
?>

<style>

</style>

	<!-- Title Page -->
	<!--section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?php echo assets_path; ?>images/heading-pages-05.jpg);">
		<h2 class="l-text2 t-center">
			Blog
		</h2>
	</section-->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
		Blogs
		</span>
	</div>

	<!-- content page -->
	<section class="bgwhite p-t-60">
    <!--================End Home Banner Area =================-->
		<!-- Success Error Message display --> 
		<?php if($this->session->flashdata("success_message")!=""){?>
		<div class="Metronic-alerts alert alert-info fade in">
			<button type="button" class="close" data-dismiss="alert"
				aria-hidden="true">x</button>
			<i class="fa-lg fa fa-check"></i>  <?php echo $this->session->flashdata("success_message");?>
		</div>
		<?php }?>
		<?php if($this->session->flashdata("error_message")!=""){?>
		<div
			class="Metronic-alerts alert alert-danger fade in">
			<button type="button" class="close" data-dismiss="alert"
				aria-hidden="true">x</button>
			<i class="fa-lg fa fa-warning"></i>  <?php echo $this->session->flashdata("error_message");?>
		</div>
		<?php }?>
		<?php if(validation_errors()!=""){?>
		<div
			class="Metronic-alerts alert alert-danger fade in">
			<button type="button" class="close" data-dismiss="alert"
				aria-hidden="true">x</button>
			<i class="fa-lg fa fa-warning"></i>  <?php echo validation_errors();?>
		</div>
		<?php }?>
		<?php if( $this->upload->display_errors()!=""){?>
		<div
			class="Metronic-alerts alert alert-danger fade in">
			<button type="button" class="close" data-dismiss="alert"
				aria-hidden="true">x</button>
			<i class="fa-lg fa fa-warning"></i>  <?php echo  $this->upload->display_errors();?>
		</div>
		<?php }?>
		<!-- End Success Error Message display --> 

	<!--================Blog Area =================-->
	
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-9">
					
						<!-- item blog -->
						<?php 
						if(count($blogs) > 0){
						for($i=0;$i<count($blogs);$i++){
						    $blogcomments=$this->db->query("select * from blog_comments WHERE blog_id='".$blogs[$i]->id."' ");
							$blog_comm = $blogcomments->result();
							$blog_comments = count($blog_comm);	
							
							$blog_name1 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $blogs[$i]->title);
							$blog_name = str_replace(" ", "-", $blog_name1);
							echo $encrpt_blog_id = $this->encrypt->encode($blogs[$i]->id);
					    ?>
						<div class="p-r-50 p-r-0-lg">
						<div class="item-blog p-b-80">
							<a href="<?php echo base_url('blog-details1/'.$blog_name.'/'.$encrpt_blog_id); ?>" class="item-blog-img pos-relative dis-block hov-img-zoom">
								<?php if($blogs[$i]->category == 3) { ?>
									<video width="100%" controls autoplay>
									  <source src="<?= upload_path.'blogs/'.$blogs[$i]->image; ?>" type="video/mp4">
									  <source src="<?= upload_path.'blogs/'.$blogs[$i]->image; ?>" type="video/3gp">
									  Your browser does not support the video tag.
									</video>
									<span style="top: 45%;" class="item-blog-date dis-block flex-c-m pos1 size17 bg4 s-text1">
									<?php echo date('j-M,Y',strtotime($blogs[$i]->date)); ?>
									</span>
								<?php }else {?> 
									<img width="100%" src="<?= upload_path.'blogs/'.$blogs[$i]->image; ?>" alt="image"/>
									<span class="item-blog-date dis-block flex-c-m pos1 size17 bg4 s-text1">
									<?php echo date('j-M,Y',strtotime($blogs[$i]->date)); ?>
									</span>
								<?php } ?>
							</a>

							<div class="item-blog-txt p-t-33">
								<h4 class="p-b-11">
									<a href="<?php echo base_url('blog-details1/'.$blog_name.'/'.$encrpt_blog_id); ?>" class="m-text24">
										<?= $blogs[$i]->title;?>
									</a>
								</h4>

								<div class="s-text8 flex-w flex-m p-b-21">
									<span>
										<?= "By ".$blogs[$i]->story_by;?>
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										<?php $catgory= get_blog_cat_name($blogs[$i]->category);echo $catgory;?>
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										<?php echo $blog_comments;?>
									</span>
								</div>

								<p class="p-b-12">
									<?php $summary1 = substr($blogs[$i]->summary, 0, 250); echo $summary1."...";?>
								</p>

								<a href="<?php echo base_url('blog-details1/'.$blog_name.'/'.$encrpt_blog_id); ?>" class="s-text20">
									Continue Reading
									<i class="fa fa-long-arrow-right m-l-8" aria-hidden="true"></i>
								</a>
							</div>
						</div>
						</div>
						<?php } }else{
							echo ' <div class="col-lg-9 blog-post-hr post-section"><h2> Blogs Not Found...</h2></div>';
						} ?>
						
					<!-- Pagination -->
					<div class="pagination flex-m flex-w p-r-50 float-right m-b-20">
					<?php foreach ($links as $link) {?>
					
						<!--<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>-->
						<?php	echo "<li>". $link."</li>";?>
					
					<?php } ?>
					</div>
				 
                </div>
			    
				<div class="col-md-4 col-lg-3 p-b-75">
					<div class="rightbar">
						<!-- Search 
						<div class="pos-relative bo11 of-hidden">
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
						<?php for($i=0;$i<count($blogs2);$i++){
							$blog_name1 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $blogs2[$i]->title);
							$blog_name = str_replace(" ", "-", $blog_name1);
							$encrpt_blog_id = $this->encrypt->encode($blogs2[$i]->id);
						?>
							<li class="flex-w p-b-20">
								<a href="<?php echo base_url('blog-details1/'.$blog_name.'/'.$encrpt_blog_id); ?>" class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
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
									<a href="<?php echo base_url('blog-details1/'.$blog_name.'/'.$encrpt_blog_id); ?>" class="s-text20">
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