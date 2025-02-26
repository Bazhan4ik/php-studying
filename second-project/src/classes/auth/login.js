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
  const response = JSON.parse(data);
  if(response.success) {
    window.location.href = "/posts";
  }
}