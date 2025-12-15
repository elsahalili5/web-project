const menuToggle = document.getElementById("menu-toggle");
const leftNav = document.getElementById("menu-item");
const rightNav = document.getElementById("menu-item-right");

menuToggle.addEventListener("click", () => {
  leftNav.classList.toggle("active");
  rightNav.classList.toggle("active");
  document.body.classList.toggle("menu-open");
});
