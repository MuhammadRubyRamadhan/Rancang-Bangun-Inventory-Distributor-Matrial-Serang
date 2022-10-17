<?php
$semuadata=array(); 
$dari="-";
$sampai="-";
if (isset($_POST["lihat"]))
{
	$dari = $_POST["dari"];
	$sampai = $_POST["sampai"];
	$ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN karyawan pl ON pm.id_karyawan=pl.id_karyawan WHERE tanggal_pembelian BETWEEN '$dari' AND '$sampai' ");
	while ($pecah = $ambil->fetch_assoc())
	{
		$semuadata[] = $pecah;
	}

echo "<pre>";
print_r($semuadata);
echo "</pre>";
}

 ?>

<h3>Laporan Penjualan Dari <?php echo $dari ?> Sampai <?php echo $sampai ?></h3>

<form action="" method="post" class="navbar-form navbar-right">
				<input type="text" class="form-control" name="keyboard">
				<button type="submit" name="cari" class="btn btn-primary">Search</button>
			</form>
			<br>
			<br>
<hr>

<form method="post">
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>Dari</label>
				<input type="date" class="form-control" name="dari" value="<?php echo $dari ?>">
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label>Sampai</label>
				<input type="date" class="form-control" name="sampai" value="<?php echo $sampai ?>">
			</div></div>
		<div class="col-md-2">
			<label>&nbsp</label><br>
			<button class="btn btn-primary"name="lihat">Lihat</button>
		</div>
	</div>
</form>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>NAMA TOKO</th>
			<th>Tanggal</th>
			<th>JATUH TEMPO</th>
			<th>NAMA SALES</th>
			<th>Total Penjualan</th>
		</tr>
	</thead>
	<tbody>
		<?php $total=0; ?>
		<?php foreach ($semuadata as $key => $value): ?>
			<?php $total+=$value['total_harga_keseluruhan'] ?>
			<tr>
				<td><?php echo $key+1; ?></td>
				<td><?php echo $value["nama_toko"] ?></td>
				<td><?php echo $value["tanggal_pembelian"] ?></td>
				<td><?php echo $value["jatuh_tempo"] ?></td>
				<td><?php echo $value["nama_karyawan"] ?></td>
				<td><?php echo $value["total_harga_keseluruhan"] ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="5">Total</th>
			<th>Rp. <?php echo number_format($total) ?></th>
		</tr>
	</tfoot>
	</tbody>