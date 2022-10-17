<?php  
$koneksi->query("DELETE FROM karyawan WHERE id_karyawan='$_GET[id]' ");

echo "<script>alert('Data Berhasil Dihapus Karyawan');</script>";
echo "<script>location='index.php?halaman=Karyawan';</script>";
?>