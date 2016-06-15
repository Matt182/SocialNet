<ul id="nav">
  <li><a id="home" href="/profile/<?=$globalUser->getId() ?>">Hive2</a></li>
  <li><a id="friends" href="/profile/friends/<?=$user->getId() ?>">Friends <?= $friendReqNotify ?></a></li>
  <li><a id="peoples" href="/members">Members</a></li>
  <li><a id="logout" href="/logout">Log Out</a></li>
</ul>
