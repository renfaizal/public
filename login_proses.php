<?php
	session_start();
	$pengguna = $_POST['pengguna'];
	$kata_kunci = md5($_POST['kata_kunci']);

	$dataValid = "YA";
	if (strlen(trim($pengguna))==0) {
		echo "User harus diisi! <br />";
		$dataValid = "TIDAK";
	}
	if (strlen(trim($kata_kunci))==0) {
		echo "Password harus diisi! <br />";
		$dataValid = "TIDAK";
	}
	if ($dataValid == "TIDAK") {
		echo "Masih ada kesalahan, silahkan periksa kemabli! <br />";
		echo "<input type='button' value='Kembali' onClick='self.history.back()' />";
		exit;
	}
	include 'koneksi3.php';
	$sql = "select * from pengguna where user='".$pengguna."' and password='".$kata_kunci."' limit 1";
	$hasil = mysqli_query($kon, $sql) or die ('Gagal akses! <br />');
	$jumlah = mysqli_num_rows($hasil);
	if ($jumlah > 0) {
		$row = mysqli_fetch_assoc($hasil);
		$_SESSION["user"] = $row["user"];
		$_SESSION["nama_lengkap"] = $row["nama_lengkap"];
		$_SESSION["akses"] = $row["akses"];
		header("Location: index.php");
	} else {
		echo "User atau Password Salah! <br />";
		echo "<input type='button' value='Kembali' onClick='self.history.back()'>";
	}
?>