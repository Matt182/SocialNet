<?php
use hive2\models\User;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Members</title>
</head>
<body>
	<ul>
		<li><a id="home" href="/hive2/profile/<?=$globalUser->getId() ?>">Hive2</a></li>
		<li><a id="friends" href="/hive2/profile/<?=$user->getId() ?>/friends">Friends</a></li>
		<li><a id="members" href="/hive2/members">Members</a></li>
		<li><a id="logout" href="/hive2/logout">Log Out</a></li>
	</ul>
  <?php if(empty($empty)) : ?>
    <ul>
      <?php foreach ($members as $member): ?>
          <li><a href="/hive2/profile/<?=$member->getId() ?>"> <?=$member->getFirstName()?> </a></li>
      <?php endforeach ?>
    </ul>
  <?php else : ?>
      <?= $empty ?>
  <?php endif ?>
</body>
</html>
