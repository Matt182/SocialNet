<!DOCTYPE html>
<html>
<head>
	<title>HIVE2</title>
    <link rel="stylesheet" href="/hive2/src/views/style/normalize.css">
    <link rel="stylesheet" href="/hive2/src/views/style/common.css">
    <link rel="stylesheet" href="/hive2/src/views/style/login.css">
</head>
<body>
    <div class="wrapper">

        	<form method="post" action="authorize">
                <p>
                	<?php if (!empty($error)) : ?>
                		<p class="error"><?= $error?></p>
                	<?php endif ?>
                </p>
        		<label for="email">Email</label>
        		<input id="email" type="email" name="email">
        		<label for="password">Password</label>
        		<input id="password" type="password" name="password">
                <div class="buttons">
                    <button type="submit" value="login">Login</button>
                    <a href="register">Register</a>
                </div>
        	</form>

    </div>

</body>
</html>
