<?php
include_once 'template_atas.php';
	$idBarang = $_GET['idBarang'];

	include "koneksi3.php";

	$sql = "select * from barang where idBarang = '$idBarang'";
	$hasil = mysqli_query($kon, $sql);
	if (!$hasil) die ("Gagal query");

	$data = mysqli_fetch_array($hasil);
	$nama = $data['nama'];
	$harga = $data['harga'];
	$stok = $data['stok'];
	$foto = $data['foto'];

	echo "<h2>Konfirmasi Hapus</h2>";
	echo "Nama Barang: ".$nama."<br />";
	echo "Harga Barang: ".$harga."<br />";
	echo "Stok: ".$stok."<br />";
	echo "Foto: <img src='thumb/".$foto."' /><br />";
	echo "APAKAH DATA INI AKAN DIHAPUS? <br />";
	echo "<a href='barang_hapus.php?idBarang=$idBarang&hapus=1'>YA</a>";
	echo "&nbsp;&nbsp;";
	echo "<a href='barang_tampil.php'>TIDAK</a><br /><br />";

	if (isset($_GET['hapus'])) {
		$sql = "delete from barang where idBarang = '$idBarang'";
		$hasil = mysqli_query($kon, $sql);
		if (!$hasil) {
			echo "Gagal Hapus Barang : $nama ..<br />";
			echo "<a href='barang_tampil.php'>Kembali ke Daftar Barang</a>";
		} else {
			$gbr = "pict/$foto";
			if (file_exists($gbr)) unlink($gbr);
			$gbr = "thumb/t_$foto";
			if (file_exists($gbr)) unlink ($gbr);
			header('location:barang_tampil.php'); 
		}
	}
include_once 'template_bawah.php'; 
?>