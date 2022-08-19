
<div class="col-md-12 newpadding-left-zero">
	<label class="checkbox-inline">
		<input type="checkbox" class="chk_unchk_class"  name="chk_all_id" id="chk_all_id" checked="checked" onclick="CheckAllUser()" >Check All
	</label>
</div>
<div class="clearfix"></div>
<div style="height:20px;"></div>
	
	<?php 
	for($i=0;$i<count($user_list);$i++)
	{ if($user_list[$i]->email !='' && $user_list[$i]->email !='0'){ ?>

		<div class="col-md-6 newpadding-left-zero">
			<label class="checkbox-inline">
				<input type="checkbox" class="chk_all_class"  checked="checked" onclick="CheckspecificUser()" name="specific_user_list[]" value="<?php echo $user_list[$i]->email; ?>" ><?php echo $user_list[$i]->email; ?>
			</label>
		</div>
		
	<?php } } ?>
