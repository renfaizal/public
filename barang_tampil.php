<?php
include_once 'template_atas.php';
	$nama_barang = "";
	if (isset($_POST['nama_barang'])) 
		$nama_barang = $_POST['nama_barang'];


	include "koneksi3.php";
	//praktik 1
	//$sql = "select * from barang";
	
	//praktik 2
	//$sql = "select * from barang order by idbarang desc";
	
	//praktik 4
	$sql = "select * from barang where nama like'%".$nama_barang."' order by idbarang desc";

	$hasil = mysqli_query($kon, $sql);
	if (!$hasil) 
		die("Gagal query..".mysqli_error($kon));
?>
<a href="barang_isi.php">INPUT BARANG</a>
&nbsp; &nbsp; &nbsp;
<a href="barang_cari.php">CARI BARANG</a>
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
				echo "<a href='barang_edit.php?idBarang=".$row['idBarang']."'>EDIT</a>";
				echo "&nbsp; &nbsp;";
				echo "<a href='barang_hapus.php?idBarang=".$row['idBarang']."'>HAPUS</a>";
			echo "</td>";
			echo "</tr>";
		}
	?>
</table>
<?php include_once 'template_bawah.php'; ?>