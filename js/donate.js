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

  donationForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const amountInput = document.getElementById("amountInput");
    const amountBox = document.querySelector(".amount");
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

    clearBoxError(amountBox);
    clearBoxError(emailInput);
    clearBoxError(cardNumberInput);
    clearBoxError(cardNameInput);

    [firstNameInput, lastNameInput].forEach((i) =>
      clearBoxError(i.parentElement)
    );
    [expireDateInput, cvcInput].forEach((i) => clearBoxError(i.parentElement));
    clearBoxError(postalCodeInput.parentElement);

    resultDiv.innerText = "";
    amountresultDiv.innerText = "";

    if (!amountInput.value) {
      setBoxError(amountBox);
      amountresultDiv.innerText = "Please enter Amount*";
      amountresultDiv.style.visibility = "visible";

      return false;
    } else if (Number(amountInput.value) <= 0) {
      setBoxError(amountBox);
      amountresultDiv.innerText = "Enter a valid Amount*";
      amountresultDiv.style.visibility = "visible";

      return false;
    }

    if (!emailInput.value.trim()) {
      setBoxError(emailInput);
      resultDiv.innerText = "Please enter email*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    if (!email_regex.test(emailInput.value.trim())) {
      setBoxError(emailInput);
      resultDiv.innerText = "Please enter a valid email*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    if (!firstNameInput.value.trim()) {
      setBoxError(firstNameInput.parentElement);
      resultDiv.innerText = "Please enter first name*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    if (!name_regex.test(firstNameInput.value.trim())) {
      setBoxError(firstNameInput.parentElement);
      resultDiv.innerText = "First name must contain only letters*";
      resultDiv.style.visibility = "visible";

      return false;
    }
    if (!lastNameInput.value.trim()) {
      setBoxError(lastNameInput.parentElement);
      resultDiv.innerText = "Please enter last name*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    if (!name_regex.test(lastNameInput.value.trim())) {
      setBoxError(lastNameInput.parentElement);
      resultDiv.innerText = "Last name must contain only letters*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    if (!cardNumberInput.value.trim()) {
      setBoxError(cardNumberInput);
      resultDiv.innerText = "Please enter card number*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    if (!card_regex.test(cardNumberInput.value.trim())) {
      setBoxError(cardNumberInput);
      resultDiv.innerText = "Card number must be 13-19 digits*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    if (!expireDateInput.value.trim()) {
      setBoxError(expireDateInput.parentElement);
      resultDiv.innerText = "Please enter expiry date*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    if (!cvcInput.value.trim()) {
      setBoxError(cvcInput.parentElement);
      resultDiv.innerText = "Please enter CVC*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    if (!cvc_regex.test(cvcInput.value.trim())) {
      setBoxError(cvcInput.parentElement);
      resultDiv.innerText = "CVC must be 3 or 4 digits*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    if (!cardNameInput.value.trim() || !name_regex.test(cardNameInput.value)) {
      setBoxError(cardNameInput);
      resultDiv.innerText = "Enter card Name on Card*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    if (!postalCodeInput.value.trim()) {
      setBoxError(postalCodeInput.parentElement);
      resultDiv.innerText = "Enter Postal Code*";
      resultDiv.style.visibility = "visible";

      return false;
    }

    resultDiv.style.color = "green";
    resultDiv.innerText = "Donation successful! Redirecting...";

    setTimeout(() => {
      window.location.href = "thankyou.html";
    }, 1000);

    return false;
  });
});
