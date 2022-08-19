<?php 
	$this->load->view('site/_includes/header');
?>
<style>
   
h3 {
  margin: 0;
  padding: 0;
  position: absolute;
  top: 40%;
  left: 5%;
  /* transform: translate(-50%, -50%); */
  color: black;
  font-family: Times New Roman, serif;
  /* background: -webkit-linear-gradient(deeppink, yellow, deeppink, purple);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent; */
  font-size: 6.5vw;
  /* text-transform: uppercase; */
}
h3:before {
  content: attr(data-text);
  position: absolute;
  top: 0;
  left: 0;
  transform-origin: bottom;
  transform: rotateX(180deg);
  line-height: 1.14em;
  /* background: linear-gradient(0deg, #000000 0, transparent 70%); */
  -webkit-background-clip: text;
  -webkit-text-color: transparent;
  opacity: 0.3;
}

</style>
<section class="bgwhite p-b-150">
		<div class="col-md-12">
			<div class="row">
        <div class="p-r-20 p-b-30 p-r-0-sm form-group">
          <h3 data-text="Work In Progess Coming Soon...">Work In Progess Coming Soon...</h3>
        </div>
    </div>
  </div>
</section>
<div class="p-b-60">
  &nbsp;
</div>
<?php 
	$this->load->view('site/_includes/footer');
?>