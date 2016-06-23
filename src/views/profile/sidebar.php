<div id="sidebar">
  <div id="menu">
    <div id="name">
      <h2><?=$user->getFirstName()?></h2>
    </div>
    <div id="avatar"><img src="<?= $avatarName ?>"></div>

     <p><?php if ($guest) :
            switch ($guest) {
            case 1: ?>
              Your friend
                <?php break;

            case 2: ?>
              Friend request sended
                <?php break;

            case 3: ?>
              <a href = 'confirmFriendRequest/<?= $user->getId() ?>'>Confirm requst</a>
                <?php break;

            case 4: ?>
              <a href = 'sendFriendRequest/<?= $user->getId() ?>'>Send requst</a>
                <?php break;

            default:
                break;
            }
    endif ?></p>

     <p><?php if(!$guest) :?> <a href="/profile/edit/<?= $user->getId() ?>">Edit profile</a> <?php
    endif ?></p>
     <div id="nav"><?php require_once 'navMenu.php'; ?></div>
  </div>
</div>
