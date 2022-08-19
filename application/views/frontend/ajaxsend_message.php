<?php 
	$this->load->helper('custom');
?>
 	
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
		
<script>
	$(document).ready(function () {
		var messageBody = document.querySelector('#message-box');
		messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
	});
</script>