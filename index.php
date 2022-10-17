<?php
session_start();

include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>CV. Triftonic Eka Fivesoon</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
	<style>
		.scroll{
			height: 300px;
			overflow: scroll;
		}
	</style>
	<style type="text/css">
 
    footer{
        font-family: 'Arial', sans-serif;
        background-color: #333333;
        color: white;
    } 
    </style>
</head>
<body>

	<!-- Memanggil Navbar -->
	<?php include'menu.php'; ?>
	<!--membuat section header -->
	<section class="header_text">
		<h1><b><center>T R I F T O N I C</center></b></h1><br>
		
	<!--konten-->
	<section class="konten">
		<div class="container">
			<center><h4 style="color:blue"><b>Beranda Belanja <i class="glyphicon glyphicon-shopping-cart"></i></b></h4></center>
		</div>
				<div class="container">
			
		<hr>
				
                <!-- /. ROW  -->
               
                <div class="container">
               <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                    	<div class="panel-heading text-center">
                            <a href="keranjang.php" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-shopping-cart"></i> Keranjang </a><br> <h4>Rincian Tabel Barang</h4> 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
			 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th class="text-center"> NO </th>
						<th class="text-center"> KODE BARANG </th>
						<th class="text-center"> NAMA BARANG </th>
						<th class="text-center"> HARGA </th>
						<th class="text-center"> STOK </th>
						<th class="text-center"> OPSI</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomer=1; ?>
					<?php $ambil =$koneksi->query("SELECT * FROM barang ORDER BY nama_barang ASC"); ?>
					<?php while($pecah= $ambil->fetch_assoc()){ ?>
					<tr>
						<td class="text-center"> <?php echo $nomer; ?>.</td>
						<td class="text-center"> <?php echo $pecah['kode_barang']; ?></td>
						<td> <?php echo $pecah['nama_barang']; ?></td>
						<td>Rp.<?php echo $pecah['harga_barang']; ?></td>
						<td> <?php echo $pecah['stok_barang']; ?></td>
						<td class="text-center">
							<a  href="masukkeranjang.php?id=<?php echo $pecah['id_barang']; ?>" class="btn btn-success" ><i class="fa fa-money"></i> Beli </a>
						</td>
					</tr>
					<?php $nomer++; ?>
					<?php } ?>
				</tbody>
			</table>
			</div>
                            
                        </div>
                    </div>
			</div>
                    <!--End Advanced Tables -->
                </div>
                </div>
           
		</div>
	</section>
	</section>
	<!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>