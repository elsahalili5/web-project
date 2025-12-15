

const items = document.querySelectorAll(".faq-item");

items.forEach(item => {
  const question = item.querySelector(".faq-question");
  const answer = item.querySelector(".faq-answer");
  const plus = item.querySelector(".plus");

  question.addEventListener("click", () => {
    const isOpen = answer.style.display === "block";

    // mbyll të gjitha
    document.querySelectorAll(".faq-answer").forEach(a => a.style.display = "none");
    document.querySelectorAll(".plus").forEach(p => p.textContent = "+");

    if (!isOpen) {
      answer.style.display = "block";
      plus.textContent = "-";
    }
  });
});



