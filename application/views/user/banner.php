    <script src="<?php echo base_url();?>sb-admin/bower_components/jquery/dist/jquery.min.js"></script> 

  <link rel="stylesheet" href="<?php echo base_url();?>slider/responsiveslides.css">

  <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
  <script src="<?php echo base_url();?>slider/responsiveslides.js"></script>
  <script src="<?php echo base_url();?>slider/responsiveslides.min.js"></script>
  <script>
    // You can also use "$(window).load(function() {"
    $(function () {

      // Slideshow 1
      $("#slider1").responsiveSlides({
        /*maxwidth: 1200,*/
        speed: 800
      });

      // Slideshow 2
      $("#slider2").responsiveSlides({
        auto: false,
        pager: true,
        speed: 300,
        /*maxwidth: 540*/
      });

      // Slideshow 3
      $("#slider3").responsiveSlides({
        manualControls: '#slider3-pager',
        /*maxwidth: 540*/
      });

      // Slideshow 4
      $("#slider4").responsiveSlides({
        auto: false,
        pager: false,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function () {
          $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events').append("<li>after event fired.</li>");
        }
      });

    });
  </script>
	
		<!--<div class="header-para" style="width:22%;">
			<ul class="customcontent-top">
                <li class="item  first_item">
                   <div class="item_html">
			          <a href="#">
						<div class="banner1">
							<span class="text10">Sparepart</span>
							<span class="text11">50%  </span>
							<span class="text12">Lebih Murah</span>
						</div>
						</a>
			        </div>
              	</li>
                <li class="item  last_item">
			       <div class="item_html">
			          <a href="#">
						<div class="banner2">
							<span class="text10">Servis</span>
							<span class="text14">Diskon 30%</span>
							
						</div>
					  </a>
			        </div>
            	</li>
            </ul>
		</div>-->
     	<div class="slider" style="width:100%;">
     		<div id="slideshow">
				<ul class="rslides" id="slider1">
					<li><a href=""><canvas ></canvas><img style="width:100%;" src="<?php echo base_url();?>public/media/slider/Babeh-Scooter-Condet-04.jpg" alt="Marsa Alam underawter close up" ></a></li>
					<li><a href=""><canvas></canvas><img style="width:100%;"src="<?php echo base_url();?>public/media/slider/komunitas-vespa.jpg" alt="Turrimetta Beach - Dawn" ></a></li>
					<li><a href=""><canvas></canvas><img style="width:100%;"src="<?php echo base_url();?>public/media/slider/c.php.jpg" alt="Power Station" ></a></li>
					<li><a href=""><canvas></canvas><img style="width:100%;"src="<?php echo base_url();?>public/media/slider/vespa-mini-3.jpg" alt="Colors of Nature" ></a></li>
				</ul>
				<!--<span class="arrow previous"></span>
				<span class="arrow next"></span>-->
			</div>
		</div>
       <div class="clear"></div> 
