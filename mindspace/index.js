
// function validateLoginForm() {
// 	var name = document.getElementById("uname").value;
// 	var password = document.getElementById("psw").value;

// 	if (name == "" || password == "") {
// 		document.getElementById("errorMsg").innerHTML = "Please fill the required fields"
// 		return false;
// 	}

// 	else if (password.length < 8) {
// 		document.getElementById("errorMsg").innerHTML = "Your password must include atleast 8 characters"
// 		return false;
// 	}
// 	else {
// 		alert("Successfully logged in");
// 		return true;
// 	}
// }
// function validateSignupForm() {
// 	var mail = document.getElementById("email").value;
// 	var name = document.getElementById("uname").value;
// 	var password = document.getElementById("psw").value;

// 	if (mail == "" || name == "" || password == "") {
// 		document.getElementById("errorMsg").innerHTML = "Please fill the required fields"
// 		return false;
// 	}

// 	else if (password.length < 8) {
// 		document.getElementById("errorMsg").innerHTML = "Your password must include atleast 8 characters"
// 		return false;
// 	}
// 	else {
// 		alert("Successfully signed up");
// 		return true;
// 	}
// }
// function signup(){

// }
// function login(){
    
// }

//Login form
const form = document.querySelector("form");
eField = form.querySelector(".email"),
eInput = eField.querySelector("input"),
pField = form.querySelector(".password"),
pInput = pField.querySelector("input");

form.onsubmit = (e)=>{
  e.preventDefault(); 
  (eInput.value == "") ? eField.classList.add("shake", "error") : checkEmail();
  (pInput.value == "") ? pField.classList.add("shake", "error") : checkPass();

  setTimeout(()=>{ 
    eField.classList.remove("shake");
    pField.classList.remove("shake");
  }, 500);

  eInput.onkeyup = ()=>{checkEmail();} 
  pInput.onkeyup = ()=>{checkPass();} 

  function checkEmail(){ 
    let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/; 
    if(!eInput.value.match(pattern)){ 
      eField.classList.add("error");
      eField.classList.remove("valid");
      let errorTxt = eField.querySelector(".error-txt");
      
      (eInput.value != "") ? errorTxt.innerText = "Enter a valid email address" : errorTxt.innerText = "Email can't be blank";
    }else{ 
      eField.classList.remove("error");
      eField.classList.add("valid");
    }
  }

  function checkPass(){ 
    let pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if(!pInput.value.match(pattern)){ 
      pField.classList.add("error");
      pField.classList.remove("valid");
      let errorTxt = pField.querySelector(".error-txt");
      
      (pInput.value != "") ? errorTxt.innerText = "must contain 8 characters, atleast one number, one uppercase letter and one lowercase letter" : errorTxt.innerText = "Password can't be blank";
    }else{ 
      pField.classList.remove("error");
      pField.classList.add("valid");
    }
  }

  if(!eField.classList.contains("error") && !pField.classList.contains("error")){
    window.location.href = form.getAttribute("action"); 
  }
}

//Register form
const form = document.getElementById('form');
const name = document.getElementById('name');
const email = document.getElementById('email');
const password = document.getElementById('password');
const confirm = document.getElementById('confirm');

form.addEventListener('submit', e => {
    e.preventDefault();

    checkInputs();
});

function checkInputs() {
    // trim to remove the whitespaces
    const nameValue = name.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const confirmValue = confirm.value.trim();

    if (nameValue === '') {
        setErrorFor(name, 'Please enter your name');
    } else {
        setSuccessFor(name);
    }

    if (emailValue === '') {
        setErrorFor(email, 'Please enter your email');
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Email not valid');
    } else {
        setSuccessFor(email);
    }

    if (passwordValue === '') {
        setErrorFor(password, 'Please enter password');
    } else if (!isPassword(passwordValue)) {
        setErrorFor(password, 'atleast one number, one uppercase, lowercase letter, and atleast 8 character');
    }else {
        setSuccessFor(password);
    }

    if (confirmValue === '') {
        setErrorFor(confirm, 'Please re-enter password');
    } else if (!isConfirm(confirmValue)) {
        setErrorFor(confirm, 'Invalid password');
    }else if (passwordValue !== confirmValue) {
        setErrorFor(confirm, 'Passwords does not match');
    } else {
        setSuccessFor(confirm);
    }
}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.className = 'form-control error';
    small.innerText = message;
}

function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function isPassword(password){  
    return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/.test(password);
}

function isConfirm(confirm){  
    return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/.test(password);
}

