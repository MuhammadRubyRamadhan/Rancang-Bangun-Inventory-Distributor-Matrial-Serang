<?php  
$ambil = $koneksi->query("SELECT id_karyawan FROM karyawan ORDER BY karyawan.id_karyawan DESC");
	$pecah = $ambil->fetch_assoc();
	
	$id = $pecah['id_karyawan'];

$nourut = $id;
	$nourut++;
	$char = 'K00';
	$kodejadi = $char . sprintf($nourut);
?>
<h2 align="center"> T R I F T O N I C </h2>
<br>
<h3>Tambah Karyawan</h3>
<hr>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kode Karyawan</label>
		<input type="text" class="form-control" name="kode" readonly value="<?php echo($kodejadi) ?>">
	</div>
	<div class="form-group">
		<label>Nama Lengkap Karyawan</label>
		<input type="text" class="form-control" name="namalengkap" placeholder="Masukkan Nama Lengkap Karyawan">
	</div>
	<div class="form-group">
		<label>Nama Panggilan Karyawan</label>
		<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Panggilan Karyawan">
	</div>
	<div class="form-group">
		<label>Nomor Handphone Karyawan</label>
		<input type="text" class="form-control" name="hp" placeholder="Masukkan Nomor Handphone Karyawan">
	</div>
	<a href="index.php?halaman=Karyawan" class="btn btn-warning"> <i class="glyphicon glyphicon-backward"> </i> Kembali </a>&emsp;
		<a href="index.php?halaman=tambahkaryawan" class="btn btn-primary"> <i class="glyphicon glyphicon-refresh"> </i> Refresh </a>&emsp;
	<button class="btn btn-primary" name="save" ><i class="fa fa-share"></i> simpan</button>
</form>
<?php
if (isset($_POST['save'])) 
{
	$koneksi->query("INSERT INTO karyawan (kode_karyawan,nama_lengkap,nama_karyawan,no_hp)VALUES ('$_POST[kode]','$_POST[namalengkap]','$_POST[nama]','$_POST[hp]' ) ");
	echo "<script>alert('Berhasil Menambahkan Karyawan');</script>";
	echo "<script>location='index.php?halaman=Karyawan';</script>";
}
?>