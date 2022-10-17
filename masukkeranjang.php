<?php
session_start();
include 'koneksi.php';

$id_barang =$_GET["id"];
	$ambil=$koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang' ");
$pecah=$ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<title>CV. Triftonic Eka Fivesoon</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link href="assets/css/bootstrap.css" rel="stylesheet">
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
				<div class="form-group">
					<label class="col-lg-3 control-label">Kode Barang</label>
					<input type="text" name="kode" class="form-control" readonly value="<?php echo $pecah['kode_barang'] ?>" >
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Nama</label>
					<input type="text" name="nama" class="form-control" readonly value="<?php echo $pecah['nama_barang'] ?>" >
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Stok Barang</label>
					<input type="text" name="stok" class="form-control" readonly value="<?php echo $pecah['stok_barang'] ?>" >
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label" >Harga (Rp)</label>
					<input type="number" step="any" name="harga" id="harga" class="form-control" readonly value="<?php echo $pecah['harga_barang'] ?>" >
				</div>  
			<a href="index.php" class="btn btn-warning"> <i class="glyphicon glyphicon-backward"> </i> Kembali </a>&emsp;
		<button class="btn btn-primary" name="save" ><i class="glyphicon glyphicon-check"></i> OK</button>
			</form>
			</div>
		</div>
		<?php
			if (isset($_POST["save"])) 

				{
				$koneksi->query("INSERT INTO pengeluaran (id_barang,kode_barang,nama_barang,harga_barang)VALUES ('$id_barang','$_POST[kode]','$_POST[nama]','$_POST[harga]') ");
				echo "<script>alert('Sudah di masukkan');</script>";
				echo "<script>location='keranjang.php'; </script>";
				}else{
					$_SESSION['keranjang'][$id_barang]=1;
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

