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
				echo "offline";
			}
		?>
		<hr>
    <?php if ($guest) : ?>
      <?= $friendInfo ?>
    <?php endif?>
	</div>
</body>
</html>
