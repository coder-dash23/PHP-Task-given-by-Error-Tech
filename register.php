<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
	<title>Registration Page</title>
	<style>
		<?php include "style.css" ?>
	</style>
</head>

<body>
	<div class="header">
		<h1>Register</h1>
	</div>

	<form method="post" action="register.php" id="form1">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Full Name</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
	</form>
	
</body>

</html>