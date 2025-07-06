// first, this for initializing the slideshow: - setup , autoplay and controls
function initializeSlider() {
  // the main interval id
  let intervalID = null;
  // reset timoud id
  let resetTimeoutID = null;
  let currentPos = 0; // the main current position1
  // getting all slides
  const slides = document.querySelectorAll(".slide");
  // getting the dots container (where we will append the slider dots)
  const sliderDotsContainer = document.querySelector(".slider-dots-container");
  // the main slide container (where the slider pages slides)
  const slideContainer = document.querySelector(".slider-container");

  //Creates navigation dots for each slide and sets up click events
  // to navigate to the corresponding slide when a dot is clicked.
  function createSliderDots() {
    // clearing previous dots
    sliderDotsContainer.innerHTML = "";
    // getting all slides
    slides.forEach((_, pos) => {
      // creating a dot element
      const dot = document.createElement("div");
      // adding a classs
      dot.classList.add("dot");

      // appending to slide dots container
      sliderDotsContainer.appendChild(dot);

      // Adding click event listener to the dot
      dot.addEventListener("click", () => {
        // Updating the current position to the clicked dot's index
        currentPos = pos;

        // Removing the 'active' class from all slides
        slides.forEach((slide) => slide.classList.remove("active"));

        // Adding the 'active' class to the selected slide
        slides[currentPos].classList.add("active");

        // Updating the visual state of the dots
        setSelectedDot(currentPos);

        // resetting auto slide
        resetAutoSlide();
      });
    });
  }

  // this for updating the selected dot
  function setSelectedDot(index) {
    // getting all dots
    const allDots = document.querySelectorAll(".dot");
    // remove active for all
    allDots.forEach((dot) => dot.classList.remove("active"));
    // if
    if (allDots[index]) {
      console.log(currentPos);
      allDots[index].classList.add("active");
    }
  }

  // move the slide to the next
  function slideToNext() {
    // removing the 'active' from the current position
    slides[currentPos].classList.remove("active");
    // increment until it's become = slides.length
    // then it will be zero
    currentPos = (currentPos + 1) % slides.length;
    // adding the active class to the new slide page
    slides[currentPos].classList.add("active");
    // set the selected dots for the current slide
    setSelectedDot(currentPos);
  }

  // starts the auto slide
  function startAutoSlide() {
    // clearing interval ' if exists'
    clearInterval(intervalID);
    // reassigning the interval
    intervalID = setInterval(slideToNext, 3000);
  }

  // resetting the auto slide
  function resetAutoSlide() {
    // clearing interval
    clearInterval(intervalID);
    // clearing all timeout
    clearTimeout(resetTimeoutID);

    // restart the auto slide
    startAutoSlide();
  }

  // this for pausing the auto slide when hovering
  function handleHoverPause() {
    // mouse enter
    slideContainer.addEventListener("mouseenter", () =>
      // clear interval
      clearInterval(intervalID)
    );
    // restart auto slide when mouse leave
    slideContainer.addEventListener("mouseleave", startAutoSlide);
  }

  // navigating to previous slides
  function moveToPreviousSlide() {
    // Check if the current position is greater than 0
    if (currentPos > 0) {
      // Removing the 'active' class from the current slide
      slides[currentPos].classList.remove("active");

      // Updating the current position to the previous slide
      currentPos = (currentPos - 1) % slides.length;

      // adding the 'active' class to the new current slide
      slides[currentPos].classList.add("active");

      // updating the active state of the navigation dots
      setSelectedDot(currentPos);

      // resetting the auto-slide timer to avoid immediate slide changes
      resetAutoSlide();
    }
  }
  // navigating to next slides ( as the current pos < length of the slide pages)
  function moveToNextSlide() {
    // Checking if the current position is still less than slides length - 1
    if (currentPos < slides.length - 1) {
      // removing the 'active' from the current slide
      slides[currentPos].classList.remove("active");
      // incrementing current pos
      currentPos += 1;
      // adding 'active' for the new slide position
      slides[currentPos].classList.add("active");

      // updating visual selected dot
      setSelectedDot(currentPos);

      //resetting auto-slide timer to avoid immediate slide changes
      resetAutoSlide();
    }
  }

  // attaching a click on the 'next' and 'prev' slider buttons
  function setupNavigationButtons() {
    // getting the prev btn
    const prevButton = document.querySelector(".btn-slide-prev");
    // getting the next btn
    const nextButton = document.querySelector(".btn-slide-next");

    // attaching click event for each
    prevButton?.addEventListener("click", moveToPreviousSlide);
    nextButton?.addEventListener("click", moveToNextSlide);
  }

  // emptying sliderDotsContainer
  sliderDotsContainer.innerHTML = "";
  // creating slider dots
  createSliderDots();
  // selecting the current position when first launch the home
  slides[currentPos].classList.add("active");
  //  set the selected dot
  setSelectedDot(currentPos);
  //  setting up slider nav buttons (prev  & next)
  setupNavigationButtons();
  // handling stop auto sliding when hovering
  handleHoverPause();

  // finally starting the auto slide
  startAutoSlide();
}

// initialzing the slider
initializeSlider();
