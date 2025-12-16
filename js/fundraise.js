const steps = document.querySelectorAll(".step");
const nextBtn = document.getElementById("nextBtn");
const backBtn = document.querySelector(".back");
const leftTitle = document.getElementById("leftTitle");
const leftDesc = document.getElementById("leftDescription");

const successScreen = document.getElementById("successScreen");
const actionsDiv = document.querySelector(".actions");
const fundraiseSection = document.querySelector(".fundraise-section");

let current = 0;
const totalSteps = steps.length;

const leftContent = [
  ["Choose a category", "What best describes why you're fundraising?"],
  [
    "Tell us who you're fundraising for",
    "This helps us understand who will receive the funds",
  ],
  ["Set your goal", "Choose how much you want to raise"],
  [
    "Give your fundraiser a title",
    "Create a short, clear title that explains your cause",
  ],
  [
    "Tell donors why you’re fundraising",
    "Introduce yourself, explain why this matters, and how funds will be used",
  ],
  ["Add a photo", "Cover media helps tell your story"],
  ["Review your fundraiser", "Let’s make sure your fundraiser is complete"],
];

const titleInput = document.getElementById("fundraiser-title");
const titleCount = document.getElementById("titleCount");

function update() {
  steps.forEach((step, index) => {
    step.classList.toggle("active-step", index === current);
  });

  if (current < leftContent.length) {
    leftTitle.textContent = leftContent[current][0];
    leftDesc.textContent = leftContent[current][1];
  }

  backBtn.style.display = current === 0 ? "none" : "block";

  if (current === totalSteps - 1) {
    nextBtn.textContent = "Launch Fundraiser";
    fillReview();
  } else {
    nextBtn.textContent = "Continue";
  }

  if (fundraiseSection) fundraiseSection.style.display = "grid";
  if (successScreen) successScreen.style.display = "none";
}

function fillReview() {
  const title = document.getElementById("fundraiser-title")?.value;
  const goal = document.querySelector('input[type="number"]')?.value;
  const activeCategory = document.querySelector(
    ".categories .category.active-step"
  );
  const category = activeCategory ? activeCategory.textContent : "—";

  const story = document.querySelector(".step-text textarea")?.value;

  document.getElementById("reviewTitle").textContent = title || "—";
  document.getElementById("reviewGoal").textContent = goal ? `€${goal}` : "—";
  document.getElementById("reviewCategory").textContent = category;
  document.getElementById("reviewStory").textContent = story || "—";
}

nextBtn.addEventListener("click", () => {
  if (current < totalSteps - 1) {
    current++;
    nextBtn.classList.remove("enabled");
    update();
  } else {
    if (fundraiseSection) {
      fundraiseSection.style.display = "none";
    }

    if (successScreen) {
      successScreen.style.display = "flex";
    }
  }
});

titleInput.addEventListener("input", () => {
  titleCount.textContent = titleInput.value.length;
});

document.querySelectorAll(".category, .card").forEach((activeOption) => {
  activeOption.addEventListener("click", () => {
    const parentStep = activeOption.closest(".step");
    parentStep
      .querySelectorAll(activeOption.tagName.toLowerCase())
      .forEach((o) => {
        o.classList.remove("active-step");
      });

    activeOption.classList.add("active-step");
    nextBtn.classList.add("enabled");
  });
});
backBtn.addEventListener("click", () => {
  if (current > 0) {
    current--;
    update();
  }
});

const uploadBox = document.querySelector(".upload");

uploadBox.addEventListener("click", () => {
  const input = document.createElement("input");
  input.type = "file";
  input.accept = "image/*";

  input.addEventListener("change", () => {
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = () => {
      uploadBox.style.backgroundImage = `url(${reader.result})`;
      uploadBox.style.backgroundSize = "cover";
      uploadBox.style.backgroundPosition = "center";
      uploadBox.textContent = "";
      uploadBox.style.border = "none";
      nextBtn.classList.add("enabled");
    };
    reader.readAsDataURL(file);
  });

  input.click();
});

update();
