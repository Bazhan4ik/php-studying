<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
</head>
<body>
  <!-- Should I import this in every file? -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style><?php include "./../src/classes/auth/auth.style.css"; ?></style>


  <div class="content">
		<div class="header">
			<div class="back">
				<a href="/" id="go-back">
					<img src="./assets/back.png" alt="">
				</a>
			</div>
			<div class="title">
				<h1>Signup</h1>
			</div>
		</div>
		<form id="login-form">
			<input id="email" class="form-input" type="email" placeholder="Email address">
			<input id="password" class="form-input" type="password" placeholder="Password">
			<input id="password-again" class="form-input" type="password" placeholder="Password again">
		</form>

		<button id="signup-submit">Sign up</button>

    <script> <?php include "./../src/classes/auth/signup.js" ?> </script>

  </div>







  
</body>
</html>