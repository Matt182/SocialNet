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
	<form method="post" action="/hive2/src/controll/checkUser.php">
		<label for="name">Name</label>
		<input type="text" name="firstName">
		<label for="password">Password</label>
		<input type="password" name="password">
		<input type="submit" value="login">
	</form>
	<a href="register.php">Register</a>
</body>
</html>