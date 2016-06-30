<?php
use hive2\models\User;
require_once 'head.php';
?>
    <body>
        <?php require_once 'sidebar.php';?>
        <div class="fakeBg">
            <ul>
                <?php foreach ($members as $member): ?>
                    <li><a href="/profile/<?=$member->getId() ?>"> <?=$member->getFirstName()?> </a></li>
                <?php endforeach ?>
            </ul>
        </div>
    </body>
</html>
