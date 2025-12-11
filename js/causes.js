document.addEventListener("DOMContentLoaded", () => {
  const carousel = document.querySelector(".causes-carousel");
  const prevArrow = document.querySelector(".prev-arrow");
  const nextArrow = document.querySelector(".next-arrow");

  const scrollAmount = 320;

  if (carousel && prevArrow && nextArrow) {
    nextArrow.addEventListener("click", () => {
      carousel.scrollBy({
        left: scrollAmount,
        behavior: "smooth",
      });
    });

    prevArrow.addEventListener("click", () => {
      carousel.scrollBy({
        left: -scrollAmount,
        behavior: "smooth",
      });
    });
  }
});
