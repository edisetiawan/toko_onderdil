<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- DATA TABLES -->
    <link href="<?php echo base_url();?>AdminLTE/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>AdminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function refreshAndClose(){
		window.opener.location.reload(true);
		window.close();
	}
</script>
<!--<script type="text/javascript">
	$(document).ready(function(){
		$('#btn').click(function{
			window.opener.location.reload(true);
			window.close();
		});
	});
</script>-->


</head>
<!--onbeforeunload='refreshAndClose();'-->
<body onbeforeunload='refreshAndClose();'>
<section class="content-header">
   <h1>
      Produk
   </h1>
</section>	
<section class="content">
<div class="row">
   	<div class="col-xs-12">
       	<div class="box">
	        <div class="box-header">
    	        <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <div class="box-body">	
				
				<?php $id_beli = $detil->id_beli;?>
				<?php $id_produk = $detil->id_produk;?>
				<?php $id_suplier = $detil->id_suplier;?>
				<?php $harga_beli = $detil->harga_beli;?>
				
				<?php $produk = $this->db->query("select * from tbl_produk join tbl_Suplier on tbl_Suplier.id_suplier = tbl_suplier.id_suplier where tbl_produk.id_suplier = $id_suplier group by tbl_produk.id_produk");?>
				 
			  	<form action="" method="post">
				<div class="col-md-3">
					<div class="form-group">
						<label class="col-sm-2 control-label">Produk</label>
						<div class="col-sm-2">
						<select class="form-control" name="id_produk">
							<option>--Pilih Produk--</option>
							<?php foreach($produk->result() as $row):?>
							
							<option value="<?php echo $row->id_produk;?>"<?php if($row->id_produk == $detil->id_produk)echo 'selected';?>><?php echo $row->nama_produk;?></option>
							<?php endforeach?>
						</select>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="col-sm-2 control-label">JML Beli</label>
						<div class="col-sm-2">
							<input class="form-control" type="text" name="jml_beli" value="<?php echo $detil->jml_beli;?>" />
						</div>
					</div>
				</div>
				
				<div class="box-footer">
					<input type="hidden" name="id_beli" value="<?php echo $id_beli;?>" />
					<input type="hidden" name="id_detil_beli" value="<?php echo $detil->id_detil_beli;?>" />
					<!--<input type="text" name="harga_beli" value="<?php /*echo $harga_beli;*/?>" />-->
					<button type="submit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Beli</button>
					<a href="#" onclick="window.close()" class="btn btn-sm btn-danger">Batal</a>
				</div>
						  
				</form>
			 </div>
		</div>
	</div>
</div>
</section>	
    <script src="<?php echo base_url();?>AdminLTE/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>AdminLTE/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
</body>
</html>
