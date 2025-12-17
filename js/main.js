const menuToggle = document.getElementById("menu-toggle");
const leftNav = document.getElementById("menu-item");
const rightNav = document.getElementById("menu-item-right");
const body = document.body;

menuToggle.addEventListener("click", () => {
  const isOpen = leftNav.classList.toggle("active");

  rightNav.classList.toggle("active");
  body.classList.toggle("menu-open", isOpen);
  menuToggle.innerHTML = isOpen ? "✕" : "☰";
});
