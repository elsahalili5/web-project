const donationForm = document.getElementById("donationForm");
const resultDiv = document.querySelector(".result");
const amountresultDiv = document.querySelector(".amount-result");

const name_regex = /^[A-Za-z]+$/;
const email_regex =
  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

donationForm.addEventListener("submit", function (e) {
  e.preventDefault();
  const amountInput = document.getElementById("amountInput");
  const emailInput = document.querySelector(
    'input[placeholder="Email address"]'
  );
  const firstNameInput = document.querySelector(
    'input[placeholder="First name"]'
  );
  const lastNameInput = document.querySelector(
    'input[placeholder="Last name"]'
  );
  const cardNumberInput = document.querySelector(
    'input[placeholder="Card number"]'
  );
  const expireDateInput = document.querySelector(
    'input[placeholder="MM / YY"]'
  );
  const cvcInput = document.querySelector('input[placeholder="CVV"]');
  const cardNameInput = document.querySelector(
    'input[placeholder="Name on card"]'
  );
  const postalCodeInput = document.querySelector(
    'input[placeholder="Postal code"]'
  );

  resultDiv.style.color = "red";
  resultDiv.innerText = "";

  amountresultDiv.style.color = "red";
  amountresultDiv.innerText = "";

  if (!amountInput.value) {
    amountresultDiv.innerText = "Enter Amount*";
    amountresultDiv.style.visibility = "visible";
    return false;
  } else if (isNaN(amountInput.value) || Number(amountInput.value) <= 0) {
    amountresultDiv.innerText = "Enter a valid Amount*";
    amountresultDiv.style.visibility = "visible";

    return false;
  }

  if (!emailInput.value.trim()) {
    resultDiv.innerText = "Enter Email*";
    resultDiv.style.visibility = "visible";
    return false;
  } else if (!email_regex.test(emailInput.value.trim())) {
    resultDiv.innerText = "Enter a valid Email*";
    resultDiv.style.visibility = "visible";

    return false;
  }
  if (!firstNameInput.value.trim()) {
    resultDiv.innerText = "Enter First Name*";
    resultDiv.style.visibility = "visible";
    return false;
  } else if (!name_regex.test(firstNameInput.value)) {
    resultDiv.innerText = "Enter a valid First Name*";
    resultDiv.style.visibility = "visible";

    return false;
  }
  if (!lastNameInput.value.trim()) {
    resultDiv.innerText = "Enter Last Name*";
    resultDiv.style.visibility = "visible";
    return false;
  } else if (!name_regex.test(lastNameInput.value)) {
    resultDiv.innerText = "Enter a valid Last Name*";
    resultDiv.style.visibility = "visible";

    return false;
  }

  if (!cardNumberInput.value.trim()) {
    resultDiv.innerText = "Enter Card Number*";
    resultDiv.style.visibility = "visible";

    return false;
  }

  if (!expireDateInput.value.trim()) {
    resultDiv.innerText = "Enter Expire Date*";
    resultDiv.style.visibility = "visible";

    return false;
  }

  if (!cvcInput.value.trim()) {
    resultDiv.innerText = "Enter CVC*";
    resultDiv.style.visibility = "visible";

    return false;
  }

  if (!cardNameInput.value.trim() || !name_regex.test(cardNameInput.value)) {
    resultDiv.innerText = "Enter a valid Name on Card*";
    resultDiv.style.visibility = "visible";

    return false;
  }

  if (!postalCodeInput.value.trim()) {
    resultDiv.innerText = "Enter Postal Code*";
    resultDiv.style.visibility = "visible";

    return false;
  }

  resultDiv.style.color = "green";
  resultDiv.innerText = "Donation successful! Redirecting...";

  setTimeout(() => {
    window.location.href = "thankyou.html";

    amountInput.value = 0;
    emailInput.value = "";
    firstNameInput.value = "";
    lastNameInput.value = "";
    cardNumberInput.value = "";
    expireDateInput.value = "";
    cvcInput.value = "";
    cardNameInput.value = "";
    postalCodeInput.value = "";
  }, 1000);

  return false;
});
