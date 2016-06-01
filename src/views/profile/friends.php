<?php
use hive2\models\User;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Members</title>
</head>
<body>
    <?php require_once 'sidebar.php';?>
    <div class="fakeBg">
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
