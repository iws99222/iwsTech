window.addEventListener("DOMContentLoaded", () => {
  setPreviewUpdatedUserProfile();
  settingUpTheUserProfileContainerToggle();
});

// this function is the responsible for previewing
// the updated user profile in 'update user info container'
// so when the user update image, will be showing in the
// image preview
function setPreviewUpdatedUserProfile() {
  // getting the image file input
  const imageInput = document.querySelector(".image-input");
  // where will be previewing the updated profile
  const imagePreview = document.getElementById("profilePreview");

  // image input on 'change' listener
  imageInput.addEventListener("change", (e) => {
    // ensuring the image input not null
    let updatedUserProfile = e.target.files[0];
    if (updatedUserProfile && updatedUserProfile.type.startsWith("image/")) {
      let newImageUrl = URL.createObjectURL(updatedUserProfile);
      imagePreview.src = newImageUrl;
    }
  });
}

// this function will be responsible hiding and showing the user profile container
function settingUpTheUserProfileContainerToggle() {
  // getting the nav user profile
  const navProfile = document.querySelector(".nav-bar-profile-icon");
  // getting the user profile container
  const userProfileContainer = document.querySelector(
    ".user-profile-container"
  );

  navProfile.addEventListener("click", () => {
    if (userProfileContainer.classList.contains("show")) {
      userProfileContainer.classList.remove("show");
    } else {
      userProfileContainer.classList.add("show");
    }
  });
}
