<?php  
$koneksi->query("DELETE FROM barang WHERE id_barang='$_GET[id]' ");

echo "<script>alert('Produk Terhapus');</script>";
echo "<script>location='index.php?halaman=Barang';</script>";
?>