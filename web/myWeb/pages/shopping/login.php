<!DOCTYPE html>
<html>
<head>
	<?php include 'header.php';
			include 'menu.php';
	?>
</head>
<body>
	<div>
		<h1>Login Page</h1>
		<br>
		<form action="<?php echo $baseDir . "home.php" ?> method="post">
			<label for="userName">User Name: </label>
				<input id="userName" type="text" name="userName">
			<br>
			<br>
			<label for="password">Password: </label>
				<input id="password" type="text" name="password">
			<br>
			<br>
			<button type="submit" name="lgin" value="Login"> Login </button>
			<button type="submit" name="lout" value="Logout"> Log out </button>
		</form>
	</div>
</body>
</html>