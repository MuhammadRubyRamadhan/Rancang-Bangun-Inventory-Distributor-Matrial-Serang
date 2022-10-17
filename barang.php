<?php
$semuadata=array(); 
$ambil =$koneksi->query("SELECT * FROM barang ORDER BY nama_barang ASC");
	while ($pecah = $ambil->fetch_assoc())
	{
		$semuadata[] = $pecah;
	}

/*echo "<pre>";
print_r($semuadata);
echo "</pre>";*/


 ?>
<div class="row">
                    <div class="col-md-12">
                     <h2 class="text-center">Table Hasil Penjualan</h2>   
                        <h3 class="text-center"><i class="glyphicon glyphicon-shopping-cart"></i> TRIFTONIC </h3>
                    </div>
                </div>
                <div class="pull-right">
		<a href="index.php?halaman=tambahproduk" class="btn btn-success btn-lg"> <i class="glyphicon-plus"></i> Tambah 	Data </a>
	</div><br><br>
                 <!-- /. ROW  -->
                 <hr />

               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                             Hasil Pencarian
                             <a href="index.php?halaman=Barang" class="btn btn-primary pull-right"> <i class="glyphicon glyphicon-refresh"> </i> Refresh </a><br><br>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">KODE BARANG</th>
											<th class="text-center">NAMA BARANG</th>
											<th class="text-center">HARGA</th>
											<th class="text-center">STOK</th>
											<th class="text-center">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php $total=0; ?>
										<?php foreach ($semuadata as $key => $value): ?>
											<tr>
												<td class="text-center"><?php echo $key+1; ?></td>
												<td class="text-center"><?php echo $value["kode_barang"] ?></td>
												<td><?php echo $value["nama_barang"] ?></td>
												<td>Rp.<?php echo number_format($value["harga_barang"]) ?></td>
												<td class="text-center"><?php echo $value["stok_barang"] ?></td>
												<td class="text-center">
													<a href="index.php?halaman=hapusproduk&id=<?php echo $value["id_barang"] ?>" class="btn-danger 
											btn"> <i class="glyphicon glyphicon-trash"> </i> Hapus </a>
										<a href="index.php?halaman=ubahproduk&id=<?php echo $value["id_barang"] ?>" class="btn 
											btn-warning"> <i class="glyphicon glyphicon-edit"> </i> Ubah </a>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
									
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
   								