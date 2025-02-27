<!DOCTYPE html>

<html>
<head>
  <title>Login</title>
</head>


<body>
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
				<h1>Login</h1>
			</div>
		</div>
		<form id="login-form">
			<input id="email" class="form-input" type="email" placeholder="Email address">
			<input id="password" class="form-input" type="password" placeholder="password">
		</form>

		<button id="login-btn">Login</button>
    
    <a href="/auth?signup=1">Don't have an account?</a>
  </div>


	<script>
    <?php include "../src/classes/auth/login.js" ?>
	</script>
</body>
</html>