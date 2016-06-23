<?php
use hive2\models\User;
require_once 'head.php';
?>

<body>
    <?php require_once 'sidebar.php';?>
    <div class="fakeBg">
        <?php if(empty($noFriends)) : ?>
            <ul>
                <?php foreach ($members as $member): ?>
                    <li><a href="/profile/<?=$member->getId() ?>"> <?=$member->getFirstName()?> </a></li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <?= $noFriends ?>
        <?php endif; ?>
        <hr>
        <?php foreach ($requests as $req): ?>
            <li><a href="/profile/<?=$req->getId() ?>"> <?=$req->getFirstName()?> </a>
                <a href="/profile/confirmFriendRequest/<?=$req->getId() ?>">Confirm request</a>
            </li>
        <?php endforeach; ?>
    </body>
    </html>
