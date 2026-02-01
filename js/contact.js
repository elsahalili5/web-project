document.addEventListener("DOMContentLoaded", function () {
  const contactForm = document.getElementById("contact-form");

  if (!contactForm) return; // siguro që form ekziston

  contactForm.addEventListener("submit", function (e) {
    const resultMsg = document.querySelector(".result");

    // kontroll login (nga PHP metoda User::isLoggedIn())
    const isLoggedIn = <?php echo User::isLoggedIn() ? 'true' : 'false'; ?>;

    if (!isLoggedIn) {
      e.preventDefault();
      resultMsg.style.color = "red";
      resultMsg.innerText = "Duhet të jeni të kyçur për të dërguar mesazh!";
      return;
    }

    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const subjectInput = document.getElementById("subject");
    const messageInput = document.getElementById("message");

    resultMsg.style.color = "red";
    resultMsg.innerText = "";

    const nameRegex = /^[A-Za-z\s]+$/;
    const emailRegex =
      /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    if (!nameInput.value.trim()) {
      e.preventDefault();
      resultMsg.innerText = "Enter your name*";
      return;
    }
    if (!nameRegex.test(nameInput.value.trim())) {
      e.preventDefault();
      resultMsg.innerText = "Name must contain only letters*";
      return;
    }
    if (!emailInput.value.trim()) {
      e.preventDefault();
      resultMsg.innerText = "Enter your email*";
      return;
    }
    if (!emailRegex.test(emailInput.value.trim())) {
      e.preventDefault();
      resultMsg.innerText = "Enter a valid email*";
      return;
    }
    if (!subjectInput.value.trim()) {
      e.preventDefault();
      resultMsg.innerText = "Enter subject*";
      return;
    }
    if (!messageInput.value.trim()) {
      e.preventDefault();
      resultMsg.innerText = "Enter your message*";
      return;
    }

    resultMsg.style.color = "green";
    resultMsg.innerText = "Mesazhi po dërgohet...";
  });
});
