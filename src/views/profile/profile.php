<?php
use hive2\models\User;
use hive2\controll\DBActions;


$user = $_SESSION['user'];

$person = $id;

if ($person == $user->getId() || $person == "") {
	$guest = false;
} else {
	$guest = true;
}
if($guest) {
	$db = new DBActions();
	$row = $db->getById($person);
	$user = new User($row['id'], $row['firstName'],$row['email'], "123", $row['resume'], $row['online']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile <?=$user->getFirstName()?></title>
</head>
<body>
	<ul>
		<li><a href="profile">Hive2</a></li>
		<li><a href="#">Friends</a></li>
		<li><a href="#">Members</a></li>
		<li><a href="profile/logout">Log Out</a></li>
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
