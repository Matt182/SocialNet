<?php
use hive2\models\User;

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile <?=$user->getFirstName()?></title>
</head>
<body>
	<ul>
		<li><a href="">Hive2</a></li>
		<li><a href="<?=$user->getId() ?>/friends">Friends</a></li>
		<li><a href="/hive2/members">Members</a></li>
		<li><a id="logout" href="/hive2/logout">Log Out</a></li>
	</ul>
	<div>Picture</div>
	<div><?=$user->getFirstName()?></div>
	<div><?=$user->getEmail()?></div>
	<div>
		<?php
			if ($user->isOnline()) {
				echo "online";
			} else {
				echo "offline";
			}
		?>
		<hr>
		<?php if ($guest) : ?>
			<a href="<?=$user->getId()?>/addToFriends">Add to friends</a>
		<?php endif ?>
	</div>
</body>
</html>
