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
		<li><a id="friends" href="/hive2/profile/<?=$user->getId() ?>/friends">Friends<?php if (!empty($globalUser->getReqFrom())) : ?>
                                                                                    <span> !!! </span>
                                                                                  <?php endif; ?></a></li>
		<li><a id="members" href="/hive2/members">Members</a></li>
		<li><a id="logout" href="/hive2/logout">Log Out</a></li>
	</ul>
  <?php if(empty($noFriends)) : ?>
    <ul>
      <?php foreach ($members as $member): ?>
          <li><a href="/hive2/profile/<?=$member->getId() ?>"> <?=$member->getFirstName()?> </a></li>
      <?php endforeach; ?>
    </ul>
  <?php else : ?>
      <?= $noFriends ?>
  <?php endif; ?>
	<hr>
		<?php foreach ($requests as $req): ?>
			<li><a href="/hive2/profile/<?=$req->getId() ?>"> <?=$req->getFirstName()?> </a>
				<a href="/hive2/profile/<?=$req->getId() ?>/confirmFriendReq">Confirm request</a>
			</li>
		<?php endforeach; ?>
</body>
</html>
