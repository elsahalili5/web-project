document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("fundraiserForm");
  const steps = document.querySelectorAll(".step");
  const nextBtn = document.getElementById("nextBtn");
  const backBtn = document.querySelector(".back");
  const submitBtn = document.getElementById("submitBtn");
  let current = 0;
  const leftTitle = document.getElementById("leftTitle");
  const leftDesc = document.getElementById("leftDescription");

  const fundraiseSection = document.querySelector(".fundraise-section");
  const successScreen = document.getElementById("successScreen");

  const titleInput = document.getElementById("fundraiser-title");
  const titleCount = document.getElementById("titleCount");

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

    validateCurrentStep();
  }

  function validateCurrentStep() {
    const step = steps[current];
    let valid = false;

    if (step.querySelector(".categories")) {
      valid = !!step.querySelector(".category.active-step");
    } else if (step.querySelector(".card")) {
      valid = !!step.querySelector(".card.active-step");
    } else if (step.querySelector('input[type="number"]')) {
      const numberInput = step.querySelector('input[type="number"]');
      valid = numberInput.value.trim() !== "" && Number(numberInput.value) > 0;
    } else if (step.querySelector("#fundraiser-title")) {
      const input = step.querySelector("#fundraiser-title");
      const value = input.value.trim();
      valid = value.length > 0 && /[a-zA-Z]/.test(value);
    } else if (step.querySelector("textarea")) {
      const textarea = step.querySelector("textarea");
      valid = textarea.value.trim().length > 0;
    } else if (step.querySelector(".upload")) {
      const upload = step.querySelector(".upload");
      valid = upload.style.backgroundImage !== "";
    } else {
      valid = true;
    }

    nextBtn.disabled = current === steps.length - 1 ? true : !valid;
    submitBtn.disabled = current === steps.length - 1 ? !valid : true;

    updateReview();
  }

  function updateReview() {
    const title = titleInput.value.trim() || "—";
    const goalInput = document.querySelector('.step input[type="number"]');
    const goal = goalInput ? goalInput.value.trim() : "—";
    const activeCategory = document.querySelector(
      ".categories .category.active-step"
    );
    const category = activeCategory ? activeCategory.textContent : "—";
    const cardStep = document.querySelector(
      ".step:nth-of-type(2) .card.active-step"
    );
    const beneficiary = cardStep
      ? cardStep.querySelector("strong").textContent
      : "—";
    const storyTextarea = document.querySelector(".step textarea");
    const story = storyTextarea ? storyTextarea.value.trim() : "—";
    const mediaPreview = document.querySelector(".media-preview");

    document.getElementById("reviewTitle").textContent = title;
    document.getElementById("reviewGoal").textContent = goal ? `€${goal}` : "—";
    document.getElementById("reviewCategory").textContent = category;
    document.getElementById("reviewStory").textContent = story;
    if (mediaPreview) {
      const uploadStep = document.querySelector(".step .upload");
      mediaPreview.style.backgroundImage = uploadStep
        ? uploadStep.style.backgroundImage
        : "";
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
      const items = e.target.classList.contains("category")
        ? step.querySelectorAll(".category")
        : step.querySelectorAll(".card");
      items.forEach((el) => el.classList.remove("active-step"));
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

    if (e.target.classList.contains("upload")) {
      const input = document.createElement("input");
      input.type = "file";
      input.accept = "image/*";

      input.onchange = () => {
        if (!input.files[0]) return;
        e.target.style.backgroundImage = `url(${URL.createObjectURL(
          input.files[0]
        )})`;
        e.target.textContent = "";
        e.target.style.border = "none";
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
