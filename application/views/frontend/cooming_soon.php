<!DOCTYPE html>
<html>

<link href="<?php echo theme_assets_path; ?>global/plugins/bootstrap/css/bootstrap.min.css"
	rel="stylesheet" type="text/css" />
<style>
body, html {
  height: 100%;
  background-color: black;
  font-weight: 600;
}
.bgimg {
  /* Background image */
  background-image: url('<?php echo assets_path; ?>img/cooming_soon1.png');
  /* Full-screen */
  height: 100%;
  /* Center the background image */
  background-position: center;
  /* Scale and zoom in the image */
  background-size: cover;
  /* Add position: relative to enable absolutely positioned elements inside the image (place text) */
  position: relative;
  /* Add a white text color to all elements inside the .bgimg container */
  color: white;
  /* Add a font */
  font-family: "Courier New", Courier, monospace;
  /* Set the font-size to 25 pixels */
  font-size: 25px;
  
  background-size: 100% 100%;
  background-repeat: no-repeat;
}

/* Position text in the top-left corner */
.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

/* Position text in the bottom-left corner */
.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
}

/* Position text in the middle */
.middle {
    position: absolute;
    top: 58%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    /* background-color: #bfacac4d; */
    color: #ceda15;
}

/* Style the <hr> element */
hr {
  margin: auto;
  width: 40%;
}
h1{
	font-size: 50px;
	font-weight: 600;
} 
p{
	font-size: 32px;
	padding-top: 40px;
}
.btn-success {
    color: #fff;
    border-color: #dac215;
    background-color: #dac215;
}
.btn-group-lg>.btn, .btn-lg {
    padding: 8px 14px;
    font-size: 18px;
    line-height: 1.33333;
    border-radius: 6px;
    font-weight: 600;
}

@media (max-width: 992px){
	.bgimg {
    
    height: 70%;
    background-position: center;
    background-size: cover;
    position: relative;
    color: white;
    font-family: "Courier New", Courier, monospace;
    font-size: 25px;
    background-size: 100% 100%;
    background-repeat: no-repeat;
}	
	.middle {
		position: absolute;
		top: 55%;
		left: 48%;
		transform: translate(-50%, -50%);
		text-align: center;
	}
	h1{
		font-size: 70px;
		font-weight: 600;
	} 
	p{
		font-size: 55px;
		padding-top: 20px;
	}
	.btn{
		font-size: 50px;
		padding: 15px 50px;
	}
}
</style>
<body>

<div class="bgimg">
  <!--<div class="topleft">
    <p>Logo</p> 
  </div>-->
  <div class="middle">
    <h1>To avail the offer</h1></br>
		<?php
				date_default_timezone_set("Asia/Calcutta");
				if(date("Y-m-d")>="2019-10-08"){?>
        		<a class="myfuellink btn btn-lg btn-success" href="<?php echo base_url('launching_offers'); ?>" class="logo">Click</a>
				<?php } else { ?>
				<button class="btn btn-lg btn-success" onclick="alertshow()" >Click</button>
   
				<?php } ?>
				<p >from 8th october morning</p>
  </div>
  <!--<div class="bottomleft">
    <p>Some text</p>
  </div>-->
</div>

<div class="modal fade" id="interestedModal" tabindex="-1" role="dialog" aria-labelledby="interestedModal" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
			<div class="modal-header"  >
        		<h4 class="text-center"> Welcome to MyFuel
			
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
         			<span aria-hidden="true">&times;</span>
        		</button>
				 
				</h4>
      		</div>
      		<div class="modal-body" style=" min-height: 300px;">
     			<h2 class="text-center"> 	Dear, click me on 8th morning!!!
     			</h2> 	
			</div>
  		</div>
	</div>
</div>


<script src="<?php echo theme_assets_path; ?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo theme_assets_path; ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo assets_path; ?>vendor/sweetalert/sweetalert.min.js"></script>
</body>
</html>

<script>
function alertshow(){
	 
	 swal("Welcome to MyFuel", " Dear, click me on 8th morning!!!", "");

}
</script>
