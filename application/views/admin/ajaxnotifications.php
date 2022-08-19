  
<?php 
	error_reporting(0);
//$noticnt=count($notifi);
	if($notifcntall>0)
	{
		if($notifcntall>4)
		{
			$counter=4;
		}else{
			$counter=$notifcntall;
		}
	
		for($i=0;$i<$counter;$i++){ 
			 
	?>
	<li style="padding:8px 5px; <?php if($notifi[$i]->read_status==0){ ?> background: antiquewhite; <?php } ?>" >
		<a style="padding-left: 7px;" href="javascript:void(0);" onclick="view_notifi(<?= $notifi[$i]->id ?>)" > <?php echo $notifi[$i]->subject; ?> </a>
	</li>
	<?php } } else { echo '<li style="padding:8px 5px;background: antiquewhite;text-align:center; "> No Notifications </li>'; } ?>	

<input type="hidden" id="noticnt" value="<?= $notifcnt ?>" />

		





