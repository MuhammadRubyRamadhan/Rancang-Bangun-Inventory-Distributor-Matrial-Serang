<h2 align="center"> T R I F T O N I C </h2>
<br>
<h3>Data Karyawan</h3>
<hr>	
<div class="pull-right">
	<a href="index.php?halaman=tambahkaryawan" class="btn btn-success btn-lg"> <i class="glyphicon-plus"></i> Tambah Data </a>
</div>
<table class="table table-bordered">
	<thead>
		<tr>
			<th class="text-center"> NO </th>
			<th class="text-center"> KODE KARYAWAN </th>
			<th class="text-center"> NAMA KARYAWAN </th>
			<th class="text-center"> NOMOR HANDPHONE </th>
			<th class="text-center">OPSI</th>
	</thead>
	<tbody>
		<?php $nomer=1; ?>
		<?php $ambil =$koneksi->query("SELECT * FROM karyawan WHERE id_karyawan"); ?>
		<?php while($pecah= $ambil->fetch_assoc()){ ?>
		<tr>
			<td class="text-center"> <?php echo $nomer; ?></td>
			<td class="text-center"> <?php echo $pecah['kode_karyawan']; ?></td>
			<td> <?php echo $pecah['nama_lengkap']; ?></td>
			<td class="text-center"> <?php echo $pecah['no_hp']; ?></td>
			<td>
				<a href="index.php?halaman=hapusKaryawan&id=<?php echo $pecah['id_karyawan']; ?>" class="btn-danger 
					btn"> <i class="glyphicon glyphicon-trash"> </i> Hapus </a>
				<a href="index.php?halaman=ubahKaryawan&id=<?php echo $pecah['id_karyawan']; ?>" class="btn 
					btn-warning"> <i class="glyphicon glyphicon-edit"> </i> Ubah </a>
			</td>
		</tr>
		<?php $nomer++; ?>
		<?php } ?>
	</tbody>
</table>