<?php
session_start();
include 'koneksi.php';
$id_barang =$_GET["id"];
$ambil=$koneksi->query("SELECT * FROM pengeluaran WHERE id_pengeluaran='$id_barang' ");
$pecah=$ambil->fetch_assoc();
$id_baarang = $pecah['id_barang'];
$diambil = $koneksi->query("SELECT * FROM pengeluaran JOIN barang ON pengeluaran.id_barang=barang.id_barang WHERE pengeluaran.id_barang = '$id_baarang' ");
$cek = $diambil->fetch_assoc();
/*echo "<pre>";
print_r($cek);
echo "</pre>";*/
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
	<section class="konten">
		<div class="container">
			<center><h4 style="color:blue"><b>Beranda Belanja <i class="glyphicon glyphicon-shopping-cart"></i></b></h4></center>
		</div>
		<hr>
		<div class="alert alert-info container">
			<div class="scroll">
		<form method="post">
					<label class="col-lg-3 control-label">Id Barang</label>
					<input type="text" name="idb" class="form-control" readonly value="<?php echo $pecah['id_barang'] ?>" >
				<div class="form-group">
					<label class="col-lg-3 control-label">Kode Barang</label>
					<input type="text" name="kode" class="form-control" readonly value="<?php echo $pecah['kode_barang'] ?>" >
				<div class="form-group">
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Nama</label>
					<input type="text" name="nama" class="form-control" readonly value="<?php echo $pecah['nama_barang'] ?>" >
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label" >Harga (Rp)</label>
					<input type="number" step="any" name="harga" id="harga" class="form-control" readonly value="<?php echo $cek['harga_barang'] ?>" >
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Jumlah (Stok Ready = <?php echo $cek['stok_barang'] ?>)</label>
					<input type="number" step="any" min="0" max="<?php echo $cek['stok_barang'] ?>" name="jumlah" id="jumlah" class="form-control" placeholder="0" value="" autofocus="">
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Diskon (%)</label>
					<input type="number" step="any" min="0" name="diskon" id="diskon" class="form-control" placeholder="0" value="" >
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Total</label>
					<input type="number" step="any" min="0" name="total" id="total" class="form-control" readonly value="0" >
				</div>  
				<div class="form-group">
					<label class="col-lg-3 control-label">Potongan</label>
					<input type="number" step="any" min="0" name="potongan" id="potongan" class="form-control" readonly value="0" >
				</div>  <div class="form-group">
					<label class="col-lg-3 control-label">SubTotal</label>
					<input type="number" step="any" min="0" name="subtotal" id="subtotal" class="form-control" readonly value="0" >
				</div> 
		<a href="checkout.php" class="btn btn-warning"> <i class="glyphicon glyphicon-backward"> </i> Kembali </a>&emsp; 
		<button class="btn btn-primary" name="save" ><i class="fa fa-share"></i> simpan </button>
			</form>
			</div>
		</div>
		<?php
			if (isset($_POST["save"])) 

				{
					$akun = $ambil->fetch_assoc();
					$_SESSION["pengeluaran"] = $akun;
				$koneksi->query("UPDATE pengeluaran SET id_barang='$_POST[idb]',kode_barang='$_POST[kode]',nama_barang='$_POST[nama]',jumlah='$_POST[jumlah]',diskon='$_POST[diskon]',harga_barang='$_POST[subtotal]' WHERE id_pengeluaran='$_GET[id]'");
				echo "<script>alert('sudah di masukkan');</script>";
				echo "<script>location='checkout.php'; </script>";
				}
				
				?>
	</section>
	</section>
</body>
</html>
<script type="text/javascript">
 $("#jumlah").keyup(function(){
 total = $("#jumlah").val()* $("#harga").val();
 $("#total").val(total);
 });

 $("#diskon").keyup(function(){
 total1 = $("#total").val()* $("#diskon").val()/100;
 $("#potongan").val(total1);
 });

 $("#diskon").keyup(function(){
 total1 = $("#total").val()- $("#potongan").val();
 $("#subtotal").val(total1);
 });
</script>

