<?php 
	$this->load->view('frontend/_includes/header');
?>
    <!--================Home Banner Area =================-->
    <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-size: 100% 100%;background-image: url(<?php echo assets_path; ?>img/myFuelO1.png);">
		<!--<h2 class="l-text2 t-center">
			Enquiry
		</h2>-->
	</section>
	
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
			Enquiry
		</span>
	</div>
	
	<div class="container">
	<h2 class="m-text5 t-center">
		Enquiry
	</h2><hr>
	</div>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30">
					<div class="p-r-20 p-r-0-lg">
					<!--<div style="width: 100%"><iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=18.4493974,-73.87083609999999&amp;q=Silver%20point%20building%2C%20Near%20vishwa%20gym%2C%20Katraj%20-%20Kondhwa%20Rd%2C%20Katraj%2C%20Pune%2C%20Maharashtra%20411046+(Vigopa%20Solutions%20Pvt.%20Ltd.)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/coordinates.html">gps coordinates finder</a></iframe></div><br />-->
					<div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Kiran%20Pharmaceutical%2C%20%20Hissa%20No.%203%2F10%2C%20behind%20Hotel%20Laxmi%2C%20Pune-Saswad%20Road%2C%20Uruli-Devachi%2C%20Tal.%20Haveli%2C%20Dist.%20Pune-%20412308&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/"></a></div><style>.mapouter{position:relative;text-align:right;height:100%;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:100%;width:100%;}</style></div>
					
					 
					</div>
					
					<div class="padding-2x block-bordered border-radius">
					<div class="margin-left-70 margin-s-left-0  boxheight">
						<p><span class="text-primary"></span><br>						
						<b>Kiran Pharmaceutical</b><br>
						Sr. No. 133, Milkat No. 2413,
						Hissa No. 3/10, Behind Hotel Laxmi, Pune-Saswad Road,
						Uruli-Devachi, Tal. Haveli,
						Dist. Pune- 412308 (M.S.)				
						</p>   
						<p><b>Mail-Id: </b><a href="mailto:care@myfuel.co.in" > care@myfuel.co.in </a></p>				
						<p><b>Contact: </b><a href="tel:7666935976" > +91 7666935976 </a></p>						
					</div>
					</div>
					 
				</div>

				<div class="col-md-6 p-b-30">
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

					   <form class="leave-comment" method="post" action="<?php echo base_url('frontend/save_enquiry')?>">
						<h4 class="m-text26 p-b-36 p-t-15">
							Send us your Enquiry
						</h4>
						
                        <div class="bo4 of-hidden size15 m-b-20">
                        <select id="subject" name="subject" class="sizefull s-text3 p-l-22 p-r-22" style="border: none !important;" required >
							<option value="">Select</option>
							<option value="user" <?php echo set_select('subject','user'); ?> >user</option>
							<option value="Distributor Enquiries" <?php echo set_select('subject','Distributor Enquiries'); ?> >Distributor Enquiries</option>
							<option value="3rd Party Manufactring" <?php echo set_select('subject','3rd Party Manufactring'); ?> >3rd Party Manufactring</option>
							<!--<option value="WhatsApp" <?php echo set_select('subject','WhatsApp'); ?> >WhatsApp</option>-->
							<option value="Talk to an Expert" <?php echo set_select('subject','Talk to an Expert'); ?> >Talk to an Expert </option>
							</select>
                         </div>
						     
						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text3 p-l-22 p-r-22" type="text" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>" required />
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text3 p-l-22 p-r-22" type="tel" name="contact" maxlength="10" placeholder="Phone Number" value="<?= set_value('contact'); ?>"  required />
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text3 p-l-22 p-r-22" type="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>" required />
						</div>
						
						<textarea class="dis-block s-text3 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message" required ><?= set_value('message'); ?></textarea>

						<div class="w-size25">
							<!-- Button -->
							<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
								Send
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- ================ contact section end ================= -->

    
<?php 
	$this->load->view('frontend/_includes/footer');
?>

