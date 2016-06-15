<?php use function hive2\controll\profile\getAvatar; ?>
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
                    <img class="comment-avatar" src="<?= getAvatar($comm->getAuthorId()) ?>"  />
                    <div class="comment-content">
                        <div class="comment-header">
                            <h4><?=$comm->getAuthorName()?></h4><span><?= $comm->getCreated()?></span>
                        </div>
                        <div class="comment-body">
                            <?= $comm->getContent() ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="comment-add">
                <form method="post" action="/profile/addComment/<?= $user->getId() ?>/<?= $record->getId() ?>">
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
