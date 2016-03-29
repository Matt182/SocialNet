<?php
use hive2\models\User;
use hive2\controll\DBActions;

require_once '../../vendor/autoload.php';
require_once '../config/config.php';

session_start();

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	header('Location:index.php?msg=You need to authorize');
}

$person = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_STRING);

if ($person == $user->getId() || $person == "") {
	$guest = false;
} else {
	$guest = true;
}
if($guest) {
	$db = new DBActions();
	$row = $db->getById($person);
	$user = new User($row['id'], $row['firstName'],$row['email'], $row['password'], $row['resume']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile <?=$user->getFirstName()?></title>
</head>
<body>
	<ul>
		<li><a href="profile.php">Hive2</a></li>
		<li><a href="#">Friends</a></li>
		<li><a href="#">Members</a></li>
		<li><a href="/hive2/src/controll/logout.php">Log Out</a></li>
	</ul>
	<div>Picture</div>
	<div><?=$user->getFirstName()?></div>
	<div>
		<?php
			if ($user->isOnline()) {
				echo "online";
			} else {
				echo "offline";
			}
		?>
	</div>
</body>
</html>