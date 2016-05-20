<?php
use hive2\models\User;

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit <?=$user->getFirstName()?></title>
  <?php include_once 'head.php'; ?>
</head>
<body>
<div class="container">
  <?php include_once 'navMenu.php'; ?>
  <form>
    <div class="col-md-3">

  	   <div><img src="/hive2/src/views/profile/avatars/default.jpg"></div>
       <input type="file">
  	    <input type="text" placeholder="<?=$user->getFirstName()?>">
    </div>
    <div class="col-md-9">
    <div class="row">
    	online
    </div>
    <div class="row">
      <textarea name="resume" placeholder="<?=$user->getResume()?>"></textarea>
      <button type="submit" value="save">save</button>
    </div>
    </div>
  </form>
  </div>
</body>
</html>
