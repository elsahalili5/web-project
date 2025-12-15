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

  const resultMsg = document.querySelector(".result");

  resultMsg.style.color = "red";
  resultMsg.style.visibility = "visible";
  resultMsg.innerText = "";

  if (!nameInput.value.trim()) {
    resultMsg.innerText = "Enter your name*";
    return;
  } else if (!nameRegex.test(nameInput.value.trim())) {
    resultMsg.innerText = "Name must contain only letters*";
    return;
  }

  if (!emailInput.value.trim()) {
    resultMsg.innerText = "Enter your email*";
    return;
  } else if (!emailRegex.test(emailInput.value.trim())) {
    resultMsg.innerText = "Enter a valid email*";
    return;
  }

  if (!subjectInput.value.trim()) {
    resultMsg.innerText = "Enter subject*";
    return;
  }

  if (!messageInput.value.trim()) {
    resultMsg.innerText = "Enter your message*";
    return;
  }

  resultMsg.style.color = "green";
  resultMsg.innerText = "Message sent successfully! We will contact you soon.";

  setTimeout(() => {
    contactForm.reset();
    resultMsg.innerText = "";
  }, 2000);
});
