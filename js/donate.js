const form = document.querySelector(".payment-form");
const resultDiv = document.getElementById("resultDiv");
const resultP = document.getElementById("resultP");

const email_regex =
  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const phone = document.getElementById("phone").value.trim();
  const address = document.getElementById("address").value.trim();
  const cardNumber = document.getElementById("cardNumber").value.trim();
  const expireDate = document.getElementById("expireDate").value.trim();
  const cvc = document.getElementById("cvc").value.trim();
  const amount = document.getElementById("amount").value.trim();

  resultP.innerText = "";
  resultDiv.style.color = "red";
  resultDiv.style.visibility = "visible";

  if (!name) {
    resultP.innerText = "Enter Name*";
    return false;
  }

  if (!email) {
    resultP.innerText = "Enter Email*";
    return false;
  } else if (!email_regex.test(email)) {
    resultP.innerText = "Enter a valid Email*";
    return false;
  }

  if (!phone) {
    resultP.innerText = "Enter Phone*";
    return false;
  }

  if (!address) {
    resultP.innerText = "Enter Address*";
    return false;
  }

  if (!cardNumber) {
    resultP.innerText = "Enter Card Number*";
    return false;
  }

  if (!expireDate) {
    resultP.innerText = "Enter Expire Date*";
    return false;
  }

  if (!cvc) {
    resultP.innerText = "Enter CVC*";
    return false;
  }

  if (!amount) {
    resultP.innerText = "Enter Amount*";
    return false;
  } else if (isNaN(amount) || Number(amount) <= 0) {
    resultP.innerText = "Enter a valid Amount*";
    return false;
  }

  form.reset();
});
