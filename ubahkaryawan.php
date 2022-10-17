<h2 align="center"> T R I F T O N I C </h2>
<br>
<h3>Ubah Data Karyawan</h3>
<hr>
<?php
$id = $_GET['id'];
//menampilkan produk
$ambil=$koneksi->query("SELECT * FROM karyawan WHERE id_karyawan='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();

?>

<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Id Karyawan</label>
			<input type="text" name="id" class="form-control" readonly value="<?php echo $pecah['id_karyawan']; ?>" >
		</div>
		<div class="form-group">
			<label>Kode Karyawan</label>
			<input type="text" name="kode" class="form-control" readonly value="<?php echo $pecah['kode_karyawan']; ?>" >
		</div>
		<div class="form-group">
			<label>Nama Lengkap Karyawan</label>
			<input type="text" name="namalengkap" class="form-control" value="<?php echo $pecah['nama_lengkap']; ?>" >
		</div>
		<div class="form-group">
			<label>Nama Panggilan Karyawan</label>
			<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_karyawan']; ?>" >
		</div>
		<div class="form-group">
			<label>Nomor Handphone Karyawan</label>
			<input type="text" name="hp" class="form-control" value="<?php echo $pecah['no_hp']; ?>" >
		</div>
		<a href="index.php?halaman=Karyawan" class="btn btn-warning"> <i class="glyphicon glyphicon-backward"> </i> Kembali </a>&emsp;
		<a href="index.php?halaman=ubahKaryawan&id=<?php echo $id ?>" class="btn btn-primary"> <i class="glyphicon glyphicon-refresh"> </i> Refresh </a>&emsp;
		<button class="btn btn-primary" name="ubah"> <i class="glyphicon glyphicon-edit"> </i> Simpan </button>
</form>

<?php
if(isset($_POST['ubah']))
{	
		$koneksi->query("UPDATE karyawan SET kode_karyawan='$_POST[kode]',nama_lengkap='$_POST[namalengkap]' ,nama_karyawan='$_POST[nama]',no_hp='$_POST[hp]' WHERE id_karyawan='$_GET[id]'");

	echo "<script>alert('Data Berhasil Diubah Karyawan');</script>";
	echo "<script>location='index.php?halaman=Karyawan';</script>";
}
?>