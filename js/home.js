const items = document.querySelectorAll(".faq-item");

items.forEach((item) => {
  const question = item.querySelector(".faq-question");
  const answer = item.querySelector(".faq-answer");
  const plus = item.querySelector(".plus");

  question.addEventListener("click", () => {
    const isOpen = answer.style.display === "block";

    document
      .querySelectorAll(".faq-answer")
      .forEach((a) => (a.style.display = "none"));
    document.querySelectorAll(".plus").forEach((p) => (p.textContent = "+"));

    if (!isOpen) {
      answer.style.display = "block";
      plus.textContent = "-";
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const causes = document.querySelector(".causes-list");
  const prevArrow = document.querySelector(".prev-arrow");
  const nextArrow = document.querySelector(".next-arrow");

  const scrollAmount = 320;

  if (causes && prevArrow && nextArrow) {
    nextArrow.addEventListener("click", () => {
      causes.scrollBy({
        left: scrollAmount,
        behavior: "smooth",
      });
    });

    prevArrow.addEventListener("click", () => {
      causes.scrollBy({
        left: -scrollAmount,
        behavior: "smooth",
      });
    });
  }
});
