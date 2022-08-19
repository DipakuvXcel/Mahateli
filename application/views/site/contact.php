<?php 
	$this->load->view('site/_includes/header');
?>
<!-- section -->
<div class="section padding_layout_3">
<div class="container p-b-20">
    <div class="row">
    <div class="col-lg-7 col-md-7 col-sm-12 about_feature_img padding_right_0 about_cont_blog">
        <!-- <div class="full text_align_left"> -->
          <h3>Contact Details:</h3>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 adress_cont text_align_left">
              <div class="information_bottom left-side ">
                <div class="icon_bottom"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                <div class="info_cont">
                  <h4>Mr. Ramesh Kapley</h4>
                  <p>Contact No : +91 9423580606</p>
                  <p>Email Id:<a href="mailto:rameshkapley@mahateli.in">rameshkapley@mahateli.in</a></p>
                  <p>Pune (Maharashtra)</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 adress_cont text_align_left">
              <div class="information_bottom left-side ">
                <div class="icon_bottom"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                <div class="info_cont">
                  <h4>Mrs. Pranjali Telrandhe</h4>
                  <p>Contact No : +91 9930026505</p>
                  <p>Email Id:<a href="mailto:pranjali.telrandhe@mahateli.in">pranjali.telrandhe@mahateli.in</a></p>
                  <p>Mumbai (Maharashtra)</p> 
                </div>
              </div>
            </div>
          </div>        
          <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 adress_cont text_align_left">
               <div class="information_bottom left-side ">
                <div class="icon_bottom"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                <div class="info_cont">
                <h4>Purushottam Jaishingkar</h4>
                  <p>Contact No :9822634949</p>
                  <p>Pune(Maharashtra)</p> 
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 adress_cont text_align_left">
              <div class="information_bottom left-side ">
                <div class="icon_bottom"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                <div class="info_cont">
                <h4>Prashant Gulhane</h4>
                  <p>Contact No:9422922251</p>
                  <p>Yavatmal(Maharashtra)</p> 
                </div>
              </div>
              </div>
              </div>
              <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 adress_cont text_align_left">
              <div class="information_bottom left-side ">
                <div class="icon_bottom"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                <div class="info_cont">
                <h4>	Subidh Kapale</h4>
                  <p>Contact No: 9326016570</p>
                  <p>Nagpur(Maharashtra)</p> 
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 adress_cont text_align_left">
              <div class="information_bottom left-side ">
                <div class="icon_bottom"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                <div class="info_cont">
                <h4>Vilas Rajgure </h4>
                  <p>Contact No:9423612069</p>
                  <p>Akola(Maharashtra)</p> 
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 adress_cont text_align_left">
              <div class="information_bottom left-side ">
                <div class="icon_bottom"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                <div class="info_cont">
                <h4>	Parshuram Jadhao</h4>
                  <p>	Contact No:9970005628</p>
                  <p>Pune(Maharashtra)</p> 
                </div>
              </div>
            </div>
            </div>
           
        <!-- </div> -->
      </div>
      <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 about_cont_blog" style="background: #D3E9B6;">
        <div class="full text_align_center">
        <h4>GET IN TOUCH</h4>
              <p style="color:#000;">Thank you for using our services.<br> For any questions on our site, please check out our FAQ's/help section. For queries use the form below. We would be happy to assist you.</p>
              <div class="form_section">
					   <form class="form_contant" method="post" action="<?php echo base_url('site/save_enquiry')?>">
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

                  <fieldset>
                  <div class="row">
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <input class="field_custom" type="text" name="name" placeholder="Your Name" value="<?= set_value('name'); ?>" required />
                    </div>
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input class="field_custom" type="tel" name="contact" maxlength="10" placeholder="Your Phone Number" value="<?= set_value('contact'); ?>"  required />
                    </div>
                    <!-- <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input class="field_custom" type="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>" required />
                    </div> -->
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input class="field_custom" type="email" name="email" placeholder="Your Email Address" value="<?= set_value('email'); ?>" required />
                    </div>
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                   <input class="field_custom" type="text" name="subject" placeholder="Your Subject" value="<?= set_value('subject'); ?>" required />
                    </div>
                    <div class="field col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <textarea class="form-control field_custom" name="message" placeholder="Your Message" required rows="4"><?= set_value('message'); ?></textarea>
                    </div>
                    <div class="center"><button class="btn main_bt">Submit Now</button></div>
                  </div>
                  </fieldset>
                </form>
              </div>
        </div>
    </div>
  </div>
</div>
</div>
<!-- end section -->
<!-- section -->
<div class="section">
  <div class="container">
    <div class="row">
      <!-- <div class="col-md-12">
        <div class="full">
          <div class="contact_us_section">
            <div class="call_icon"> <img src="<?php echo site_path; ?>images/it_service/phone_icon.png" alt="#" /> </div>
            <div class="inner_cont">
              <h2>REQUEST A FREE QUOTE</h2>
              <p>Get answers and advice from people you want it from.</p>
            </div>
            <div class="button_Section_cont"> <a class="btn dark_gray_bt" href="<?php echo base_url('contact-us'); ?>">Contact us</a> </div>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</div>
<!-- end section -->
<!-- Modal -->
<div class="modal fade" id="search_bar" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-8 offset-lg-2 offset-md-2 offset-sm-2 col-xs-10 col-xs-offset-1">
            <div class="navbar-search">
              <form action="#" method="get" id="search-global-form" class="search-global">
                <input type="text" placeholder="Type to search" autocomplete="off" name="s" id="search" value="" class="search-global__input">
                <button class="search-global__btn"><i class="fa fa-search"></i></button>
                <div class="search-global__note">Begin typing your search above and press return to search.</div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Model search bar -->
<?php 
	$this->load->view('site/_includes/footer');
?>