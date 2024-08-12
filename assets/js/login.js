const signUpButton = document.getElementById("show_sign_up");
const signInButton = document.getElementById("show_sign_in");
const signInForm = document.getElementById("sign_form");
const signUpForm = document.getElementById("sign_up_form");

signUpButton.addEventListener('click', function() {
  signInForm.style.display = "none";
  signUpForm.style.display = "block";
});

signInButton.addEventListener('click', function() {
  signUpForm.style.display = "none";
  signInForm.style.display = "block";
});

