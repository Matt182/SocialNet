<?php
use hive2\models\User;

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile <?=$user->getFirstName()?></title>
  <?php include_once 'head.php'; ?>
</head>
<body>
<div class="container">
  <div class="col-md-4">

  	<div><img src="/hive2/src/views/profile/avatars/default.jpg"></div>

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
    endif ?>

  	<div><?=$user->getFirstName()?></div>
    <div><?php if(!$guest):?> <a href="<?= $user->getId() ?>/edit">Edit profile</a> <?php endif ?></div>
    <?php include_once 'navMenu.php'; ?>
  </div>
  <div class="col-md-8">
    <div class="row">
    	<?php
    		if ($user->isOnline()) {
    			echo "online";
    		} else {
    			echo "was online: {$user->wasOnline()}";
    		}
    	?>
    </div>
    <div class="row">
      <?=$user->getResume()?>
    </div>
  	<hr>
    <div class="row">
      <form method="post" action="/hive2/profile/<?= $user->getId() ?>/postRecord">
        <textarea type="text" name="content" id="content"></textarea>
        <button type="submit" >post</button>
      </form>
    </div>

      <?php foreach ($records as $record): ?>
          <div class="row">
            <b><?=$record->getAuthorName()?></b> <?= $record->getCreated()?><br>
            <?= $record->getContent() ?><br>
            <span><3</span><?= $record->getLikes() ?><br>
            <?php foreach ($record->getComments() as $comm): ?>
              <div class="row">
                <b><?=$comm->getAuthorName()?></b> <?= $comm->getCreated()?><br>
                <?= $comm->getContent() ?>
              </div>
            <?php endforeach; ?>
            <form method="post" action="/hive2/profile/<?= $user->getId() ?>/<?= $record->getId() ?>/addComment">
              <input type="text" name="comment" id="comment" />
              <button type="submit" value="comm">Comment</button>
            </form>
          </div>
      <?php endforeach; ?>
  	</div>
  </div>
</body>
</html>
