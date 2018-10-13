<?php 

session_start();

if ( isset($_SESSION["Login"])) {
	header("Location: Dashboard");
	exit;
}


$color='white';

require 'Function/function.php';

if (isset($_POST["SignIn"])) {
	
	$email = $_POST["Email"];
	$password = $_POST["Password"];

	$hasil = mysqli_query($MyConn, "SELECT * FROM user_data WHERE email = '$email' ");

	// Cek Username
	if (mysqli_num_rows($hasil)===1) {
		
		// Cek Password
		$row = mysqli_fetch_assoc($hasil);
		if ( password_verify($password, $row["password"])) {
			// Set Login Session
			$_SESSION["Login"] = true;

			header("Location: Dashboard/index.php");
			exit;
		};
	}

	$error = true;

	if (isset($error)) {
		$color ='red';
	}
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>GoodJob - Hire Local Workers and Find Local Jobs</title>
	<link rel="stylesheet" type="text/css" href="Assets/Style/index.css">
	<link rel="shortcut icon" href="Assets/Images/icon.png">
</head>
<body>

<div class="container">
	<div class="topbar">
		<ul class="data">
			<span class="data-input">
			<li><a href="Pages/register.php" class="register">REGISTER</a></li>
			<li>



				<a href="#login-input" class="login">SIGN IN</a>
				<div class="login-overlay" id="login-input">

					<form action="" method="post">
						<a href="#" name="Close"><img src="Assets/Images/close.png"></a>
						<h1 style="color: #ed5f3c;;">USER LOG IN</h1>
						<br><br>

						<input type="text" name="Email" placeholder="Email" class="login-textbox">
						<br><br><br>

						<input type="password" name="Password" placeholder="Password" class="login-textbox">
						<br><br>

						<input type="checkbox" name="remember">
						<label for="remember" class="remember-label">Remember Me.</label>

						<input type="submit" name="SignIn" value="Sign In">

						<p style="color: <?php echo "$color"; ?>; text-align: center;font-family: calibri;">Email or Password is invalid!</p>
						<br>
						<hr>

						<span class="login-footer-action">
							<table>
								<tr>
									<td><a href="#">Forgotten Password</a></td>
									<td><a href="Pages/register.php">Create an Account</a></td>
								</tr>
							</table>
						</span>

					</form>

				</div>




			</li>
			</span>
		</ul>
		<ul class="info">
			<li><a href="Pages/about.html">ABOUT</a></li>
			<li><a href="Pages/contact.html">CONTACT US</a></li>
			<li><a href="Pages/team.html">OUR TEAM</a></li>
			<li><a href="Pages/how.html">HOW IT WORKS?</a></li>
		</ul>
	</div>
	<div class="clear"></div>
</div>

<div class="content">
	<div class="logo">
		<img src="Assets/Images/logo.png">
	</div>
	<hr style="width: 70%; margin-top: -30px;">
	<div class="tagline">
		<h1>Hire Local Workers And Find Local Jobs</h1>
	</div>
	<div class="action">
		<ul>
			<li id="post"><a href="#login-input">Post a Job</a></li>
			<li id="find"><a href="#login-input">Find a Job</a></li>
		</ul>
	</div>
</div>




</body>
</html>