// CONTACT FORM VALIDATION
const contactForm = document.getElementById("contact-form");

const nameRegex = /^[A-Za-z\s]+$/;
const emailRegex =
  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

contactForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const subjectInput = document.getElementById("subject");
  const messageInput = document.getElementById("message");

  // Message box (create once)
  let resultMsg = document.querySelector(".contact-result");

  if (!resultMsg) {
    resultMsg = document.createElement("p");
    resultMsg.className = "contact-result";
    contactForm.appendChild(resultMsg);
  }

  resultMsg.style.color = "red";
  resultMsg.innerText = "";

  // Name
  if (!nameInput.value.trim()) {
    resultMsg.innerText = "Enter your name*";
    return false;
  } else if (!nameRegex.test(nameInput.value.trim())) {
    resultMsg.innerText = "Name must contain only letters*";
    return false;
  }

  // Email
  if (!emailInput.value.trim()) {
    resultMsg.innerText = "Enter your email*";
    return false;
  } else if (!emailRegex.test(emailInput.value.trim())) {
    resultMsg.innerText = "Enter a valid email*";
    return false;
  }

  // Subject
  if (!subjectInput.value.trim()) {
    resultMsg.innerText = "Enter subject*";
    return false;
  }

  // Message
  if (!messageInput.value.trim()) {
    resultMsg.innerText = "Enter your message*";
    return false;
  }

  // SUCCESS
  resultMsg.style.color = "green";
  resultMsg.innerText = "Message sent successfully! We will contact you soon.";

  // Clear form
  setTimeout(() => {
    nameInput.value = "";
    emailInput.value = "";
    subjectInput.value = "";
    messageInput.value = "";
    resultMsg.innerText = "";
  }, 2000);

  return false;
});
