<?php
	session_start();
	if (!isset($_SESSION["user"])) {
		echo "Sesi sudah habis <br /> <a href='login_form.php'>LOGIN LAGI</a>";
		exit;
	}
	echo "SELAMAT DATANG <br />";
	echo "USER: ".$_SESSION["user"]."<br />";
	echo "NAMA: ".$_SESSION["nama_lengkap"]."<br />";
?>
<hr />
<div id="menu">
	<h2>LINK</h2>
	<a href="halaman_1.php">Halaman 1</a><br />
	<a href="halaman_2.php">Halaman 2</a><br />
	<a href="logout.php">Logout</a><br />
</div>