document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("fundraiserForm");
  const steps = document.querySelectorAll(".step");
  const nextBtn = document.getElementById("nextBtn");
  const backBtn = document.querySelector(".back");
  const submitBtn = document.getElementById("submitBtn");

  const leftTitle = document.getElementById("leftTitle");
  const leftDesc = document.getElementById("leftDescription");

  const fundraiseSection = document.querySelector(".fundraise-section");
  const successScreen = document.getElementById("successScreen");

  const titleInput = document.getElementById("fundraiser-title");
  const titleCount = document.getElementById("titleCount");
  const uploadBox = document.querySelector(".upload");

  let current = 0;

  const leftContent = [
    ["Choose a category", "What best describes why you're fundraising?"],
    ["Who are you fundraising for?", "Tell us who will receive the funds"],
    ["Set your goal", "Choose how much you want to raise"],
    ["Add a title", "Your title must include letters"],
    ["Tell your story", "Explain why this fundraiser matters"],
    ["Add a photo", "Cover media helps tell your story"],
    ["Review", "Make sure everything looks good"],
  ];

  function updateStep() {
    steps.forEach((step, i) =>
      step.classList.toggle("active-step", i === current)
    );

    leftTitle.textContent = leftContent[current][0];
    leftDesc.textContent = leftContent[current][1];

    backBtn.style.display = current === 0 ? "none" : "inline-block";

    if (current === steps.length - 1) {
      nextBtn.style.display = "none";
      submitBtn.hidden = false;
    } else {
      nextBtn.style.display = "inline-block";
      submitBtn.hidden = true;
    }

    nextBtn.disabled = true;
    validateCurrentStep();
  }

  function validateCurrentStep() {
    const step = steps[current];
    let valid = false;

    if (step.querySelector(".category")) {
      valid = !!step.querySelector(".category.active-step");
    }

    if (step.querySelector(".card")) {
      valid = !!step.querySelector(".card.active-step");
    }
    const numberInput = step.querySelector('input[type="number"]');
    if (numberInput) {
      valid = numberInput.value.trim() !== "" && Number(numberInput.value) > 0;
    }

    if (step.querySelector("#fundraiser-title")) {
      const value = titleInput.value.trim();
      valid = value.length > 0 && /[a-zA-Z]/.test(value);
    }

    const textarea = step.querySelector("textarea");
    if (textarea) {
      valid = textarea.value.trim().length > 0;
    }

    if (step.querySelector(".upload")) {
      valid = uploadBox.style.backgroundImage !== "";
    }

    nextBtn.disabled = !valid;
    submitBtn.disabled = !valid;

    updateReview();
  }

  function updateReview() {
    const title = titleInput.value.trim() || "—";
    const goalInput = document.querySelector('input[type="number"]');
    const goal = goalInput ? goalInput.value.trim() : "";
    const activeCategory = document.querySelector(
      ".categories .category.active-step"
    );
    const category = activeCategory ? activeCategory.textContent : "—";
    const cardStep = document.querySelector(
      ".step:nth-child(2) .card.active-step"
    );
    const beneficiary = cardStep
      ? cardStep.querySelector("strong").textContent
      : "—";
    const storyTextarea = document.querySelector(".step-text textarea");
    const story = storyTextarea ? storyTextarea.value.trim() : "—";

    const reviewTitle = document.getElementById("reviewTitle");
    const reviewGoal = document.getElementById("reviewGoal");
    const reviewCategory = document.getElementById("reviewCategory");
    const reviewStory = document.getElementById("reviewStory");
    const mediaPreview = document.querySelector(".media-preview");

    if (reviewTitle) reviewTitle.textContent = title;
    if (reviewGoal) reviewGoal.textContent = goal ? `€${goal}` : "—";
    if (reviewCategory) reviewCategory.textContent = category;
    if (reviewStory) reviewStory.textContent = story;
    if (mediaPreview) {
      mediaPreview.style.backgroundImage =
        uploadBox.style.backgroundImage || "";
      mediaPreview.style.backgroundSize = "cover";
      mediaPreview.style.backgroundPosition = "center";
    }
  }

  document.addEventListener("click", (e) => {
    if (
      e.target.classList.contains("category") ||
      e.target.classList.contains("card")
    ) {
      const step = e.target.closest(".step");
      step
        .querySelectorAll(
          e.target.classList.contains("category") ? ".category" : ".card"
        )
        .forEach((el) => el.classList.remove("active-step"));

      e.target.classList.add("active-step");
      validateCurrentStep();
    }

    if (e.target === nextBtn && !nextBtn.disabled) {
      current++;
      updateStep();
    }

    if (e.target === backBtn) {
      current--;
      updateStep();
    }

    if (e.target === uploadBox) {
      const input = document.createElement("input");
      input.type = "file";
      input.accept = "image/*";

      input.onchange = () => {
        if (!input.files[0]) return;
        uploadBox.style.backgroundImage = `url(${URL.createObjectURL(
          input.files[0]
        )})`;
        uploadBox.textContent = "";
        uploadBox.style.border = "none";
        validateCurrentStep();
      };

      input.click();
    }
  });

  document.addEventListener("input", (e) => {
    if (e.target === titleInput) {
      titleCount.textContent = titleInput.value.length;
    }
    validateCurrentStep();
  });

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    fundraiseSection.style.display = "none";
    successScreen.style.display = "flex";
  });

  updateStep();
});
