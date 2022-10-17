<?php  
	$semuadata=array();
	$id_pembelian = $_GET['id'];
//ambil nama toko dari database pembelian
$aambil = $koneksi->query("SELECT * FROM  pembelian WHERE id_pembelian='$id_pembelian' ");
$ppecah = $aambil->fetch_assoc();
//ambil data cicilan
	$ambil = $koneksi->query("SELECT * FROM  pembelian JOIN cicilan ON pembelian.id_pembelian=cicilan.id_pembelian WHERE pembelian.id_pembelian = $id_pembelian ");
	while ($pecah = $ambil->fetch_assoc())
	{
		$semuadata[] = $pecah;
	}
$namatoko = $ppecah['nama_toko'];
/*echo "<pre>";
print_r($semuadata);
echo "</pre>";*/
?>
<div class="row">
	<div class="col-md-5">
				<a href="index.php?halaman=Tagihan" class="btn btn-warning"> <i class="glyphicon glyphicon-backward"> </i> Kembali </a><br><br>
				<h4><b>Riwayat Tagihan Toko :</b> <?php echo $namatoko ?></h4>
		<table class="table">
			<?php foreach ($semuadata as $key => $value): ?>
			<tr>
				<th>Tanggal Pembayaran</th>
				<td><b>:</b> <?php echo $value['tanggal'] ?></td>
			</tr>
			<tr>
				<th>Terbayar</th>
				<td><b>:</b>  Rp.<?php echo number_format($value['bayar']) ?></td>
			</tr>
			<tr>
				<th>Status </th>
				<td><b>:</b> <?php echo $value['jenis_pembayaran'] ?></td>
			</tr>
			<tr>
				<th>Sisa Tagihan</th>
				<td><b>:</b>  Rp.<?php echo number_format($value['total_sisa_cicilan']) ?><hr></td>
			</tr>
			<?php endforeach ?>
		</table>
	</div>
</div>