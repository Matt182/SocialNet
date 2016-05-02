<?php
use hive2\models\User;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Members</title>
</head>
<body>
  <?php if(empty($empty)) : ?>
    <ul>
      <?php foreach ($members as $member): ?>
          <li><?=$member->getFirstName()?></li>
      <?php endforeach ?>
    </ul>
  <?php else : ?>
      <?= $empty ?>
  <?php endif ?>
</body>
</html>
