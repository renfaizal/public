<?php
	session_start();
	if (!isset($_SESSION["user"])) {
		echo "Sesi sudah habis <br /> <a href='login_form.php'>LOGIN LAGI</a>";
		exit;
	}

	echo "<table border='1' width='100%'>";
		echo "<tr>";
			if ($_SESSION["user"] == "cust") {
				echo "<td>Nav1<td>";
				echo "<td>Nav2<td>";
				echo "<td>Nav3<td>";

			}
			echo "<td></td>";
			if ($_SESSION["user"] == "admin") {
				echo "<td>Nav4<td>";
			}
			echo "<td><a href='logout.php'>Logout</a></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>";
				echo "<ul>";
					if ($_SESSION["user"] == "admin") {
						echo "<li>Link 1</li>";
						echo "<li>Link 2</li>";
					}
					if ($_SESSION["user"] == "cust") {
						echo "<li>Link 3</li>";
						echo "<li>Link 4</li>";
						echo "<li>Link 5</li>";
						echo "<li>Link 6</li>";
						echo "<li>Link 7</li>";
					}
				echo "</ul>";				
			echo "</td>";
			echo "<td colspan='7' width='70%' >";
				if ($_SESSION["user"] == "admin") {
					echo "KONTEN 1 <hr /><br />";
					echo "KONTEN 2 <hr /><br />";
					echo "KONTEN 7 <hr /><br />";
				}
				if ($_SESSION["user"] == "cust") {
					echo "KONTEN 3 <hr /><br />";
					echo "KONTEN 4 <hr /><br />";
					echo "KONTEN 5 <hr /><br />";
					echo "KONTEN 6 <hr /><br />";
				}
			echo "</td>";
		echo "</tr>";
	echo "</table>";
?>
