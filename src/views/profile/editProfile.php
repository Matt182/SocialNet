<?php
use hive2\models\User;
require_once 'head.php';
require_once 'sidebar.php';?>
<link rel="stylesheet" href="/src/views/js/Croppie-2.1.0/croppie.css" />
<link rel="stylesheet" href="/src/views/style/editStyle.css">
<div class="fakeBg">

</div>
<div id="content">
    <form method="post" action="/profile/saveEdits/<?=$globalUser->getId()?>">
        <div class="preview-form">
            <div class="avatar-preview">
                <label>Preview</label>
                <div id="avatar"><img width="250px" name='picture' id="picture" src="<?= $avatarName ?>"></div>
                <input type="file" id="input" >
                <input type="hidden" id="hiddenSrc" name="src" value="" />
            </div>
            <div class="buttons-preview">
                <label>Name</label>
                <input type="text" name="firstName" value="<?=$globalUser->getFirstName()?>">
                <label>Resume</label>
                <textarea name="resume" value="<?=$globalUser->getResume()?>"></textarea>
                <button type="submit" value="save">save</button>
            </div>
        </div>
    </form>
</div>
<div id="dialog">
    <div class="dialog-inner">
        <div class="demo">
        </div>
        <div class="dialog-buttons">
            <button type="button" name="cancel" onclick="cancel()">Cancel</button>
            <button type="button" name="save" onclick="save()">Save</button>
        </div>
    </div>
</div>

<script
src="https://code.jquery.com/jquery-2.2.4.js"
integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
crossorigin="anonymous"></script>
<script src="/src/views/js/Croppie-2.1.0/croppie.js"></script>
<script src="/src/views/js/scripts.js"></script>
</body>
</html>
