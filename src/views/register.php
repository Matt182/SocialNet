<!DOCTYPE html>
<html>
<head>
	<title>register</title>
    <link rel="stylesheet" href="/src/views/style/normalize.css">
    <link rel="stylesheet" href="/src/views/style/common.css">
    <link rel="stylesheet" href="/src/views/style/login.css">
</head>
<body>
    <div class="wrapper">

    	<form method="post" action="registrate">
            <p>
        		<?php if (!empty($error)) : ?>
        			<p class="error"><?= $error?></p>
        		<?php endif ?>
        	</p>
            <label for="firstName">Name</label>
    		<input type="text" name="firstName">
            <label for="email">Email</label>
    		<input type="email" name="email">
            <label for="password">Password</label>
    		<input type="password" name="password">
            <div class="buttons">
                <button type="submit">Sign up</button>
            </div>
    	</form>
    </div>
</body>
</html>
