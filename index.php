<?php
	require_once '_include/site_modules/head.php';
	require_once '_include/site_modules/body.php';
	require_once '_include/site_modules/class.php';
	require_once '_include/library/functions.php';
	show_head();
	sec_session_start();
	if(isset($_SESSION["fail"]))
	{
		echo '<script>alert("Username and(or) Password is incorrect"); </script>';
	}
?>

<body>
<?php
	show_header();
?>

<div id="container">
	<div id="content">
	<form method="post" action="loginproc.php">
			<center>
				<div class="margin_bottom_40"></div>
				<fieldset style="width: 300px; ">
					<center>
						<label style="color: black ;font-size: 19px;"><b>Login:</b></label>
						<div class="margin_bottom_20"></div>
						<label style="color: black"><b>Username:</b></label>
						<input type="text" name="username" id = "username" size="20" tabindex="1">
						<div class="margin_bottom_20"></div>
						<label style="color: black"><b>Password:</b></label>
						<input type="password" name="password" id = "password" size="20" tabindex="2">
						<div class="margin_bottom_20"></div>
						<input type="hidden" name="login_form" id = "login_form" value="1"/>
						<input class="ui red button" name="submit" id="submit" value="Login" type="submit" tabindex="3">
					</center>		
				</fieldset> 
			</center>
		</form>
	</div>
</div>

</body>