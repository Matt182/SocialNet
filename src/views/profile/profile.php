<?php
use hive2\models\User;
require_once 'head.php';
?>
<body>
    <?php require_once 'sidebar.php';?>
    <div class="fakeBg">

    </div>

    <div id="content">
        <div class="content-header">
            <div id="online">
                <span>
                    <?php
                    if ($user->isOnline()) {
                        echo "online";
                    } else {
                        echo "was online: {$user->wasOnline()}";
                    }
                    ?>
                </span>
            </div>
            <div class="resume">
                <div class="resume-header">
                    Resume
                </div>
                <div class="resume-body">
                    <p>
                        <?=$user->getResume()?>
                    </p>
                </div>
            </div>
            <div class="post">
                <form name="postRecord">
                    <div class="post-area">
                        <textarea name="content" placeholder="post record..."></textarea>
                        <button type="button" onclick="ajaxrecord(<?= $user->getId() ?>)">post</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="records">
            <?php include_once 'records.php';?>
        </div>
    </div>
    <script src="/src/views/js/ajaxrecords.js"></script>
</body>
</html>
