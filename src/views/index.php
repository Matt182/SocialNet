<!DOCTYPE html>
<html>
<head>
	<title>HIVE2</title>
</head>
<body>
<p>
	<?php if (!empty($error)) : ?>
		<p class="error"><?= $error?></p>
	<?php endif ?>
</p>
	<form method="post" action="authorize">
		<label for="email">Email</label>
		<input id="email" type="email" name="email">
		<label for="password">Password</label>
		<input id="password" type="password" name="password">
		<input type="submit" value="login">
	</form>
	<a href="register">Register</a>
</body>
</html>
