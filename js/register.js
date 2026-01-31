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
document
  .querySelector(".sign-up-container form")
  .addEventListener("submit", function (e) {
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

    let hasError = false;
    if (!firstName) {
      resultP.innerText = "Enter First Name*";
      resultDiv.style.visibility = "visible";
      firstNameInput.style.border = "1px solid red";
      lastNameInput.style.border = "none";
      emailInput.style.border = "none";
      passwordInput.style.border = "none";
      hasError = true;
    } else if (!name_regex.test(firstName)) {
      resultP.innerText = "First Name must contain only letters*";
      resultDiv.style.visibility = "visible";
      firstNameInput.style.border = "1px solid red";
      lastNameInput.style.border = "none";
      emailInput.style.border = "none";
      passwordInput.style.border = "none";
      hasError = true;
    }

    if (!hasError) {
      if (!lastName) {
        resultP.innerText = "Enter Last Name*";
        resultDiv.style.visibility = "visible";
        lastNameInput.style.border = "1px solid red";
        firstNameInput.style.border = "none";
        emailInput.style.border = "none";
        passwordInput.style.border = "none";
        hasError = true;
      } else if (!name_regex.test(lastName)) {
        resultP.innerText = "Last Name must contain only letters*";
        resultDiv.style.visibility = "visible";
        lastNameInput.style.border = "1px solid red";
        firstNameInput.style.border = "none";
        emailInput.style.border = "none";
        passwordInput.style.border = "none";
        hasError = true;
      }
    }

    if (!hasError) {
      if (!email) {
        resultP.innerText = "Enter Email*";
        resultDiv.style.visibility = "visible";
        emailInput.style.border = "1px solid red";
        firstNameInput.style.border = "none";
        lastNameInput.style.border = "none";
        passwordInput.style.border = "none";
        hasError = true;
      } else if (!email_regex.test(email)) {
        resultP.innerText = "Enter a valid Email*";
        resultDiv.style.visibility = "visible";
        emailInput.style.border = "1px solid red";
        firstNameInput.style.border = "none";
        lastNameInput.style.border = "none";
        passwordInput.style.border = "none";
        hasError = true;
      }
    }

    if (!hasError) {
      if (!password) {
        resultP.innerText = "Enter Password*";
        resultDiv.style.visibility = "visible";
        passwordInput.style.border = "1px solid red";
        firstNameInput.style.border = "none";
        lastNameInput.style.border = "none";
        emailInput.style.border = "none";
        hasError = true;
      } else if (password.length < 6) {
        resultP.innerText = "Password must be at least 6 characters*";
        resultDiv.style.visibility = "visible";
        passwordInput.style.border = "1px solid red";
        firstNameInput.style.border = "none";
        lastNameInput.style.border = "none";
        emailInput.style.border = "none";
        hasError = true;
      }
    }

    if (hasError) {
      e.preventDefault();
    } else {
      resultDiv.style.visibility = "hidden";
    }
  });
