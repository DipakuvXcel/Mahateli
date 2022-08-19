<?php 
	$this->load->helper('custom');
?>
	<div class="comments-area col-md-9">
		<h5>My Conversation</h5>
		<hr>
		<?php if($guest_user->expert_id == 0 && count($chat)<=0) { 
			echo 'Please wait admin will assign expert for you soon.';
		}else{
			echo 'Topic - '.$guest_user->message;
			echo '<br>';
			echo 'Assigned Expert - '.get_experts_name($guest_user->expert_id);
			echo '<hr>';
		?>
		<div class="message-box" id="message-box">	
		<div id="previous_conversation1">
		<?php
		for($i=0; $i < count($chat);$i++) { ?>
		<div class="comment-list m-b-20 m-r-20 <?php if($chat[$i]->msg_from == $_SESSION['guest_user']->contact){ echo 'text-right'; } ?>">
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
				</div>
			</div>
		</div>
		<?php } ?>	
		</div>
		</div>
		
		<?php if($guest_user->status_id == 2){ echo 'This topic is closed! You can not send message to expert.'; }else{ ?> 	
		<form class="form-contact send_message" autocomplete="off" method="post" >
		<div class=" p-t-10 p-l-0" >	
			<input type="hidden" id="topic_id" name="topic_id" value="<?= $guest_user->id; ?>" />
			<textarea class="dis-block s-text7 size6 bo12 p-l-18 p-r-18 p-t-13 m-b-20" name="message" id="message" placeholder="Type a message..." required></textarea>
		</div>
		<div class="  p-l-0 p-b-40">		
			<div class="row">		
			<div class="col-md-10" >
			</div>
			<div class="col-md-2" >
				<button type="button"  onclick="send_message();" class="flex-c-m size4 bg44 bo-rad-23 hov1 m-text3 trans-0-4" > Send </button>
			</div> 
			<!--<div class="col-md-6" >
				<button type="reset" class="flex-c-m size2 bg1-overlay bo-rad-23   m-text3 trans-0-4" > Reset </button>
			</div> -->						
			</div> 						
		</div>
		</form>
		<?php } } ?>
	</div>
<script>
$(document).ready(function () {
var messageBody = document.querySelector('#message-box');
messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
});
</script>