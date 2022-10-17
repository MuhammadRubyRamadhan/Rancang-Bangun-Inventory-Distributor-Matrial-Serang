<?php 
	session_start();
	include'koneksi.php'; 
 					 
 	$ambil =  $koneksi->query("SELECT * FROM pembelian JOIN karyawan ON pembelian.id_karyawan=karyawan.id_karyawan WHERE pembelian.id_pembelian ='$_GET[id]' "); 
 	$id = $_GET['id'];
 	$pecah = $ambil->fetch_assoc();
 	/*echo "<pre>";
	print_r($pecah);
	echo "</pre>";*/
 					
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Nota Pembelian</title>
 	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<script src="assets/js/jquery.js"></script>
 </head>
 <body>
 		<!--navbar-->
	<nav class="navbar navbar-default">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>				
				<li><a href="checkout.php">Checkout</a></li>
			</ul>
			<form method="post">	
			<button class="btn btn-primary navbar-btn navbar-right" name="cetak"><i class="fa fa-print"></i> Print</button>
			</form>
			<?php  
				if (isset($_POST['cetak'])) 
				{
					$koneksi->query("DELETE FROM pengeluaran WHERE id_pengeluaran");
					echo "<script>alert('Sudah di masukkan');</script>";
					echo "<script>location='cetak.php?id=$id'; </script>";

				}
			?>
		</div>
	</nav>
 		<section class="header-text">
 			<h1><b><center>T R I F T O N I C</center></b></h1>

 			<section class="konten">
 				<div class="container">
 					<center><h2>Nota Pembelian</h2></center>
 					
 					<hr>

 					<div class="row">
 						<div class="text-center">
 							<p><h4><center>Triftonic Eka Fivesoon</center></h4></p>
 							<p><h5><center>Jln.Desa Masjid Priyai Kec.kasemen - Kota.Serang - Banten <br> 42191</center></p>
 						</div>
 						<div class="col-md-4">
 							Tanggal Pembelian : <b><?php  echo date("d F Y",strtotime($pecah["tanggal_pembelian"])) ?></b> <br>
 							Selesmen 		  : <b><?php echo $pecah['nama_karyawan'] ?></b> <br>
 							Jatuh Tempo		  : <b><?php echo $pecah['jatuh_tempo'] ?> </b>
 						
 						</div>
 						<div class="col-md-4">
 							<p></p>
 						</div>
 						<div class="col-md-4">
 							Kepada Yth <br>
 							Nama Toko		  :<b> <?php echo $pecah['nama_toko'] ?> </b><br>
 							Alamat Toko		  : <b><?php echo $pecah['alamat_pengiriman'] ?> </b>
 						</div>
 					</div>
 					<table class="table table-bordered">
 						<thead>
 							<tr>
	 							<th class="text-center">Kode Barang</th>
	 							<th class="text-center">Nama Barang</th>
	 							<th class="text-center">Harga Jual</th>
	 							<th class="text-center">Jumlah Barang</th>
	 							<th class="text-center">Diskon (%)</th>
	 							<th class="text-center">Total</th>
 							</tr>
 						</thead>
 						<tbody>
	 							<?php $tot = 0; ?>
	 							<?php $diambil = $koneksi->query("SELECT * FROM penjualan WHERE id_pembelian = '$_GET[id]' "); ?>
	 							<?php foreach ($diambil as $key => $value): ?>
	 								<?php $hargaa = $value['total_harga']; ?>
	 								<?php  
	 									/*echo "<pre>";
										print_r($value);
										echo "</pre>";*/
	 								?>
 							<tr>
	 							<td class="text-center"><?php echo $value['kode_barang']; ?></td>
	 							<td><?php echo $value['nama_barang']; ?></td>
	 							<td>Rp.<?php echo number_format($value['harga']) ?></td>
	 							<td class="text-center"><?php echo $value['jumlah']; ?></td>
	 							<td class="text-center"><?php echo $value['diskon']; ?>%</td>
	 							<td>Rp.<?php echo number_format($hargaa); ?></td>
	 						</tr>
	 							<?php $tot += $hargaa ?>
	 						<?php endforeach ?>
 						</tbody>
 						<tfoot>
 							<th colspan="5">Total Pembelian</th>
 							<th>Rp.<?php echo number_format($tot) ?></th>
 						</tfoot>
 					</table>
 					<div class="col-md-5">
 						Diterima Oleh :<br><br><br>
 						____________ <br>
 					Barang - barang tersebut telah diterima dengan baik dan cukup

 					</div>
 					<div class="col-md-5">
 							<p></p>
 						</div>
 					<div class="col-md-5">
 						Hormat Kami, <br><br><br>
 						____________
 					</div>
 				</div>
 			</section>
 		</section>
 </body>
 </html>