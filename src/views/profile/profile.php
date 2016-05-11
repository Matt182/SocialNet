<?php
use hive2\models\User;

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile <?=$user->getFirstName()?></title>
</head>
<body>
		<?php include_once 'navMenu.php'; ?>
	<div>Picture</div>
	<div><?=$user->getFirstName()?></div>
	<div><?=$user->getEmail()?></div>
	<div>
		<?php
			if ($user->isOnline()) {
				echo "online";
			} else {
				echo "was online: {$user->wasOnline()}";
			}
		?>
		<hr>
    <?php if ($guest) :
      switch ($guest) {
        case 1: ?>
          <p>Your friend</p>
        <?php break;

        case 2: ?>
          <p>Friend request sended</p>
        <?php break;

        case 3: ?>
          <p><a href = '<?= $user->getId() ?>/confirmFriendReq'>Confirm requst</a></p>
        <?php break;

        case 4: ?>
          <p><a href = '<?= $user->getId() ?>/sendFriendReq'>Send requst</a></p>
        <?php break;
      }
    else: ?>
    <form method="post" action="postRecord">
      <textarea type="text" name="content" id="content"></textarea>
      <button type="submit" >post</button>
    </form>
  <?php endif; ?>
    <?php foreach ($records as $record): ?>
        <li> <?= $record->getContent() ?> </li>
    <?php endforeach; ?>
	</div>
</body>
</html>
