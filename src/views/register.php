<!DOCTYPE html>
<html>
<head>
	<title>register</title>
</head>
<body>
	<p>
		<?php if (!empty($error)) : ?>
			<p class="error"><?= $error?></p>
		<?php endif ?>
	</p>
	<form method="post" action="registrate">
		Name<input type="text" name="firstName">
		Email<input type="email" name="email">
		Password<input type="password" name="password">
		<input type="submit" value="sign up">
	</form>
</body>
</html>
