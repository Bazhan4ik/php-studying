for(let el of document.getElementsByClassName("form-input")) {
  el.addEventListener("change", event => {
    event.target.classList.remove("required-error")
  });
}
	

const emailRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;


document.getElementById("signup-submit").addEventListener("click", event => {

  const el = {
    email: document.getElementById("email"),
    password: document.getElementById("password"),
    password2: document.getElementById("password-again"),
  };



  if(!el.email.value || !el.password.value || !el.password2.value) {
    if(!el.email.value) {
      el.email.classList.add("required-error");
    }
    if(!el.password.value) {
      el.password.classList.add("required-error");
    }
    if(!el.password2.value) {
      el.password2.classList.add("required-error");
    }
    return;
  }
  if(!emailRegex.test(el.email.value)) {
    el.email.classList.add("required-error");
    return;
  } else {
    el.email.classList.remove("required-error");
  }
  if(el.password.value != el.password2.value) {
    el.password.classList.add("required-error");
    el.password2.classList.add("required-error");
    return;
  }



  $.ajax({
    url: "/signup",
    type: "POST",
    data: {
      email: el.email.value,
      password: el.password.value,
      hello: "true;"
    },
    success: onSuccess,
  });
});


function onSuccess(data) {
  const result = JSON.parse(data);
  if(result.success) {
    window.location.href = "/auth";
  } else {
    if(result.error == "email") {
      document.getElementById("email").classList.add("required-error"); 
    }
    console.log(result.error);
  }
}