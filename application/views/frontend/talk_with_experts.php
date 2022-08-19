
<?php 
	$this->load->view('frontend/_includes/header');
	$this->load->helper('custom');
?>
<style>
.fade {
    opacity: 1;
 
}
.p-b-20 {
    padding-top: 10px;
    padding-bottom: 10px;
    
}
.sale-noti1{
	color:#e65540;
}
</style>   
    <!--================Home Banner Area =================-->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?php echo base_url(''); ?>" class="s-text16"> Home
		<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17"> Talk With Experts </span>
	</div>
	 
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-55">
		<div class="col-md-12">
			<div class="row">
				<div class="col-sm-6 col-md-3 col-lg-3 ">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<?php if($_SESSION['guest_user']){ ?>
						<h4 class="m-text14 p-b-7">
							Previous Topics
						</h4>
	 					<ul class="p-b-54">
						<?php

							if(count($guest_user)>1){
							for($i=0;$i<count($guest_user);$i++){
						?>
							<li class="p-t-4 p-b-20" style="font-size: 18px;">
								<a href="javascript:void(0);" onclick="show_topic(<?= $guest_user[$i]->id; ?>);" id="topic_section<?= $guest_user[$i]->id; ?>" class="list-group-item all_topics <?php if($i==0){ echo 'sale-noti1'; } ?>" style="font-size: 18px;">
								 <i class="fa fa-user-o"></i> <?= substr($guest_user[$i]->message,0,20).'...'; ?>
								 </a>
							</li>
							<?php } } else { ?>	
							<li class="p-t-4 p-b-20" style="font-size: 18px;">
								 
								 <i class="fa fa-ban"></i> No previous topic
								  
							</li>
							<?php } ?>

						</ul>
						<?php } else { ?>	
						<ul class="p-b-54">
							<li class="p-t-4 p-b-20" style="font-size: 18px;">
								<a href="javascript:void(0);" onclick="previous_talked();" id="previous_talked" class="sale-noti1 list-group-item " style="font-size: 18px;">
								 <i class="fa fa-history"></i> Previous Talk
								 </a>
							</li>
							
							<li class="p-t-4 p-b-20 " >
								<a href="javascript:void(0);" onclick="new_talk()" id="new_talk"  class="list-group-item" style="font-size: 18px;">
									<i class="fa fa-plus"></i> Start New Talk
								</a>
							</li>
						</ul>
						<?php } ?>
							
					</div>
				</div>

				<div class="col-sm-6 col-md-9 col-lg-9 ">
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
		
				<?php if($_SESSION['guest_user']){ ?>
					<div class="container">
					<div class="row">
						<div class=" col-lg-12 ">
							<div class="p-r-50 p-r-0-lg">
							<div class="p-b-20">
								<div class="blog-detail-txt">
									<h4>My Details</h4>
									<hr>
									
									<div class="portlet-body">
									<div class="form-body">
									
										<div class="row">
											<div class="col-md-2">
												<div class=" ">
													<label class="control-label"><b>Name : </b></label> 
												</div>
											</div>
											<div class="col-md-4">
												<label class="profile-label"> <?= $guest_user[0]->name; ?>  </label>
											</div>
											<div class="col-md-2">
												<div class=" ">
													<label class="control-label"><b>Mail-Id : </b></label> 
												</div>
											</div>
											<div class="col-md-4">
												<label class="profile-label"> <?= $guest_user[0]->email; ?> </label>
											</div>
											
										</div> 
							
										<div class="row">
											<div class="col-md-2">
												<div class=" ">
													<label class="control-label"><b>Phone : </b></label>
												</div>
											</div>
											<div class="col-md-4">
												<label class="profile-label"><?= $guest_user[0]->contact; ?></label>
											</div>	
										</div>
										
										<div class="row">
											<div class="col-md-2">
												<div class=" ">
													<label class="control-label"><b>Current Topic : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= $guest_user[0]->message ? : 'NA'; ?> </label>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-2">
												<div class=" ">
													<label class="control-label"><b>Assigned Expert : </b></label> 
												</div>
											</div>
											<div class="col-md-5">
												<label class="profile-label"> <?= get_experts_name($guest_user[0]->expert_id) ? : 'NA'; ?> </label>
											</div>
										</div>
										
									</div>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div> 
					</div> 
					<hr> </hr>	
				
					<section class="bgwhite tab-pane" id="previous_conversation">
						<div class="comments-area col-md-11 col-lg-9">
						<h5>My Conversation</h5>
						<hr>
						<?php if($guest_user[0]->expert_id == 0 && count($chat)<=0) { 
							echo 'Please wait admin will assign expert for you soon.';
						}else{
							echo 'Topic - '.$guest_user[0]->message;
							echo '<br>';
							echo 'Assigned Expert - '.get_experts_name($guest_user[0]->expert_id);
							echo '<hr>';
						?>
						<div class="message-box" id="message-box">	
						<div id="previous_conversation1">	
						<?php
							for($i=0; $i < count($chat);$i++) {?>
							<div class="comment-list m-b-20 m-r-20  <?php if($chat[$i]->msg_from == $_SESSION['guest_user']->contact){ echo 'text-right'; } ?>">
								<div class="desc">
								  <p style="color: #2a2a2a; font-weight: 700;" class="comment">
								  <?= $chat[$i]->message?></p>
									<div class="  ">
										<p class="s-text17">
											<?= $chat[$i]->from_name; ?> - 
											<?php 
												$date=date_create($chat[$i]->created_date);
												echo date_format($date, 'j M Y');
												echo ' at ';
												$dateObject = new DateTime($chat[$i]->created_date);
												echo $dateObject->format('h:i A');
											?> 
										</p>
									</div>
								</div>
							</div>
							<?php } ?>	
						</div>
						</div>
						
						<?php if($guest_user[0]->status_id == 2){ echo 'This topic is closed! You can not send message to expert.'; }else{ ?>
							<form class="form-contact send_message" autocomplete="off" method="post" >
							<div class=" p-t-10 p-l-0" >	
								<input type="hidden" id="topic_id" name="topic_id" value="<?= $guest_user[0]->id; ?>" />
								<textarea class="dis-block s-text7 size6 bo12 p-l-18 p-r-18 p-t-13 m-b-20" name="message" id="message" placeholder="Type a message..." required></textarea>
							</div>
							<div class="  p-l-0 p-b-40">		
								<div class="row">		
								<div class="col-md-10" >
								</div>
								<div class="col-md-2" >
									<button type="button" class="flex-c-m size4 bg44 bo-rad-23 hov1 m-text3 trans-0-4"  onclick="send_message();" > Send </button>
								</div> 
								<!--<div class="col-md-6" >
									<button type="reset" class="flex-c-m size2 bg1-overlay bo-rad-23   m-text3 trans-0-4" > Reset </button>
								</div> -->						
								</div> 						
							</div>
							</form>
						<?php } } ?>	
						</div>
					</section>
					
				<?php }else { ?> 
				
					<div class="container">
					<div class="row" id="previous_talked_div">
						<div class="col-md-8 col-lg-12 ">
							<div class="p-r-50 p-r-0-lg">
							<div class="p-b-20">
								<div class="blog-detail-txt">
									<h4>Talk with expert by just enter mobile number and verifying otp</h4>
									<hr>
									
									<div class="portlet-body">
									<div class="form-body">
										<form class="form-contact contact_form"  autocomplete="off"  method="post"  action="<?php echo base_url('frontend/verify_appointment') ?>" >
			  
											<div class="row">
												<div class="col-md-4" >
												</div>												
												<div class="col-md-4 p-b-30 p-t-20" style="margin-bottom: 1rem;">
													<input name="vcontact" id="vcontact" style="border: 1px solid #989898 !important;" class="form-control" type="number" value="<?= set_value('vcontact'); ?>" required placeholder="Enter Your Mobile Number*" >
												</div>
												<!--<div class="col-md-6" style="margin-bottom: 1rem;">
													<input name="email" id="email" style="border: 1px solid #989898 !important;" class="form-control" type="email" required placeholder="E-mail*" >
												</div>-->
												 
											</div>
											
											<div class="row">
												<div class="col-12">
													<div class="text-center">
														<button type="submit" name="submit" class="swal-button swal-button--confirm" style="border-radius: 12px;">Submit</button> 
													</div>
												</div>
											</div>
										</form>
									</div>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
					
					<div class="row" id="new_talk_div" style="display:none;">
						<div class="col-md-8 col-lg-12 ">
							<div class="p-r-50 p-r-0-lg">
							<div class="p-b-20">
								<div class="blog-detail-txt">
									<h4>Talk to an Expert for new Topic</h4>
									<hr>
									
									<div class="portlet-body">
									<div class="form-body">
										<form class="form-contact contact_form"  autocomplete="off"  method="post" id="contactForm" novalidate="novalidate" action="<?php echo base_url('frontend/save_appointment') ?>" onsubmit="return submitcommentform(this);">
			  
											<div class="row">
												<div class="col-md-6" style="margin-bottom: 1rem;">
													<input name="name" id="name" style="border: 1px solid #989898 !important;" class="form-control" type="text" required placeholder="Name*" >
												</div>
												<div class="col-md-6" style="margin-bottom: 1rem;">
													<input name="contact" id="contact" style="border: 1px solid #989898 !important;" class="form-control" type="tel" required placeholder="Contact Number*" >
												</div>
												<div class="col-md-6" style="margin-bottom: 1rem;">
													<input name="email" id="email" style="border: 1px solid #989898 !important;" class="form-control" type="email" required placeholder="E-mail*" >
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
										</form>
									</div>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
					</div>
				<?php } ?>
				 
				</div>

			</div>
		</div>
	</section>
    <!--================End Category Product Area =================-->

<?php 
	$this->load->view('frontend/_includes/footer');
?>

<script>
	$(document).ready(function () {
		var messageBody = document.querySelector('#message-box');
		messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
		//$('#message-box').scrollTop($('#message-box')[0].scrollHeight);
		setInterval(ajaxsend_message,2000);
	});
	
	function send_message(Form){
		var message = $('#message').val();
		var topic_id = $('#topic_id').val();
	  if ((message == "") || (message == "Name*")) {
		  alert("Please enter message.");
		  $('#message').foucs();
		  return false;
	  } else {
		$.ajax({
			url:'<?= base_url("frontend/send_message/"); ?>',
			type:'POST',
			data:{'topic_id':topic_id,'message':message},
			success: function(data)
			{
				$('#previous_conversation').html('');
				$('#previous_conversation').append(data);
			}
		});
	  }
	}

	function ajaxsend_message()
	{
		var topic_id = $('#topic_id').val();
			$.ajax({
				url:'<?= base_url("frontend/ajaxsend_message/"); ?>',
				type:'POST',
				data:{'topic_id':topic_id},
				success: function(data)
				{
					$('#previous_conversation1').html('');
					$('#previous_conversation1').append(data);
				}
			});
	} 
	
	function show_topic(id)
	{
		$(".all_topics").removeClass('sale-noti1');
		$("#topic_section"+id).addClass('sale-noti1');
		$.ajax({
			url:'<?= base_url("frontend/show_topic/"); ?>',
			type:'POST',
			data:{'id':id},
			success: function(data)
			{
				//alert(data);
				$('#previous_conversation').html('');
				$('#previous_conversation').append(data);
			}
		});
	}
	
	function previous_talked()
	{ 
		$("#previous_talked").addClass('sale-noti1');
		$('#previous_talked_div').show();
		$("#new_talk").removeClass('sale-noti1');
		$('#new_talk_div').hide();
	}
	
	function new_talk()
	{ 
		$("#new_talk").addClass('sale-noti1');
		$('#new_talk_div').show();
		$("#previous_talked").removeClass('sale-noti1');
		$('#previous_talked_div').hide();
	}

</script>