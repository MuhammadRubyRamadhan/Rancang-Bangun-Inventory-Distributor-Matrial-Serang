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
						<th> NO </th>
						<th> NAMA BARANG </th>
						<th> HARGA </th>
						<th> JUMLAH </th>
						<th> SUBHARGA</th>
						<th> OPSI</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomer=1; ?>
					<?php foreach ($_SESSION["keranjang"] as $id_barang => $jumlah): ?>
					
					<!--Mengambil dan menampilkan data produk-->
					<?php 
					$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
					$pecah = $ambil->fetch_assoc(); 
					$subharga = $pecah["harga_barang"]*$jumlah;
					?>
					<tr>
						<td><?php echo $nomer; ?>.</td>
						<td><?php echo $pecah["nama_barang"]; ?></td>
						<td><?php echo number_format( $pecah["harga_barang"]); ?>
							<a href="ubahkeranjang.php?id=<?php echo $id_barang ?>" class="btn btn-warning btn-xs">ubah</a>
						</td>
						<td><?php echo $jumlah; ?></td>
						<td><?php echo number_format($subharga); ?></td>
						<td>
							<a href="hapuskeranjang.php?id=<?php echo $id_barang ?>" class="btn btn-danger btn-xs">hapus</a>
						</td>
					</tr>
					<?php $nomer++;?>	
					<?php endforeach ?>
				</tbody>
			</table>
			<a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
			<a href="checkout.php" class="btn btn-primary">CheckOut</a>
			</div>
		</div>
	</section>
	</section>
	
</body>
</html>