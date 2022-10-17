<h2>Ubah Produk</h2>
<?php
$id = $_GET['id'];
//menampilkan produk
$ambil=$koneksi->query("SELECT * FROM barang WHERE id_barang='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();

?>

<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Kode Barang</label>
			<input type="text" name="kode" class="form-control" value="<?php echo $pecah['kode_barang'] ?>" >
			<b><i class="text-danger">*Kode Barang harus seusai Price List !!!</i></b>
		</div>
		<div class="form-group">
			<label>Nama</label>
			<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_barang'] ?>" >
		</div>
		<div class="form-group">
			<label>Harga (Rp)</label>
			<input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga_barang'] ?>" >
		</div>
		<div class="form-group">
			<label>Stok</label>
			<input type="number" name="stok" min="0" class="form-control" placeholder="Tambahkan STOK barang" value="" >
			<b><i class="text-danger">*Kosongkan STOK BARANG jika tidak ada penambahan STOK !!!</i></b>
		</div>
		<a href="index.php?halaman=Barang" class="btn btn-warning"> <i class="glyphicon glyphicon-backward"> </i> Kembali </a>&emsp;
		<a href="index.php?halaman=ubahproduk&id=<?php echo $id ?>" class="btn btn-primary"> <i class="glyphicon glyphicon-refresh"> </i> Refresh </a>&emsp;
		<button class="btn btn-success" name="ubah"><i class="glyphicon glyphicon-upload"> </i> Ubah</button>
</form>

<?php
if(isset($_POST['ubah']))
{	
	$tambah = $pecah['stok_barang'] + $_POST["stok"];
		$koneksi->query("UPDATE barang SET kode_barang='$_POST[kode]',nama_barang='$_POST[nama]',harga_barang='$_POST[harga]',stok_barang='$tambah' WHERE id_barang='$_GET[id]'");

	echo "<script>alert('Berhasil Mengubah Barang');</script>";
	echo "<script>location='index.php?halaman=Barang';</script>";
} 
?>