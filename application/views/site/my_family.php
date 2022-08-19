
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
.table-responsive{
	max-width:100%;
	overflow:auto;
	
}
.btn.green-meadow-stripe{
	border: solid 2px #1BBC9B!important;
    min-width: 80px;
    height: 25px;
    border-radius: 0px;
    padding: 3px;
    text-align: center;
    line-height: 0px;
    text-transform: capitalize;
    margin-top: 0px;
    color: #fff;
    }
.btn.green-seagreen:not(.btn-outline){
    color:#FFF!important;
    }
.default{
	color:red!important;
	background:#fff!important;
}
/* @media only screen and (min-width: 1000px) {
	button {
      width:60%!important;
	}
} */
</style>
    
	 
<!-- Content page -->
<section class="bgwhite p-t-7 p-b-10">
	<div class="col-md-12">
		<div class="row">
		 

		<div class="col-sm-12 col-md-12 col-lg-12 ">
			<section class="bgwhite tab-pane  " id="display_div">
			</section>
			<section class="bgwhite tab-pane  " id="profile_section_div">
				<div class=" ">
					<div class="p-b-40">
						<div class="blog-detail-txt p-t-33">
							<div class="row">
								<div class="col-md-5">
									<h4 class="m-text24">
										My Family:
									</h4>
								</div>
								<div class="col-md-5">
									<button class="flex-c-m sizefull bg1 bo-rad-20 hov1 s-text1 trans-0-4" onclick="add_family();" href="javascript:void(0);" style="width: 50%; float: right; height: 40px;">
									Add Family
									</button> 
								</div>
							</div>
							<hr> </hr>
							<div class="portlet-body">
							<div class="form-body">
								<div class="table-responsive">
								<table style="width:100%" class="table table-striped table-bordered table-hover table-checkable order-column" data-page-length='10'>
									<thead>
										<tr>
											<th>Sr.No.</th>
											<th>Full Name</th>
											<th>Image</th>
											<th>Contact</th>
											<th>Relation</th>
											<th style="min-width:90px;">Status</th>
											<th style="width: 30%;">Actions</th>
										</tr>
									</thead>
								<tbody>
								<?php 
								$qtyexcced=0;
								for($i=0;$i<count($order);$i++){
									
									$relation_i=$order[$i]->relation_id;
									$relation1=$this->db->query("SELECT * FROM `family_relation` WHERE `id`=$relation_i");			
									$relation=$relation1->row();
									
									if($order[$i]->status==1){
										$status="Active";
									}else if($order[$i]->status==2){
										$status="Inactive";
									}else if($order[$i]->status==0){
										$status="Deleted";
									}	?>
								
									<tr class="odd gradeX" >
										<td ><?= $i+1; ?></td>
										<td><?= $order[$i]->first." ".$order[$i]->middle." ".$order[$i]->last; ?></td>
										<td><img src="<?php echo upload_path; ?>profile/<?=$order[$i]->image; ?>" alt="<?= $order[$i]->first; ?>" height="80" width="60"></td>
										<td><?= $order[$i]->contact; ?></td>
										<td><?= $relation->family_relation_name; ?></td>
										<td> <?php echo $status; ?> </td>

										<td>
										<a href="javascript:void(0);" class="btn btn-xs green-meadow-stripe"  onclick="view_family(<?= $order[$i]->id; ?>)" ><i class="fa fa-eye"></i> View</a>
										<a href="javascript:void(0);" class="btn btn-xs green-meadow-stripe"  onclick="edit_family(<?= $order[$i]->id; ?>)" ><i class="fa fa-eye"></i> Edit</a>
										<a href="javascript:void(0);" class="btn default btn-xs green-meadow-stripe"  onclick="delete_user_family(0,'<?= $order[$i]->id; ?>')" ><i class="fa fa-trash"></i> Delete</a>
										</td>
									</tr>
								<?php } ?>
								</tbody>
								</table>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div> 
			</section>
		</div>
		</div>
	</div>
</section>
    <!--================End Category Product Area =================-->
	
	
	 <!-- Modal -->
  <div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg44 m-text3">
          
          <h4 class="modal-title">Family Member Details</h4>
		  <button style="color:#fff;" type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="view_order_details">
         
		</div>
        <div class="modal-footer" style="padding: 2px;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  

<?php 
	//$this->load->view('site/_includes/footer');
?>
<script>
	function view_family(id)
	{
	var url="<?php echo base_url('site/view_order_details');?>";
	$.post(url,{"id":id},function(res){
		//alert(res);
		if(res){
			$('#viewModal').modal();
			$("#view_order_details").html(res);
		}else{
			alert("Data not found!");
		}
	});
	}

	function add_family()
	{
		$.ajax({
			url:'<?= base_url("site/add_family_member/"); ?>',
			 type:'POST',
			data:{'id':''},
			success: function(data)
			{
				$('#profile_section_div').hide();
				$('#display_div').show();
				$('#display_div').html('');
				$('#display_div').append(data);
			}
		});
	}
</script>
<script>
  function edit_family(id)
	{
		$.ajax({
			url:'<?= base_url("site/edit_family_member/"); ?>',
			 type:'POST',
			data:{'id':id},
			success: function(data)
			{
				$('#profile_section_div').hide();
				$('#display_div').show();
				$('#display_div').html('');
				$('#display_div').append(data);
			}
		});
	}
	function delete_user_family(status,id)
	{
		if(status==0) 
		{
			var result = confirm("Want to delete family member ?");
		}
			if (result) 
			{	
					var url="<?php echo base_url('site/delete_family_details');?>";
				
				$.post(url,{"id":id,"status":status},function(res)
				{
					//alert(res);
						if(res==1 && status==0)
					{
						alert("Family member deleted successfully.");
						location.reload();
					}
					else
					{
						alert("Family member not deleted! try again...");
					}
				});
			} 
	} 
		
		function save_family_user()
	{ 	 
	 
	    var myform = document.getElementById("save_family_user_form");
		var fd = new FormData(myform);
		$.ajax({
		  url: "<?php echo base_url('site/save_family_user');?>",
		  type: "POST",
		  data: fd,
		  cache: false,
		  processData: false,  // tell jQuery not to process the data
		  contentType: false,   // tell jQuery not to set contentType
			success: function (data) {
				// alert(data);
				if(data==1){
			 	  swal("Success", "Profile Added Successfully..", "success");
				  setTimeout(function(){ 
					location.reload();
				  }, 2000);
					
				} 
				else{
				 $('#display_div').html('');
				$('#display_div').append(data);
				}
			}
		});  
	}
	
</script>