<?php
use hive2\models\User;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profile <?=$user->getFirstName()?></title>
    <?php require_once 'head.php'; ?>
  </head>
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
                <form method="post" action="/hive2/profile/<?= $user->getId() ?>/postRecord">
                    <div class="post-area">
                        <textarea name="content" placeholder="post record..."></textarea>
                        <button type="submit" >post</button>
                    </div>
                </form>
            </div>
        </div>


            <?php foreach ($records as $record): ?>
              <div class="record">
                  <div class="record-header"><h3><?=$record->getAuthorName()?></h3><span><?= $record->getCreated()?></span></div>
                    <div class="record-body">
                      <p>
                        <?= $record->getContent() ?>
                      </p>
                    </div>
                    <div class="record-footer">
                        <?php foreach ($record->getComments() as $comm): ?>
                            <div class="comment">
                                <div class="comment-header">
                                  <h4><?=$comm->getAuthorName()?></h4><span><?= $comm->getCreated()?></span>
                                </div>
                                <div class="comment-body">
                                        <?= $comm->getContent() ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="comment-add">
                            <form method="post" action="/hive2/profile/<?= $user->getId() ?>/<?= $record->getId() ?>/addComment">
                              <div>
                                <input type="text" name="comment" id="comment" placeholder="Comment...">
                                <span>
                                  <button type="submit">Comment</button>
                                </span>
                              </div>
                            </form>
                        </div>
                    </div>
              </div>
            <?php endforeach; ?>

    </div>
  </body>
</html>
