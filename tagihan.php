<?php
$semuadata=array(); 
$dari="-";
$sampai="-";
if (isset($_POST["lihat"]))
{
	$dari = $_POST["dari"];
	$sampai = $_POST["sampai"];
	$ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN karyawan pl ON pm.id_karyawan=pl.id_karyawan WHERE jatuh_tempo BETWEEN '$dari' AND '$sampai' ");
	while ($pecah = $ambil->fetch_assoc())
	{
		$semuadata[] = $pecah;
	}

/*echo "<pre>";
print_r($semuadata);
echo "</pre>";*/
}

 ?>


                <div class="row">
                    <div class="col-md-12">
                     <h2 class="text-center">Tabel Tagihan <i class="fa fa-calendar"> </i> </h2>   
                        <h3 class="text-center"> TRIFTONIC </h3>
                    </div>
                </div>
	<h3>Laporan Tagihan Dari <?php echo $dari ?> Sampai <?php echo $sampai ?></h3>
                 <!-- /. ROW  -->
                 <hr />
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
			<button class="btn btn-success"name="lihat"> <i class="glyphicon glyphicon-eye-open"> </i> Lihat</button>
		</div>
	</div>
</form>
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                             Hasil Pencarian
            				<a href="index.php?halaman=Tagihan" class="btn btn-primary pull-right"> <i class="glyphicon glyphicon-refresh"></i>        Refresh </a><br><br>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th class="text-center">NO</th>
											<th class="text-center">NAMA TOKO</th>
											<th class="text-center"> JATUH TEMPO</th>
											<th class="text-center">NAMA SALES</th>
											<th class="text-center">STATUS PEMBAYARAN</th>
											<th class="text-center">TOTAL CICILAN</th>
											<th class="text-center">OPSI</th>
										</tr>
									</thead>
									<tbody>
										<?php $total=0; ?>
										<?php foreach ($semuadata as $key => $value): ?>
											<?php $total+=$value['total_cicilan'] ?>
											<tr>
												<td><?php echo $key+1; ?></td>
												<td><?php echo $value["nama_toko"] ?></td>
												<td><?php echo $value["jatuh_tempo"] ?></td>
												<td><?php echo $value["nama_karyawan"] ?></td>
												<td><?php echo $value["jenis_pembayaran"] ?></td>
												<td>Rp.<?php echo number_format($value["total_cicilan"]) ?></td>
												<td>
													<?php if ($value["jenis_pembayaran"]=="LUNAS"): ?>
														<a href="index.php?halaman=Riwayat&id=<?php echo $value["id_pembelian"] ?>" class="btn btn-primary" ><i class="fa fa-book"> </i> Riwayat</a>
													<?php else: ?>
														<a href="index.php?halaman=ubahtagihan&id=<?php echo $value["id_pembelian"] ?>" class="btn btn-warning"> <i class="glyphicon glyphicon-edit"> </i> Ubah </a>
													<?php endif ?>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
									<tfoot>
										<tr>
											<th colspan="5">Total Cicilan</th>
											<th>Rp. <?php echo number_format($total) ?></th>
										</tr>
									</tfoot>
									</tbody>
								</table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
   								