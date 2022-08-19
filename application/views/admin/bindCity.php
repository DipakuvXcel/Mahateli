<div class="form-group">
	<label class="control-label">City</label><span style="color:red">*</span>
	
	<select id="city" name="city" class="form-control">
		<option value="">Select</option>
		<?php for($i=0;$i<count($city);$i++){ ?>
		<option value="<?= $city[$i]->id ?>"><?php echo $city[$i]->city_name; ?></option>
		<?php } ?>
	</select>
	
</div>