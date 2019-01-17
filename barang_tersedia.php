<?php
include_once 'template_atas.php';
	$barang_pilih = 0;

	if (isset($_COOKIE['keranjang'])) {
		$barang_pilih = $_COOKIE['keranjang'];
	}
	if (isset($_GET['idBarang'])) {
		$idBarang = $_GET['idBarang'];
		$barang_pilih = $barang_pilih.",".$idBarang;
		setcookie('keranjang',$barang_pilih, time()+3600);
	}

	include "koneksi3.php";

	$sql = "select * from barang where idBarang not in (".$barang_pilih.") and stok > 0 order by idBarang desc";

	$hasil = mysqli_query($kon, $sql);
	if (!$hasil) 
		die("Gagal query..".mysqli_error($kon));
?>
<h2>DAFTAR BARANG TERSEDIA</h2>

<table border="1">
	<tr>
		<th>Foto</th>
		<th>Nama Barang</th>
		<th>Harga Jual</th>
		<th>Stock</th>
		<th>Operasi</th>
	</tr>
	<?php
		$no = 0;
		while ($row = mysqli_fetch_assoc($hasil)) {
			echo "<tr>";
			echo "<td><a href='pict/{$row['foto']}'>
			<img src='thumb/{$row['foto']}' width='100' /> 
			</a> </td>";
			echo "<td>".$row['nama']."</td>";
			echo "<td>".$row['harga']."</td>";
			echo "<td>".$row['stok']."</td>";
			echo "<td>";
				echo "<a href='".$_SERVER['PHP_SELF']."?idBarang=".$row['idBarang']."'>BELI</a>";
			echo "</td>";
			echo "</tr>";
		}
	?>
</table>
<?php include_once 'template_bawah.php'; ?>