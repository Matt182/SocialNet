<?php
session_start();
if (isset($_SESSION['user'])) {
	header('Location:profile.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>HIVE2</title>
</head>
<body>
	<p><?php
	if (isset($_GET['msg'])) {
		echo $_GET['msg'];
	}
	echo $_SERVER["DOCUMENT_ROOT"];
	?></p>
	<form method="post" action="/hive2/src/controll/login/LoginControllerAdapter.php">
		<label for="email">Email</label>
		<input type="email" name="email">
		<label for="password">Password</label>
		<input type="password" name="password">
		<input type="submit" value="login">
	</form>
	<a href="register.php">Register</a>
</body>
</html>