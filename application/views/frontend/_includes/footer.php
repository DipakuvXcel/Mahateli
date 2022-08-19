  <!--================ start footer Area  =================-->
	<footer class="bg6 p-t-20 p-b-20 p-l-45 p-r-45">
		<div class="flex-w p-b-25">
			<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					GET STARTED WITH FREE
					CASH BACK REWARDS.
				</h4>
				
				<h5 class="s-text6 s-text6 p-b-10 m-t-15">
					Join MyFuel Newsletter
				</h5>

				<form autocomplete="off" action="<?php echo base_url('frontend/subscribe');?>" method="post" >
					<div class="effect1 w-size9">
						<input class="s-text6 bg6 w-full p-b-5" type="email" name="subemail" placeholder="email@example.com">
						<span class="effect1-line"></span>
					</div>

					<div class="w-size2 p-t-20">
						<button class="flex-c-m size2 bo-rad-23 hov3 m-text3 trans-0-4" style="background-color: #7d7d7d;">
							Submit
						</button>
					</div>
				</form>
			</div>

			<div class="w-size222 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					ACCOUNT
				</h4>

				<ul>
					<?php if($this->session->userdata('user_profile')!=''){ ?>
					<li class="p-b-9">
						<a href="<?php echo base_url('profile');?>" class="s-text6">
							My Account
						</a>
					</li>

					<li class="p-b-9">
						<a href="<?php echo base_url('my-orders');?>" class="s-text6">
							My Orders
						</a>
					</li>
					<?php } ?>
					<li class="p-b-9">
						<a href="<?php echo base_url('cart');?>" class="s-text6">
							My Cart
						</a>
					</li>
 
				</ul>
			</div>

			<div class="w-size222 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					NEED HELP?
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="<?php echo base_url('contact-us'); ?>" class="s-text6">
							Contact Us
						</a>
					</li>

					<!--<li class="p-b-9">
						<a href="<?php echo base_url('help'); ?>" class="s-text6">
							Help
						</a>
					</li>-->

					<li class="p-b-9">
						<a href="<?php echo base_url('sitemap'); ?>" class="s-text6">
							Site Map
						</a>
					</li>
					
					<li class="p-b-9">
						<a href="<?php echo base_url('faq'); ?>" class="s-text6">
							FAQ's
						</a>
					</li>
				</ul>
			</div>
			
			<div class="w-size222 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					ABOUT MyFuel
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="<?php echo base_url('about-us'); ?>" class="s-text6">
							About Us
						</a>
					</li>
					
					<li class="p-b-9">
						<a href="<?php echo base_url('videos'); ?>" class="s-text6">
							Videos
						</a>
					</li>

					<li class="p-b-9">
						<a href="<?php echo base_url('privacy-policy'); ?>" class="s-text6">
							Privacy Policy
						</a>
					</li>

					<li class="p-b-9">
						<a href="<?php echo base_url('terms-conditions'); ?>" class="s-text6">
							Terms & Conditions
						</a>
					</li>

					<!--<li class="p-b-9">
						<a href="#" class="s-text6">
							30 Day Money-Back Guarantee
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text6">
							Price Match Guarantee
						</a>
					</li>-->

				</ul>
			</div>

			<div class="w-size8 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					ACCESSIBILITY
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text6">
							Enable Accessibility
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text6">
							If you are using a screen reader and are having problems using this website, please contact on 9937010802 for assistance.
						</a>
					</li>

					 
				</ul>
			</div>

			
		</div>

		<div class="t-center p-l-15 p-r-15">
			<a target="_blank" href="https://www.facebook.com/My-Fuel-112915380111830/" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
			<a target="_blank" href="https://www.instagram.com/invites/contact/?i=15fpuj31q4i1x&utm_content=a3jej1b" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
			<a target="_blank" href="#" class="fs-18 color1 p-r-20 fa fa-linkedin"></a>
			<!--<a target="_blank" href="#" class="fs-18 color1 p-r-20 fa fa-twitter"></a>-->
			<a target="_blank" href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
					
			<div class="t-center s-text6 p-t-20">
				Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved MyFuel | <i class="fa fa-heart-o" aria-hidden="true"></i> Designed & Developed By <a class=" s-text6" href="http://vigopa.com" target="_blank">Vigopa.com</a>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>


<!--  my View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    	 
	</div>
</div>

<!--  my View Modal2 -->
<div class="modal fade" id="viewModal1" tabindex="-1" role="dialog" aria-labelledby="viewModalTitle1" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    	 
	</div>
</div>



<!-- Book an appointment Talk to an Expert Modal -->
<div class="modal fade" id="interestedModal" tabindex="-1" role="dialog" aria-labelledby="interestedModalTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
			<div class="modal-header" style="height: 53px;">
        		<h5 class="swal-title" id="interestedModalTitle">Talk to an Expert</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
         			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
     			<!--<form class="form-contact contact_form"  autocomplete="off"  method="post" id="contactForm" novalidate="novalidate" action="<?php echo base_url('frontend/save_appointment') ?>" onsubmit="return submitcommentform(this);">
          
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 1rem;">
							<input name="name" id="name" style="border: 1px solid #989898 !important;" class="form-control" type="text" required placeholder="Name*" >
						</div>
						<div class="col-md-12" style="margin-bottom: 1rem;">
							<input name="email" id="email" style="border: 1px solid #989898 !important;" class="form-control" type="email" required placeholder="E-mail*" >
						</div>
						<div class="col-md-12" style="margin-bottom: 1rem;">
							<input name="contact" id="contact" style="border: 1px solid #989898 !important;" class="form-control" type="tel" required placeholder="Contact Number*" >
						</div>
						<div class="col-md-12" style="margin-bottom: 1rem;">
							<div class="form-group">
								<textarea class="form-control w-100" name="message" id="message" cols="30" rows="4" placeholder="Enter Message*" required></textarea>
							</div>
						</div>
				    </div>
					
					<div class="row">
                        <div class="col-12">
              				<div class="text-center">
			 					<button type="submit" name="submit" class="swal-button swal-button--confirm" style="border-radius: 12px;">Submit</button> 
              				</div>
            			</div>
          			</div>
				</form>-->
				<!--div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div-->	
			</div>
  		</div>
	</div>
</div>


<!-- Find a Store Modal -->
<div class="modal fade" id="findStroreModal" tabindex="-1" role="dialog" aria-labelledby="findStroreModalTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
			<div class="modal-header" style="height: 53px;">
        		<h5 class="swal-title" id="findStroreModalTitle"><i class="fa fa-map-marker" aria-hidden="true"></i>  FIND MY STORE</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
         			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body" style="    min-height: 424px;">
     			<form id="interest_form" class="horizontal-form" autocomplete="off" action=""  method="post" onsubmit="return submitinterestform(this);">
          
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 1rem;">
						<div class="input-group"  >
							<input name="inname" style="border: 1px solid #989898 !important;" class="form-control" type="text" required placeholder="Enter Your Zip Code" >
						  <div class="input-group-btn">
							<button class="btn btn-default bg44" type="submit"><i class="fa fa-search" style="color:#fff;"></i></button>
						  </div>
						</div>
						</div>
						</div>
						<hr>
						<div class="row"> 
						<div class="col-md-12" style="margin-bottom: 1rem;">
					 	<span class="s-text10 "> We're sorry, we couldn't find results for your search.</span>
						</div>
				</form>
				<!--div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div-->	
			</div>
  		</div>
	</div>
</div>
</div>



<!-- Success Message Modal -->

<?php if($this->session->flashdata("success_message")!=""){ ?> 
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
			<div class="modal-header" style="padding: 11px;">
        		<h6 class="modal-title" id="successModalTitle" >Success</h6>
        		<!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
         			<span aria-hidden="true">&times;</span>
        		</button-->
      		</div>
			<div class="modal-body">
				<div class="thank-you-pop text-center" style="padding: 7px;">
					<img src="<?= assets_path?>img/success.jpg" style="width: 10%;margin-bottom: 2%;">
					<p><?php echo $this->session->flashdata("success_message");?> </p>
				</div>
				<div class="modal-footer margin-zero allpaddingdiv1" style="padding: 0px;">
					<button type="button" style="font-size: 14px;" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } else if($this->session->flashdata("error_message")!=""){?>
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
			<div class="modal-header" style="padding: 11px;">
        		<h6 class="modal-title" id="successModalTitle" >Error</h6>
        		<!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
         			<span aria-hidden="true">&times;</span>
        		</button-->
      		</div>
			<div class="modal-body">
				<div class="thank-you-pop text-center" style="padding: 7px;">
					<img src="<?= assets_path?>img/failure.jpg" style="width: 10%;margin-bottom: 2%;">
					<p><?php echo $this->session->flashdata("error_message");?> </p>
				</div>
				<div class="modal-footer margin-zero allpaddingdiv1" style="padding: 0px;">
					<button type="button" style="font-size: 14px;"  class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>


<?php } /* else if(validation_errors()!=""){?>
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
			<div class="modal-header">
        		<h5 class="modal-title" id="successModalTitle" >Validation Error</h5>
        		<!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
         			<span aria-hidden="true">&times;</span>
        		</button-->
      		</div>
			<div class="modal-body">
				<div class="thank-you-pop">
					<img src="<?= assets_path?>img/failure.jpg">
					<h4><?php echo validation_errors();?></h4>
				</div>
				<div class="modal-footer margin-zero allpaddingdiv1">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>


<?php } */?>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?php echo assets_path; ?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?php echo assets_path; ?>js/typeahead.min.js"></script>
	<script src="<?php echo assets_path; ?>vendor/animsition/js/animsition.min.js"></script>
	<script src="<?php echo assets_path; ?>vendor/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo assets_path; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--<script src="<?php echo assets_path; ?>vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
		
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>-->
	
	<!--<script type="text/javascript" src="<?php echo assets_path; ?>vendor/daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo assets_path; ?>vendor/daterangepicker/daterangepicker.js"></script>-->
	<script src="<?php echo assets_path; ?>vendor/slick/slick.min.js"></script>
	<script src="<?php echo assets_path; ?>js/slick-custom.min.js"></script>
	<!--<script src="<?php echo assets_path; ?>vendor/countdowntime/countdowntime.js"></script>
	<script src="<?php echo assets_path; ?>vendor/lightbox2/js/lightbox.min.js"></script>-->
	<script src="<?php echo assets_path; ?>vendor/sweetalert/sweetalert.min.js"></script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-149861781-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-149861781-1');
	</script>
	
	<script type="text/javascript">
	
		function add_to_card(product_id,name,flag,quantity){
   
			if(quantity==0){
				var quantity_val=$('#quantity').val();
			}else{
				var quantity_val=quantity;
			}

			var url="<?php echo base_url('frontend/add_to_card'); ?>";
			$.ajax({
			  type: "POST",
			  url: url,
			  data: {"product_id":product_id,"action":flag,"offer_id":0,"quantity":quantity_val},
			  cache: false,
			  success: function(res){
				//alert(res);
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
					$('#checkoutbtn').show();
				}
				else{
					//alert("Failed to add cart.");
					swal(name, "is Failed to add cart!", "error");
				}
			  }
			});
		}
	
		/* $('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		}); */

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			var product_id = $(this).parent().parent().parent().find('.product_id').val();
			
			$(this).on('click', function(){
				//alert(product_id);
				action = 'add';
				swal(nameProduct, "is added to wishlist !", "success");
				var url="<?php echo base_url('frontend/save_wishlist');?>";
					$.post(url,{"product_id":product_id,"action":action},function(res){
					});
			});
		});
		
		$('.block2-btn-towishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			var product_id = $(this).parent().parent().parent().find('.product_id').val();
			
			$(this).on('click', function(){
				//alert(product_id);
				action = 'remove';
				//swal(nameProduct, "is added to wishlist !", "success");
				var url="<?php echo base_url('frontend/save_wishlist');?>";
					$.post(url,{"product_id":product_id,"action":action},function(res){
					});
			});
		});
	</script>
	
	
	<script src="<?php echo assets_path; ?>js/main.min.js"></script>

</body>

</html>

<?php if($this->session->flashdata("success_message")!=""){?>
<script>
$(document).ready(function () {
$('#successModal').modal('show');
});
</script>
<?php } else if($this->session->flashdata("error_message")!=""){?>
<script>
$(document).ready(function () {
$('#successModal').modal('show');
});
</script>
<?php } ?>

<script>
 
	$(document).ready(function () {

	});

	function submitcommentform(Form){

	  if ((Form.name.value == "") || (Form.name.value == "Name*")) {
		  alert("Please enter name.");
		  Form.name.select();
		  return false;
	  } else if ((Form.email.value == "") || (Form.email.value == "Email*")) {
		  alert("Please enter email address.");
		  Form.email.select();
		  return false;
	  } else if ((Form.contact.value == "") || (Form.contact.value == "Contact*")) {
		  alert("Please enter Contact.");
		  Form.contact.select();
		  return false;
	  } else if ((Form.message.value == "") || (Form.message.value == "Message*")) {
		  alert("Please enter Message.");
		  Form.message.select();
		  return false;
	  } else {
		  Form.submit();
	  }
	}

	function viewModal(id){
		$('#product_id').val(id);
	    //var product_id=id;
		var url="<?php echo base_url('frontend/view_product_details'); ?>";
		$.post(url,{"id":id},function(res){
			$("#viewModal").html(res);
			//$("#viewModal").show();
		 });
	}

	function viewModal1(id){
    //alert(id);
		$('#product_id').val(id);
	    var product_id=id;
		var url="<?php echo base_url('frontend/view_product_details1'); ?>";
		$.post(url,{"id":id},function(res){
			$("#viewModal1").html(res);
			//$("#viewModal").show();
		 });
	}
	
	
	// for youtube video load after page load
	( function() {

    var youtube = document.querySelectorAll( ".youtube" );
    
    for (var i = 0; i < youtube.length; i++) {
        
        var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/sddefault.jpg";
        
        var image = new Image();
                image.src = source;
                image.addEventListener( "load", function() {
                    youtube[ i ].appendChild( image );
                }( i ) );
        
                youtube[i].addEventListener( "click", function() {

                    var iframe = document.createElement( "iframe" );

                            iframe.setAttribute( "frameborder", "0" );
                            iframe.setAttribute( "allowfullscreen", "" );
                            iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );

                            this.innerHTML = "";
                            this.appendChild( iframe );
                } );    
		};
    
	} )();

</script>

</body>
</html>