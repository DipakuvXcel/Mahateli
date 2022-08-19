<?php 
	$this->load->helper('custom');
?>
<style>
	label span{
		font-weight: 600;
	}
</style>
<div class="row">
 		<?php 
		 	$relation_i=$order[0]->relation_id;
			 $relation1=$this->db->query("SELECT * FROM `family_relation` WHERE `id`=$relation_i");			
			 $relation=$relation1->row();

			 $marsta=$order[0]->marital_status;
			 $marstatuus=$this->db->query("SELECT * FROM `marital_status` WHERE `id`=$marsta");			
			 $mastatus=$marstatuus->row();
			
			 ?>
	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 m-b-20 m-l-20 m-r-20" style=" padding: 20px; box-shadow: 0px 0px 4px #969191;">
		<h4>My Family Member Details</h4><br>
		<label><span>Name  : </span><?php echo $order[0]->first.' '.$order[0]->middle.' '.$order[0]->last;?></label><br>
		<label><span>Email : </span><?= $order[0]->email;?></label><br> 
		<label><span>Relation : </span><?= $relation->family_relation_name;?></label><br> 
		<label><span>Contact No : </span><?= $order[0]->contact;?></label><br>
		<label><span>Gender : </span><?= $order[0]->gender;?></label><br>
		<label><span>Marital Status : </span><?= $mastatus->marital_status_name;?></label><br>
		<label><span>Mother Tounge : </span><?= $order[0]->language;?></label><br>
		<label><span>Date of Birth : </span><?= $order[0]->date_of_birth;?></label><br>
		<label><span>Religion : </span><?= $order[0]->religion;?></label><br>
		<label><span>Caste : </span><?= $caste[0]->caste_name;?></label><br>
		<label><span>Sub Caste : </span><?= $caste[0]->sub_caste_name;?></label><br><br><br>
		<h5>PERMANENT / RESIDENTIAL ADDRESS :</h5><br>
		<label><span>Address : </span><?= $reside[0]->address;?></label><br> 
		<label><span>Landmark : </span><?= $reside[0]->landmark;?></label><br>
		<label><span>City : </span><?= $reside[0]->city;?></label><br>
		<label><span>District : </span><?= $reside[0]->district;?></label><br>	
		<label><span>Pin Code : </span><?= $reside[0]->pincode;?></label><br>
		<label><span>State : </span><?= $reside[0]->state;?></label><br>
		<label><span>Country : </span><?= $reside[0]->country;?></label><br><br><br>		
		<h5>Address for correspondence :</h5><br>
		<label><span>Address : </span><?= $corres[0]->address;?></label><br> 
		<label><span>Landmark : </span><?= $corres[0]->landmark;?></label><br>
		<label><span>City : </span><?= $corres[0]->city;?></label><br>
		<label><span>District : </span><?= $corres[0]->district;?></label><br>
		<label><span>Pin Code : </span><?= $corres[0]->pincode;?></label>
		<label><span>State : </span><?= $corres[0]->state;?></label><br>
		<label><span>Country : </span><?= $corres[0]->country;?></label><br>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	<label><span>Profile : <br></span><img alt=""style="width:200px;height:250px;" src="<?php echo upload_path; ?>/profile/<?=$order[0]->image;?>" /></label><br>
</div>