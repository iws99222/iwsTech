// Select all buttons responsible for toggling account activation status
document.querySelectorAll(".activation-toggle-btn").forEach((activateBtn) => {
  // Initialize each button based on its current status (1 = Active, 0 = Inactive)
  if (activateBtn.getAttribute("data-set-account-status") == 1) {
    activateBtn.classList.add("active"); // Apply styling to indicate active state
    activateBtn.textContent = "Deactivate"; // setting btn text
  } else {
    activateBtn.textContent = "Activate";
    activateBtn.classList.remove("active"); // Apply styling to indicate active state
  }

  // Attach a click event listener to toggle account activation status
  activateBtn.addEventListener("click", () => {
    /*
     * Retrieve the current account status from the custom dataset attribute
     * This status is defined for each user element during rendering as:
     * data-set-account-status="1" (active) or "0" (inactive)
     */
    // getting data-set-account-status
    const isActive = activateBtn.getAttribute("data-set-account-status") == 1;
    // getting user id
    const userID = activateBtn.getAttribute("data-set-user-id");
    // it the account is currently not active
    if (!isActive) {
      // If the account is currently inactive, activate it
      activateBtn.textContent = "Deactivate"; // Update button text
      activateBtn.classList.add("active"); // Apply active styling
      activateBtn.setAttribute("data-set-account-status", 1); // Update status attribute
      console.log("Activated");
    } else {
      // If the account is currently active, deactivate it
      activateBtn.textContent = "Activate"; // Update button text
      activateBtn.classList.remove("active"); // Remove active styling
      activateBtn.setAttribute("data-set-account-status", 0); // Update status attribute
      console.log("Deactivated");
    }
    // update activation status in database by sending the 'updated activation status' and 'userID'
    updateActivationStatus(isActive, userID);
  });

  // this function here will update the activaion status in the database
  function updateActivationStatus(status, userID) {
    // creating ajax
    const updateStatusRequest = new XMLHttpRequest();
    // opening the updatePage
    updateStatusRequest.open(
      "POST",
      "../../database/updateActivationStatus.php"
    );
    // setting form request header
    updateStatusRequest.setRequestHeader(
      "Content-Type",
      "application/x-www-form-urlencoded"
    );
    // on load
    updateStatusRequest.onload = function () {
      // if status success
      if (updateStatusRequest.status == 200) {
        console.log(updateStatusRequest.responseText);
      } else {
        console.log("Something went wrong");
      }
    };
    // setting on error listener
    updateStatusRequest.onerror = function () {
      console.log("Invalid URL");
    };
    // formatting the status to string
    const formattedStatus = status ? "false" : "true";
    // sending all the required data
    const data = `activationStatus=${encodeURIComponent(
      formattedStatus
    )}&currentUserID=${userID}`;

    // finally sending the data
    updateStatusRequest.send(data);
  }
});

// getting all user profiles
var userProfiles = document.querySelectorAll(".user-profile");
// setting a click for each profile
userProfiles.forEach((userProfile) => {
  userProfile.addEventListener("click", () => {
    // isAlreadyViewed
    const isAlreadyViewed = userProfile.classList.contains("viewed");

    // Remove 'viewed' from all first
    userProfiles.forEach((profile) => profile.classList.remove("viewed"));

    // If it wasn't already viewed, add the class
    if (!isAlreadyViewed) {
      userProfile.classList.add("viewed");
    }
  });
});
