<?php
use hive2\models\User;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Members</title>
</head>
<body>
    <?php require_once 'navMenu.php'; ?>
    <ul>
    <?php foreach ($members as $member): ?>
          <li><a href="/hive2/profile/<?=$member->getId() ?>"> <?=$member->getFirstName()?> </a></li>
    <?php endforeach ?>
    </ul>
</body>
</html>
