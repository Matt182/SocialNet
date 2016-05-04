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
    <li><a id="home" href="/hive2/profile/<?=$globalUser->getId() ?>">Hive2</a></li>
  	<li><a id="friends" href="/hive2/profile/<?=$user->getId() ?>/friends">Friends</a></li>
  	<li><a id="members" href="/hive2/members">Members</a></li>
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
		<?php if ($guest && !in_array($user->getId(), $globalUser->getFriends())) : ?>
			<a href="<?=$user->getId()?>/addToFriends">Add to friends</a>
		<?php elseif($guest) : ?>
      <p>Your friend</p>
    <?php endif?>
	</div>
</body>
</html>
