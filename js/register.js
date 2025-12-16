const signUpButton = document.getElementById("signUp");
const signInButton = document.getElementById("signIn");
const container = document.getElementById("container");
signUpButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

signInButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});

const name_regex = /^[A-Za-z]+$/;
const email_regex =
  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

document.querySelector(".sign-up-container form").addEventListener(
  "submit",
  function (e) {
    e.preventDefault();

    const firstName = document.getElementById("inputFirstName").value.trim();
    const firstNameInput = document.getElementById("inputFirstName");

    const lastName = document.getElementById("inputLastName").value.trim();
    const lastNameInput = document.getElementById("inputLastName");
    const email = document.getElementById("signupEmail").value.trim();
    const emailInput = document.getElementById("signupEmail");
    const password = document.getElementById("signupPassword").value;
    const passwordInput = document.getElementById("signupPassword");

    const resultDiv = document.getElementById("result");
    const resultP = document.getElementById("result-p");
    resultDiv.style.color = "red";
    resultP.innerText = "";

    if (!firstName) {
      resultP.innerText = "Enter First Name*";
      resultDiv.style.visibility = "visible";
      firstNameInput.style.border = "1px solid red";

      return false;
    } else if (!name_regex.test(firstName)) {
      resultP.innerText = "First Name must contain only letters*";
      resultDiv.style.visibility = "visible";
      firstNameInput.style.border = "1px solid red";

      return false;
    }

    if (!lastName) {
      resultP.innerText = "Enter Last Name*";
      resultDiv.style.visibility = "visible";
      lastNameInput.style.border = "1px solid red";
      firstNameInput.style.border = "none";

      return false;
    } else if (!name_regex.test(lastName)) {
      resultP.innerText = "Last Name must contain only letters*";
      resultDiv.style.visibility = "visible";
      lastNameInput.style.border = "1px solid red";
      firstNameInput.style.border = "none";

      return false;
    }

    if (!email) {
      resultP.innerText = "Enter Email*";
      resultDiv.style.visibility = "visible";
      emailInput.style.border = "1px solid red";
      lastNameInput.style.border = "none";

      return false;
    } else if (!email_regex.test(email)) {
      resultP.innerText = "Enter a valid Email*";
      resultDiv.style.visibility = "visible";
      emailInput.style.border = "1px solid red";
      lastNameInput.style.border = "none";

      return false;
    }

    if (!password) {
      resultP.innerText = "Enter Password*";
      resultDiv.style.visibility = "visible";
      passwordInput.style.border = "1px solid red";
      emailInput.style.border = "none";

      return false;
    } else if (password.length < 6) {
      resultP.innerText = "Password must be at least 6 characters*";
      resultDiv.style.visibility = "visible";
      passwordInput.style.border = "1px solid red";
      emailInput.style.border = "none";
      return false;
    }

    resultP.innerText = "Registration successful!";
    resultDiv.style.color = "green";
    resultDiv.style.visibility = "visible";
    passwordInput.style.border = "none";

    container.classList.remove("right-panel-active");
    resultDiv.style.visibility = "hidden";
    document.getElementById("inputFirstName").value = "";
    document.getElementById("inputLastName").value = "";
    document.getElementById("signupEmail").value = "";
    document.getElementById("signupPassword").value = "";
  },
  1500
);
document
  .querySelector(".sign-in-container form.signin-form")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.getElementById("signinEmail").value.trim();
    const emailInput = document.getElementById("signinEmail");
    const password = document.getElementById("signinPassword").value.trim();
    const passwordInput = document.getElementById("signinPassword");
    const signinResultDiv = document.getElementById("signin-result");
    const signinResultP = document.getElementById("signin-result-p");

    signinResultP.innerText = "";
    signinResultDiv.style.color = "red";
    signinResultDiv.style.visibility = "visible";

    if (!email) {
      signinResultP.innerText = "Enter Email*";
      emailInput.style.border = "1px solid red";

      return false;
    }

    if (!password) {
      signinResultP.innerText = "Enter Password*";
      passwordInput.style.border = "1px solid red";
      emailInput.style.border = "none";

      return false;
    }

    signinResultDiv.style.visibility = "hidden";
    document.getElementById("signinEmail").value = "";
    document.getElementById("signinPassword").value = "";
    window.location.href = "home.html";
  });
