<?php include_once 'template_atas.php'; ?>
<h2>LOGIN</h2>
<form method="post" action="login_proses.php">
	<table border="0">
		<tr>
			<td>USER</td>
			<td><input type="text" name="pengguna" /></td>
		</tr>
		<tr>
			<td>PASSWORD</td>
			<td><input type="password" name="kata_kunci" /></td>
		</tr>
		<tr>
			<td colspan="2" ><input type="submit" value="LOGIN" /></td>
		</tr>
	</table>
</form>
<?php include_once 'template_bawah.php'; ?>