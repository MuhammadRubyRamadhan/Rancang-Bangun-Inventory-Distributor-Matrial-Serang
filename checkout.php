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
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<script src="assets/js/jquery.js"></script>
</head>
<body>

	<!-- Memanggil Navbar -->
	<?php include'menu.php'; ?>
	<!--membuat section header -->
	<section class="header_text">
		<h1><b><center>T R I F T O N I C</center></b></h1><br>
		
	<!--konten-->
			<form method="post">
	<section class="konten">
		<div class="container">
			<center><h4 style="color:blue"><b>Beranda Belanja <i class="glyphicon glyphicon-shopping-cart"></i></b></h4></center>
		</div>
		<hr>
		<div class="container">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center"> NO </th>
						<th class="text-center">KODE BARANG</th>
						<th class="text-center"> NAMA BARANG </th>
						<th class="text-center"> HARGA JUAL </th>
						<th class="text-center">JUMLAH</th>
						<th class="text-center">DISKON (%)</th>
						<th class="text-center"> TOTAL </th>
						<th class="text-center"> OPSI</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomer=1; ?>
					<?php $totalbelanja = 0; ?>
					<?php foreach ($_SESSION["keranjang"] as $id_barang => $jumlah): ?>
					
					<!--Mengambil dan menampilkan data produk-->
					<?php 
					$diambil = $koneksi->query("SELECT * FROM pengeluaran WHERE id_barang='$id_barang' ");
					$dipecah = $diambil->fetch_assoc();
					$subharga = $dipecah["harga_barang"];
					/*echo "<pre>";
					print_r($dipecah);
					echo "</pre>";*/
					//ambil data barang
					$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang' ");
					$pecah = $ambil->fetch_assoc();
					/*echo "<pre>";
					print_r($pecah);
					echo "</pre>";*/
					?>
					<tr>
						<td class="text-center"><?php echo $nomer; ?>.</td>
						<td class="text-center"><?php echo $dipecah['kode_barang'] ?></td>
						<td><?php echo $dipecah['nama_barang'] ?></td>
						<td> Rp. <?php echo number_format($pecah['harga_barang']) ?></td>
						<td class="text-center"><?php echo $dipecah['jumlah'] ?></td>
						<td class="text-center"><?php echo $dipecah['diskon'] ?>%</td>
						<td> Rp. <?php echo number_format($dipecah['harga_barang']) ?></td>
						<td class="text-center">
							<a href="hapuskeranjang.php?id=<?php echo $dipecah['id_pengeluaran'] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"> </i> Hapus</a>
							<a href="ubahkeranjang.php?id=<?php echo $dipecah['id_pengeluaran'] ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"> </i> Ubah</a>
						</td>
					</tr>
					<?php $nomer++;?>
					<?php $totalbelanja += $subharga ?>	
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="6">Total</th>
						<th>Rp. <?php echo number_format($totalbelanja) ?> </th>
					</tr>
				</tfoot>
			</table>
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<label>Nama Toko</label>
							<input type="text" class="form-control" name="toko" placeholder="Masukkan Nama Toko" autocomplete="off" >
						</div>
					</div>
						<div class="col-md-5">
							<div class="form-group">
								<label>Jatuh Tempo</label>
								<input type="date" class="form-control" name="tempo">
							</div>
						</div>
						<div class="col-md-5">
							<label>Nama Sales</label>
							<select class="form-control" name="id_karyawan">
								<option>Pilih Sales</option>
								<?php 
								$aambil = $koneksi->query("SELECT * FROM karyawan");
								while ($pecah = $aambil->fetch_assoc()) {
								?>
								<option value="<?php echo $pecah["id_karyawan"] ?> "> -
									<?php echo $pecah['nama_karyawan'] ?>
								</option>
								<?php } ?>
									
							</select>
						</div>
						<div class="col-md-5">
							<label>Pembayaran</label>
							<select class="form-control" name="pembayaran">
								<option>---Pilih---</option>
								<option value="Belum Melakukan Pembayaran"> - Kredit</option>
								<option value="LUNAS"> - Cash</option>
							</select>
						</div>
				</div>
					<div class="form-group">
						<label>Alamat Pengiriman</label>
						<textarea class="form-control" name="alamat_pengiriman" placeholder="Masukkan Alamat Pengiriman"></textarea>
						<b><i class="text-danger">*Pastikan semua data terisi dan benar !!!</i></b><br>
						<b><i class="text-danger">*Cek jumlah dan diskon barang  !!!</i></b>
					</div>
			<button class="btn btn-primary" name="lanjut"><i class="fa fa-share"> </i> Lanjut</button>
			</form>
			</div>
		</div>
			<?php 
				if (isset($_POST["lanjut"])) 
				{
					$idk = $_POST["id_karyawan"];
					$namatoko = $_POST["toko"];
					$tanggal = date("Y/m/d");
					$jtempo = $_POST["tempo"];
					$alamattoko = $_POST["alamat_pengiriman"];
					$mpembayaran = $_POST["pembayaran"];
					$totalseluruh = $totalbelanja;
					//menyimpan ke databae pembelian
					$koneksi->query("INSERT INTO pembelian (id_karyawan,nama_toko,tanggal_pembelian,jatuh_tempo,jenis_pembayaran,alamat_pengiriman,total_harga_keseluruhan,total_cicilan) VALUES ('$idk','$namatoko','$tanggal','$jtempo','$mpembayaran','$alamattoko','$totalseluruh','$totalseluruh') ");
						//mendapatkan id double
						$id_pembelian_barusan = $koneksi->insert_id;
					//perulangan session keranjang
					foreach ($_SESSION["keranjang"] as $id_barang => $jumlah)
					{
					//memanggil databsae pengeluaran
					$diambil = $koneksi->query("SELECT * FROM pengeluaran WHERE id_barang='$id_barang' ");
					$dipecah = $diambil->fetch_assoc();
					//memanggil databsae barang (ambil harga barang)
					$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang' ");
					$pecah = $ambil->fetch_assoc();
						//eksekusi
						$kd = $dipecah['kode_barang'];
						$nb = $dipecah['nama_barang'];
						$diskonn = $dipecah['diskon'];
						$jum  = $dipecah['jumlah'];
						$har = $pecah['harga_barang'];
						$tot = $dipecah['harga_barang'];
						//menyimpan ke databae penjualan
						$koneksi->query("INSERT INTO penjualan (id_pembelian,id_barang,kode_barang,nama_barang,jumlah,diskon,harga,total_harga) VALUES ('$id_pembelian_barusan','$id_barang','$kd','$nb','$jum','$diskonn','$har','$tot') ");

						//mengurangi stok barang
						$koneksi->query("UPDATE barang SET stok_barang = stok_barang - $jum WHERE id_barang = '$id_barang' ");

						
					}
					//Mengkosongkan SESSION Keranjang
					unset($_SESSION["keranjang"]);

						echo "<script>alert('sudah di masukkan');</script>";
						echo "<script>location='nota.php?id=$id_pembelian_barusan'; </script>";
				}

			 ?>
	</section>
	</section>

</body>
</html>
