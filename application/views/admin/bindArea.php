<div class="form-group">
	<label class="control-label">State</label><span style="color:red">*</span>
	
	<select id="state" name="state" class="form-control">
		<option value="">Select</option>
		<?php for($i=0;$i<count($state);$i++){ ?>
		<option value="<?= $state[$i]->id ?>"><?php echo $state[$i]->state_name; ?></option>
		<?php } ?>
	</select>
	
</div>