<?php 
$this->load->view('frontend/_includes/header');
?>

<!-- BEGIN CONTENT -->

	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/myFuelO1.png);">
		<!--<h2 class="l-text2 t-center">
			Videos
		</h2>-->	 
	</section>
	
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
			Videos
		</span>
	</div>
	
	<div class="container">
	<h2 class="m-text5 t-center">
		Videos
	</h2><hr>
	</div>
	
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
			<?php for($i=0;$i<count($video);$i++){ ?>
			<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
				<div class="block2">
					<iframe width="100%" height="280" allowfullscreen="" src="<?= 'https://www.youtube.com/embed/'.$video[$i]->video_link; ?>">
					</iframe>
				</div>
			</div>
			<?php } ?>
			</div>
		</div>
	</section>			
	<!-- END CONTENT -->

<?php
$this->load->view('frontend/_includes/footer');
?>