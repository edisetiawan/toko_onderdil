<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Sigit Vespa</title>
<link href="<?php echo base_url();?>motor/web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url();?>motor/web/css/global.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url();?>motor/web/css/flexslider.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--slider-->
<script src="<?php echo base_url();?>motor/web/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>motor/web/js/script.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>motor/web/js/superfish.js"></script>

<link href="<?php echo base_url();?>lightbox/css/lightbox.css" rel="stylesheet" />
<script src="<?php echo base_url();?>lightbox/js/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url();?>lightbox/js/lightbox.min.js"></script>

    <link href="<?php echo base_url();?>AdminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>AdminLTE/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url();?>AdminLTE/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>AdminLTE/dist/js/app.min.js" type="text/javascript"></script>


</head>
<body>
<div class="wrap"> 
	<div class="total">
		<?php echo $this->load->view('user/header');?>
		
		<div class="mian">
			<section class="main-info">
			<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success ">
					<h5><?php echo $this->session->flashdata('success'); ?></h5>
				</div>
			<?php endif; ?>
			<?php if ($this->session->flashdata('error')): ?>
				<div  class=" alert alert-danger">
					<h5><?php echo $this->session->flashdata('error'); ?></h5>
				</div>
			<?php endif; ?>			
			</section>
		
			<?php echo $this->load->view($content);?>
		</div>
		<div class="footer">
			<?php echo $this->load->view('user/footer');?>
		</div>
	</div>
</div>
</body>
</html>

    	
    	
            