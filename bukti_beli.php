<?php include_once 'template_atas.php'; ?>
<style type="text/css">
	@media print{
		#tombol {
			display: none;
		}
	}
</style>
<div id="tombol">
	<input type="button" value="Beli Lagi" onClick="window.location.assign('barang_tersedia.php')">
	<input type="button" value="Print" onClick="window.print()" >
</div>

<?php
	$idhjual = $_GET["idhjual"];
	include "koneksi3.php";
	$sqlhjual = "select * from hjual where idHjual = $idhjual";
	$hasilhjual = mysqli_query($kon, $sqlhjual);
	$rowhjual = mysqli_fetch_assoc($hasilhjual);

	echo "<pre>";
		echo "<h2>Bukti Pembelian</h2>";
		echo "No. Nota : ".date("Ymd").$rowhjual['idHjual']."<br />";
		echo "Tanggal : ".$rowhjual['tanggal']."<br />";
		echo "Nama : ".$rowhjual['namacust']."<br />";

		$sqldjual = "select barang.nama, djual.harga, djual.qty, (djual.harga * djual.qty) as jumlah from djual inner join barang on djual.idBarang = barang.idBarang where djual.idHjual = $idhjual";
		$hasildjual = mysqli_query($kon, $sqldjual);
		echo "<table border='1' cellpading='10' cellspacing='0'>";
			echo "<tr>";
				echo "<th>Nama Barang</th>";
				echo "<th>Quantity</th>";
				echo "<th>Harga</th>";
				echo "<th>Jumlah</th>";
			echo "</tr>";

			$totalharga = 0;
			while ($rowdjual = mysqli_fetch_assoc($hasildjual)) {
				echo "<tr>";
				echo "<td>".$rowdjual['nama']."</td>";
				echo "<td align='right'>".$rowdjual['qty']."</td>";
				echo "<td align='right'>".$rowdjual['harga']."</td>";
				echo "<td align='right'>".$rowdjual['jumlah']."</td>";
				echo "</tr>";
				$totalharga = $totalharga + $rowdjual['jumlah'];
			}
			echo "<tr>";
				echo "<td colspan='3' align='right'>";
				echo "<strong>Total Jumlah</strong></td>";
				echo "<td align='right'><strong>$totalharga</strong></td>";
			echo "</tr>";
		echo "</table>";
	echo "</pre>";
include_once 'template_bawah.php';
?>