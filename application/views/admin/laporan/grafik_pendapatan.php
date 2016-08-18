<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script src="<?php echo base_url();?>public/js/FusionCharts.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/exporting.js"></script>
   <!-- <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.js" ></script>-->

</head>

<body>
<section class="content-header">
   <h1>
       Grafik
   </h1>
</section>	
<section class="content">
    <div class="row">
    	<div class="col-xs-12">
        	<div class="box">
                <div class="box-header">
				<?php foreach($tahun as $row):?>
                  <h3 class="box-title">Grafik Pendapatan <?php echo $row->tahun;?></h3>
				<?php endforeach;?>
                </div><!-- /.box-header -->
                <div class="box-body">	
				<script type="text/javascript">
					function chart_onchange(val)
					{
						document.location =  '<?php echo site_url(); ?>admin/grafik/grafik_pendapatan/' + val;
					}
				</script>
				 <?PHP echo $chart; ?>
					<div class="pull-right">
					<form action="<?php echo site_url('admin/grafik/grafik_pendapatan');?>" method="post">
						<select name="tahun" class="form-control" onchange="this.form.submit();">
							<option value="0">--Pilih Tahun--</option>
							<?php 
								$thn=date('2015');
								for($a=0; $a<=5; $a++){
									$tahun = $thn + $a;
									?>	
								<option value="<?php echo $tahun;?>"> Tahun <?php echo $tahun;?></option>	
							<?php }?>
						</select>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</body>
</html>
