<h2>Tambah Produk</h2>
<?php  
	$ambil = $koneksi->query("SELECT id_barang FROM barang ORDER BY barang.id_barang DESC");
	$pecah = $ambil->fetch_assoc();
	
	$id = $pecah['id_barang'];
	/*echo "<pre>";
	print_r($id);
	echo "</pre>";*/
	/*$nourut = $id;
	$nourut++;
	$char = 'KD';
	$kodejadi = $char . sprintf($nourut);
	$rupiah = 'Rp.';*/
?>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kode Barang</label>
		<input type="text" class="form-control" name="kode" placeholder="Masukkan Kode Barang">
		<b><i class="text-danger">*Kode Barang harus seusai Price List !!!</i></b>
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Barang">
	</div>
	<div class="form-group">
		<label>Harga</label>
		<input type="number_format" class="form-control" name="harga" placeholder="Masukkan Harga Barang">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok" placeholder="Masukkan Stok Barang">
		<b><i class="text-danger">*STOK barang harus SATUAN !!!</i></b>
	</div>
	<a href="index.php?halaman=Barang" class="btn btn-warning"> <i class="glyphicon glyphicon-backward"> </i> Kembali </a>&emsp;
		<a href="index.php?halaman=tambahproduk" class="btn btn-primary"> <i class="glyphicon glyphicon-refresh"> </i> Refresh </a>&emsp;
	<button class="btn btn-success" name="save" ><i class="fa fa-share"></i> simpan</button>
</form>
<?php
if (isset($_POST['save'])) 
{
	$koneksi->query("INSERT INTO barang (kode_barang,nama_barang,harga_barang,stok_barang)VALUES ('$_POST[kode]','$_POST[nama]','$_POST[harga]','$_POST[stok]') ");
	echo "<script>alert('Berhasil Menambahkan Barang');</script>";
	echo "<script>location='index.php?halaman=Barang';</script>";
}
?>