<?php

require_once __DIR__ . '/vendor/autoload.php';
	session_start();
	include'koneksi.php'; 
 					 
 	$ambil =  $koneksi->query("SELECT * FROM pembelian JOIN karyawan ON pembelian.id_karyawan=karyawan.id_karyawan WHERE pembelian.id_pembelian ='$_GET[id]' "); 
 	$pecah = $ambil->fetch_assoc();

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHTMLHeader('
<div style="text-align: right; font-weight: bold;">
  <img src="assets/img/instagram_profile_image.png" width="150px" height="120px"/>
</div>');
$html = '
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/w3.css">
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<script src="assets/js/jquery.js"></script>
	<style type "text/css" media="print">
		body {
			font-size: 14px;
			font-family: Arial;
		}
		table{
			border: solid thin #FFFFFF;
			border-collapse: collapse;
		}
		td{
			padding: 0px 3x;
			border: solid thin #FFFFFF;
			
		}
	</style>
</head>
<body>
	<div style="width: 19cm; height: 27cm;">
 					<h4 style="text-align: center; font-size: 18px; font-weight: bold;">TRIFTONIC</h4>				
 				<table>
					<tr>
						<td>
							<p>	
								<b>Kepada Yth</b>
								<br><b>Nama Toko &emsp;  : '.$pecah["nama_toko"].'</b>
								<br>'.$pecah["alamat_pengiriman"].'
							</p>
						</td>
						<td class="pull-right">
							<p>	
								<b>Faktur</b> <br>
								Tanggal Pembelian &nbsp; : '. $pecah["tanggal_pembelian"].'
								<br>Salesmen &emsp; &emsp; &emsp; &emsp;  : '.$pecah["nama_karyawan"].'
								<br>Jatuh Tempo&emsp; &emsp; &ensp; &nbsp; : '.$pecah["jatuh_tempo"].'
							</p>
						</td>
					</tr>
				</table>
				<br>
				<table class="table table-bordered " >
 	<thead>
 		<tr>
	 		<th class="text-center">Kode Barang&ensp;</th>
	 		<th class="text-center">Nama Barang</th>
	 		<th class="text-center">&ensp;Harga Jual&ensp;</th>
			<th class="text-center">Jumlah</th>
			<th class="text-center">&ensp;Diskon(%)&ensp;</th>
	 		<th class="text-center">Total</th>
 		</tr>
		</thead>
<tbody>';
	 		$tot = 0; 
	 		$diambil = $koneksi->query("SELECT * FROM penjualan WHERE id_pembelian = '$_GET[id]' "); 
	 		foreach ($diambil as $key => $value) { 
	 		$hargaa = $value['total_harga']; 
 $html.='<tr>
 			<td class="text-center">'. $value["kode_barang"] .'</td>
 			<td>'. $value["nama_barang"] .'</td>
 			<td class="text-center">Rp. '. number_format($value["harga"]) .'</td>
 			<td class="text-center">'. $value["jumlah"] .'</td>
 			<td class="text-center">'. $value["diskon"] .'%</td>
 			<td>Rp. '. number_format($hargaa) .'</td>
	 	</tr>';
	 		$tot += $hargaa;
	 		}
$html .=' </tbody>
 		</table>
 		___________________________________________________________________________________________________________
 				<div class="text-right"> Total Pembelian : <b>Rp.'.number_format($tot) .'</b></div> <br>
 						 &emsp; &emsp; &emsp;  &emsp; &emsp;Diterima Oleh :&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;  Hormat Kami,<br><br><br> 
 						 &emsp; &emsp; &emsp; &emsp; &emsp;_______________ &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;   _____________<br>
 					<br>Barang - barang tersebut telah diterima dengan baik dan cukup.

 			</section>
 		</section>
	</div>
 </body>
 </html>';
$mpdf->WriteHTML($html);
$nama_file_pdf =$pecah['nama_toko'].'-'.$pecah['tanggal_pembelian'].'.pdf';
$mpdf->Output($nama_file_pdf,'I');
?>
