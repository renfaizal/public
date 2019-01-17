<?php
	$namacust = $_POST['namacust'];
	$email = $_POST['email'];
	$notelp = $_POST['notelp'];
	$tanggal = date("Y-m-d");
	$barang_pilih = '';
	$qty = 1;

	$dataValid = "YA";
	if (strlen(trim($namacust)) == 0) {
		echo "Nama Harus Diisi.... <br />";
		$dataValid = "TIDAK";
	}
	if (strlen(trim($notelp)) == 0) {
		echo "No. Telp Harus Diisi...<br />";
		$dataValid = "TIDAK";
	}
	if (isset($_COOKIE['keranjang'])) {
		$barang_pilih = $_COOKIE['keranjang'];
	} else {
		echo "Keranjang Belanja Kosong..<br />";
		$dataValid = "TIDAK";
	}
	if ($dataValid == "TIDAK") {
		echo "Masih ada kesalahan, silakan perbaiki <br />";
		echo "<input type='buttonn' value='KEMBALI' onClick='self.history.back()' />";

		exit;
	}

	include "koneksi3.php";
	$simpan = true;
	$mulai_transaksi = mysqli_begin_transaction($kon);

	$sql = "insert into hjual(tanggal, namacust, email, notelp)
			values('$tanggal', '$namacust', '$email', '$notelp')";
			
	$hasil = mysqli_query($kon, $sql);
	if (!$hasil) {
		echo "Data Customer Gagal Simpan <br />";
		$simpan = false;
	}

	$idhjual = mysqli_insert_id($kon);
	if ($idhjual == 0) {
		echo "Data Customer Tidak Ada <br />";
		$simpan = false;
	}

	$barang_array = explode(",", $barang_pilih);
	$jumlah = count($barang_array);

	if ($jumlah <= 1) {
		echo "Tidak ada barang yang dipilih <br />";
		$simpan = false;
	} else {
		foreach ($barang_array as $idBarang) {
			if ($idBarang == 0) {
				continue;
			}
			$sql = "select * from barang where idBarang = $idBarang";
			$hasil = mysqli_query($kon, $sql);
			if (!$hasil) {
				echo "Barang tidak ada <br />";
				$simpan = false;
				break;
			} else {
				$row = mysqli_fetch_assoc($hasil);
				$stok = $row['stok'] - 1;

				if ($stok < 0) {
					echo "Stok barang ".$row['stok']." kosong <br />";
					$simpan = false;
					break;
				}
				$harga = $row['harga'];
			}
			$sql = "insert into djual (idHjual, idBarang, qty, harga)
					values('$idhjual', '$idBarang', $qty, $harga)";
			$hasil = mysqli_query($kon, $sql);
			if (!$hasil) {
				echo "Detail jual gagal disimpan";
				$simpan = $false;
				break;
			}
			$sql = "update barang set stok = $stok where idBarang = $idBarang";
			$hasil = mysqli_query($kon, $sql);
			if (!$hasil) {
				echo "Update stok barang gagal";
				$simpan = false;
				break;
			}
		}
	}

	if ($simpan) {
		$komit = mysqli_commit($kon);
	} else {
		$rollback = mysqli_rollback($kon);
		echo "Pembelian gagal <br /> <input type='button' value='Kembali' onClick='self.history.back()' />";
		exit;
	}

	header("Location: bukti_beli.php?idhjual=".$idhjual);
	setcookie('keranjang', $barang_pilih, time()-3600);
?>