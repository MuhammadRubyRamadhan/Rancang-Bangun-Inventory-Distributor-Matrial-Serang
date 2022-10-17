<h1>Ubah Tagihan</h1>
<?php  
	$id_pembelian = $_GET['id'];

	$ambil = $koneksi->query("SELECT * FROM  pembelian JOIN karyawan ON pembelian.id_karyawan=karyawan.id_karyawan WHERE pembelian.id_pembelian = $id_pembelian ");
	$pecah = $ambil->fetch_assoc();
	/*echo "<pre>";
	print_r($pecah);
	echo "</pre>";*/
?>
<div class="row">
	<div class="col-md-5">
		<table class="table">
			<tr>
				<th>Nama Toko</th>
				<td><?php echo $pecah['nama_toko'] ?></td>
			</tr>
			<tr>
				<th>Jatuh Tempo</th>
				<td><?php echo $pecah['jatuh_tempo'] ?></td>
			</tr>
			<tr>
				<th>Tagihan</th>
				<td>Rp.<?php echo $pecah['total_harga_keseluruhan'] ?></td>
			</tr>
			<tr>
				<th>Sisa Tagihan</th>
				<td><?php echo $pecah['total_cicilan'] ?></td>
			</tr>
		</table>
	</div>
</div>
	
<form method="post">
	<div class="form-group">
		<label class="control-label">&ensp; Sisa Cicilan (Rp)</label>
		<input type="number" step="any" name="cicilan" id="cicilan" class="form-control" readonly value="<?php echo $pecah['total_cicilan'] ?>" >
	</div>
	<div class="form-group">
		<label class="control-label">&ensp; Dibayarkan (Cicilan = Rp.<?php echo number_format($pecah['total_cicilan'])?>)<i class="text-danger">*Pastikan nominal DICEK ULANG 3x !!!</i></label>
		<input type="number" step="any" min="1" max="<?php echo $pecah['total_cicilan'] ?>" name="bayar" id="bayar" class="form-control" placeholder="0" value="" >

	</div>
	<div class="form-group">
		<label class="control-label">&ensp; Sisa Cicilan</label>
		<input type="number" step="any" min="0" name="total" id="total" class="form-control" readonly value="0"  >
	</div>
	<div class="form-group">
		<label class="control-label">&ensp;Update Pembayaran</label>
		<select class="form-control" name="status">
			<option value=""><?php echo $pecah['jenis_pembayaran'] ?></option>
			<option value="Angsuran Ke - 1">Angsuran Ke - 1</option>
			<option value="Angsuran Ke - 2">Angsuran Ke - 2</option>
			<option value="Angsuran Ke - 3">Angsuran Ke - 3</option>
			<option value="Angsuran Ke - 4">Angsuran Ke - 4</option>
			<option value="Angsuran Ke - 5">Angsuran Ke - 5</option>
			<option value="Angsuran Ke - 6">Angsuran Ke - 6</option>
			<option value="Angsuran Ke - 7">Angsuran Ke - 7</option>
			<option value="Angsuran Ke - 8">Angsuran Ke - 8</option>
			<option value="Angsuran Ke - 9">Angsuran Ke - 9</option>
			<option value="Angsuran Ke - 10">Angsuran Ke - 10</option>
			<option value="Angsuran Ke - 11">Angsuran Ke - 11</option>
			<option value="Angsuran Ke - 12">Angsuran Ke - 12</option>
			<option value="Angsuran Ke - 13">Angsuran Ke - 13</option>
			<option value="Angsuran Ke - 14">Angsuran Ke - 14</option>
			<option value="Angsuran Ke - 15">Angsuran Ke - 15</option>
			<option value="Angsuran Ke - 16">Angsuran Ke - 16</option>
			<option value="Angsuran Ke - 17">Angsuran Ke - 17</option>
			<option value="Angsuran Ke - 18">Angsuran Ke - 18</option>
			<option value="Angsuran Ke - 19">Angsuran Ke - 19</option>
			<option value="Angsuran Ke - 20">Angsuran Ke - 20</option>
			<option value="Angsuran Ke - 21">Angsuran Ke - 21</option>
			<option value="Angsuran Ke - 22">Angsuran Ke - 22</option>
			<option value="Angsuran Ke - 23">Angsuran Ke - 23</option>
			<option value="Angsuran Ke - 24">Angsuran Ke - 24</option>
			<option value="Angsuran Ke - 25">Angsuran Ke - 25</option>
			<option value="LUNAS">Lunas</option>
		</select>
	</div>
	<a href="index.php?halaman=Tagihan" class="btn btn-warning"> <i class="glyphicon glyphicon-backward"> </i> Kembali </a>&emsp;
	<a href="index.php?halaman=ubahtagihan&id=<?php echo $id_pembelian ?>" class="btn btn-primary"> <i class="glyphicon glyphicon-refresh"> </i>Refresh </a>&emsp;
	<button class="btn btn-success" name="proses"> <i class="glyphicon glyphicon-upload"> </i> Update</button>
</form>

<?php 
if (isset($_POST["proses"])) 
{
	$tgl = date("Y-m-d");
	$dibayar = $_POST["bayar"];
	$status = $_POST["status"];
	$total_cicilan = $_POST["total"];
	//simpan ke pembelian
	$koneksi->query("UPDATE pembelian SET jenis_pembayaran='$status',total_cicilan='$total_cicilan' WHERE id_pembelian='$id_pembelian' ");
	//simpan ke riwayat cicilan
	$koneksi->query("INSERT INTO cicilan (id_pembelian,bayar,tanggal,jenis_pembayaran,total_sisa_cicilan)VALUES ('$id_pembelian','$dibayar','$tgl','$status','$total_cicilan') ");
	echo "<script>alert('Data Di Update');</script>";
    echo "<script>location='index.php?halaman=Tagihan'; </script>";
}
 ?>
 <script type="text/javascript">
 $("#bayar").keyup(function(){
 total = $("#cicilan").val() - $("#bayar").val();
 $("#total").val(total);
 });
</script>








