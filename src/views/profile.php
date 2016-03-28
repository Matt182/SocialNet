<?php
require_once '../models/User.php';
session_start();

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	header('Location:index.php?msg=You need to authorize');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>
<?= $user->getFirstName() ?>
<a href="/hive2/src/controll/logout.php">Log Out</a>
</body>
</html>