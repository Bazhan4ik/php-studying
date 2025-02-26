<!DOCTYPE html>

<html>
<head>
	<link rel="icon" type="image/png" href="/favicon.png"/>
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

  </div>

	<script>
		// document.getElementById("autism").addEventListener("click", e => {
		// 	console.log("HOEHOUTSTHOESNTU");
		// });

		for(let el of document.getElementsByClassName("form-input")) {
			el.addEventListener("change", event => {
				event.target.classList.remove("required-error")
			});
		}
		
		document.getElementById("login-btn").addEventListener("click", event => {
			const email = document.getElementById("email").value;
			const password = document.getElementById("password").value;

      if(!email || !password) {
        if(!email) {
          document.getElementById("email").classList.add("required-error");
        }
        if(!password) {
          document.getElementById("password").classList.add("required-error");
        }
        return;
      }

			$.ajax({
				url: "/login",
				type: "POST",
				data: {
					email, password,
				},
				success: loginRequestSuccess
			});

		});


		function loginRequestSuccess(data) {
			console.log(data);
		}
	</script>
</body>
</html>