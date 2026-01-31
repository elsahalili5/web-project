const donationForm = document.getElementById("donationForm");
const resultDiv = document.querySelector(".result");
const amountresultDiv = document.querySelector(".amount-result");

const name_regex = /^[A-Za-z]+$/;
const email_regex =
  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
const card_regex = /^[0-9]{13,19}$/;
const cvc_regex = /^[0-9]{3,4}$/;

function setBoxError(element) {
  element.style.border = "1px solid red";
}
function clearBoxError(element) {
  element.style.border = "1px solid #ddd";
}

donationForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const amountInput = document.getElementById("amountInput");
  const amountBox = document.querySelector(".amount");
  const emailInput = document.querySelector('input[name="email"]');
  const firstNameInput = document.querySelector('input[name="firstName"]');
  const lastNameInput = document.querySelector('input[name="lastName"]');
  const cardNumberInput = document.querySelector('input[name="cardNumber"]');
  const expireDateInput = document.querySelector('input[name="expireDate"]');
  const cvcInput = document.querySelector('input[name="cvv"]');
  const cardNameInput = document.querySelector('input[name="cardName"]');
  const postalCodeInput = document.querySelector('input[name="postalCode"]');

  [amountBox, emailInput, cardNumberInput, cardNameInput].forEach(
    clearBoxError
  );
  [firstNameInput, lastNameInput].forEach((i) =>
    clearBoxError(i.parentElement)
  );
  [expireDateInput, cvcInput, postalCodeInput].forEach((i) =>
    clearBoxError(i.parentElement)
  );

  resultDiv.innerText = "";
  amountresultDiv.innerText = "";
  if (!amountInput.value) {
    setBoxError(amountBox);
    amountresultDiv.innerText = "Amount is required*";
    amountresultDiv.style.visibility = "visible";
    return;
  } else if (Number(amountInput.value) <= 0) {
    setBoxError(amountBox);
    amountresultDiv.innerText = "Enter a valid Amount*";
    amountresultDiv.style.visibility = "visible";
    return;
  }

  if (!emailInput.value.trim()) {
    setBoxError(emailInput);
    resultDiv.innerText = "Email is required*";
    resultDiv.style.visibility = "visible";
    return;
  } else if (!email_regex.test(emailInput.value.trim())) {
    setBoxError(emailInput);
    resultDiv.innerText = "Enter a valid email*";
    resultDiv.style.visibility = "visible";
    return;
  }

  if (!firstNameInput.value.trim()) {
    setBoxError(firstNameInput.parentElement);
    resultDiv.innerText = "First name is required*";
    resultDiv.style.visibility = "visible";
    return;
  } else if (!name_regex.test(firstNameInput.value.trim())) {
    setBoxError(firstNameInput.parentElement);
    resultDiv.innerText = "First name must contain only letters*";
    resultDiv.style.visibility = "visible";
    return;
  }

  if (!lastNameInput.value.trim()) {
    setBoxError(lastNameInput.parentElement);
    resultDiv.innerText = "Last name is required*";
    resultDiv.style.visibility = "visible";
    return;
  } else if (!name_regex.test(lastNameInput.value.trim())) {
    setBoxError(lastNameInput.parentElement);
    resultDiv.innerText = "Last name must contain only letters*";
    resultDiv.style.visibility = "visible";
    return;
  }

  if (!cardNumberInput.value.trim()) {
    setBoxError(cardNumberInput);
    resultDiv.innerText = "Card number is required*";
    resultDiv.style.visibility = "visible";
    return;
  } else if (!card_regex.test(cardNumberInput.value.trim())) {
    setBoxError(cardNumberInput);
    resultDiv.innerText = "Card number must be 13-19 digits*";
    resultDiv.style.visibility = "visible";
    return;
  }

  if (!expireDateInput.value.trim()) {
    setBoxError(expireDateInput.parentElement);
    resultDiv.innerText = "Expiry date is required*";
    resultDiv.style.visibility = "visible";
    return;
  }

  if (!cvcInput.value.trim()) {
    setBoxError(cvcInput.parentElement);
    resultDiv.innerText = "CVC is required*";
    resultDiv.style.visibility = "visible";
    return;
  } else if (!cvc_regex.test(cvcInput.value.trim())) {
    setBoxError(cvcInput.parentElement);
    resultDiv.innerText = "CVC must be 3 or 4 digits*";
    resultDiv.style.visibility = "visible";
    return;
  }

  if (!cardNameInput.value.trim()) {
    setBoxError(cardNameInput);
    resultDiv.innerText = "Name on card is required*";
    resultDiv.style.visibility = "visible";
    return;
  } else if (!name_regex.test(cardNameInput.value.trim())) {
    setBoxError(cardNameInput);
    resultDiv.innerText = "Name on card must contain only letters*";
    resultDiv.style.visibility = "visible";
    return;
  }

  if (!postalCodeInput.value.trim()) {
    setBoxError(postalCodeInput.parentElement);
    resultDiv.innerText = "Postal code is required*";
    resultDiv.style.visibility = "visible";
    return;
  }

  // Nëse gjithçka është valide
  resultDiv.style.color = "green";
  resultDiv.innerText = "Donation successful! Sending...";

  donationForm.submit(); // dërgon formën
});
