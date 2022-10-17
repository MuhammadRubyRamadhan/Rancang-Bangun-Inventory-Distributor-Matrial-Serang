<?php
session_start();
include 'koneksi.php';
if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) 
{
	echo "<script>alert('Keranjang Kosong !! Silahkan Pilih Pesanan');</script>";
	echo "<script>location='index.php'; </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>CV. Triftonic Eka Fivesoon</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<script src="assets/js/jquery.js"></script>
	 <link href="assets/css/font-awesome.css" rel="stylesheet" />
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
		<hr>
		<div class="container">
			<div class="scroll">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center"> NO </th>
						<th class="text-center">KODE BARANG</th>
						<th class="text-center"> NAMA BARANG </th>
						<th class="text-center"> HARGA </th>
						<th class="text-center"> OPSI</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomer=1; ?>
					<?php foreach ($_SESSION["keranjang"] as $id_barang => $jumlah): ?>
					
					<!--Mengambil dan menampilkan data produk-->
					<?php 
					$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
					$pecah = $ambil->fetch_assoc(); 
					/*$subharga = $pecah["harga_barang"]*$jumlah;*/
					$diambil = $koneksi->query("SELECT * FROM pengeluaran WHERE id_barang='$id_barang' ");
					$dipecah = $diambil->fetch_assoc();
					?>
					<tr>
						<td class="text-center"><?php echo $nomer; ?>.</td>
						<td class="text-center"><input type="text" name="kode" class="form-control text-center" readonly value="<?php echo $dipecah['kode_barang'] ?>" ></td>
						<td><input type="text" name="nama" class="form-control" readonly value="<?php echo $dipecah['nama_barang'] ?>" ></td>
						<td><input type="number" step="any" name="harga" id="harga" class="form-control" readonly value="<?php echo $pecah['harga_barang'] ?>" ></td>
						<td class="text-center">
							<a href="hapuskeranjang.php?id=<?php echo $id_barang ?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"> </i> Hapus </a>
						</td>
					</tr>
					<?php $nomer++;?>	
					<?php endforeach ?>
				</tbody>
			</table>
			<h4><b><i class="text-danger">*Cek kembali ORDERAN !!!</i></b><br><br></h4>
			<a href="index.php" class="btn btn-primary"><i class="glyphicon glyphicon-backward"> </i> Lanjutkan Belanja</a>
			<a href="checkout.php" class="btn btn-primary"><i class="fa fa-share"> </i> CheckOut</a>
			</div>
		</div>
	</section>
	</section>
	
</body>
</html>
