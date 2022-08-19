 <?php 
 $this->load->helper('custom');
 ?>

		<div class="col-md-12">	 
			<div class="panel panel-primary" style="border-radius: 4px !important;margin-bottom: 0px;">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						 
							<?php
								$table = 'user';
								$where = array('class_id'=>$user_class->id);
								$order_cnt = $this->user_model->record_count($table, $where);

								if($user_class->discount_on == 1){
									$discount_on = 'Whole Order';
									$discountp = $user_class->discount;
								}else{
									$discount_on = 'Particular Product';
									$discountp = '-';
								}
								if($user_class->discount_in == 1){
									$discount_in = 'Percent (%)';
								}else{
									$discount_in = 'Rupees';
								}
								?>

						<div class="row">
						<div class="col-md-12">
						 <br><table class="table table-user-information">
							<tbody>
							<tr style="color: #E91E63;font-weight: 900;">
								<td style="font-size:16px;">Class Name:</td>
								<td style="font-size:16px;"><?= $user_class->class_name; ?></td>
							</tr>
							<tr>
								<td>Discount On:</td>
								<td><?= $discount_on; ?></td>
							</tr>
							<tr>
								<td>Applied On Orders:</td>
								<td> <?php if($order_cnt > 0){ ?><a href="javascript:void(0);" onclick="user_in_class(<?= $user_class->id; ?>)" class="btn default btn-xs blue-sharp-stripe"> users in Class (<?= $order_cnt; ?>) </a> <?php } ?> </td>
							</tr>
							<tr>
								<td>Status:</td>
								<td><?php if($user_class->status == 1) { echo 'Active'; }
											else if($user_class->status == 2) {	echo 'Inactive'; } ?></td>
							</tr>
			
							</tbody>
						  </table>
						</div>
						</div>
					</div>
		
					<div class=" col-md-8" style="border-left:  1px solid lightgray;">
						<strong><?= $user_class->class_name; ?> Class Details</strong><br><br>
						<?php if(count($products)<=0){ ?> 
							<p> Discount on whole order </p>
							<table class="table table-user-information">
								<tbody>
								<tr>
									<td>Discount In:</td>
									<td><?= $discount_in; ?></td>
								</tr>
								<tr>
									<td>Discount:</td>
									<td><?= $discountp; ?></td>
								</tr>
								</tbody>
							</table>
						<?php }else{ ?>
						<table class="table table-user-information">
							<tbody>
							<tr>
								<th>Product Name</th>
								<th>Discount</th>
								<th>Discount In</th>
							</tr>
							<?php for($i=0;$i<count($products);$i++){ 
								if($products[$i]->discount_in == 1){
									$discount_in = 'Percent (%)';
								}else{
									$discount_in = 'Rupees';
								}
							?>
							<tr>
								<td><?= get_product_name($products[$i]->product_id); ?></td>
								<td><?= $products[$i]->discount; ?></td>
								<td><?= $discount_in; ?></td>
							</tr>
							<?php } ?>
							</tbody>
						</table>
						<?php } ?>
					</div>
				</div>

				<div class="row">
					<hr>
					<div class="col-md-12">
						Note:
						<?= $user_class->note; ?>
					</div>
				</div>
				
			</div> 
			</div>
		</div>