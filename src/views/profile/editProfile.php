<?php
use hive2\models\User;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit <?=$user->getFirstName()?></title>
    <?php include_once 'head.php'; ?>
    <link rel="stylesheet" href="/hive2/src/views/js/Croppie-2.1.1/croppie.css" />
    <link rel="stylesheet" href="/hive2/src/views/style/style.css" />

</head>
<body>
    <div id="sidebar">
        <div id="menu">
            <?php include_once 'navMenu.php'; ?>
        </div>
    </div>
    <div id="content">
        <form method="post" action="/hive2/profile/0/saveEdits">
            <div>

                <div id="avatar"><img name='picture' id="picture" src="/hive2/src/views/profile/avatars/default.jpg"></div>
                <input type="file" id="input" >
                <input type="hidden" id="hiddenSrc" name="src" value="" />
                <input type="text" name="firstName" placeholder="<?=$user->getFirstName()?>">
            </div>
            <div>
                <div>
                    online
                </div>
                <div>
                    <textarea name="resume" placeholder="<?=$user->getResume()?>"></textarea>
                    <button type="submit" value="save">save</button>
                </div>
            </div>
        </form>
    </div>
    <div id="dialog">
        <div class="demo">
        </div>
        <button type="button" name="cancel" onclick="cancel()">Cancel</button>
        <button type="button" name="save" onclick="save()">Save</button>
    </div>

    <script src="/hive2/src/views/js/Croppie-2.1.0/croppie.js"></script>
    <script src="/hive2/src/views/js/scripts.js"></script>
</body>
</html>
