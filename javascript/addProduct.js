// GETTING the product image input
const productImage = document.querySelector(".my-input.productImage");
// getting the 'missing img text'
const missingImgText = document.getElementById("txt-missing-img");

// Admin must upload an image for the product in order to add
// it's not allowed to add a new product without image

// So i am adding an event listener to the add product form
// to capture the image selection
document
  .getElementById("form-add-product")
  .addEventListener("submit", (event) => {
    // I am checking here if the product image files is null
    // this means that the admin didn't pick an image for the product
    if (!productImage.files || productImage.files.length === 0) {
      missingImgText.style.display = "block";
      // so we will set the error message
      event.preventDefault(); // Prevent form submission
    }
  });

// this function in order to prepare the preview of the image
// when the user selects
function prepareSelectedImagePreview() {
  const imageInput = document.querySelector(".my-input.productImage");
  // getting the image preview container ( this includes the image preview with the delete image button)
  const imagePreviewContainer = document.querySelector(
    ".preview-image-container"
  );

  // now we want to get the image preview
  const imagePreview = document.querySelector(".image-preview");
  // setting the on change
  imageInput.addEventListener("change", (e) => {
    // getting the selected file from the input
    const imgFile = e.target.files[0];

    // ensuring that the selected file is an image
    if (imgFile && imgFile.type.startsWith("image/")) {
      console.log("the file type is image ");
      // just creating a temprary URL to the selected image file
      const imgUrl = URL.createObjectURL(imgFile);
      // changing the 'imagePreviewContainer' display to 'block', because i set it to none by default
      imagePreviewContainer.style.display = "flex";
      // now setting the src
      imagePreview.src = imgUrl; // now setting the src of the chosen image
      // removing the display for 'missingImg' txt
      missingImgText.style.display = "none";

      // adding an action for the delete chosen btn
      document
        .querySelector(".btn-delete-chosen-img")
        .addEventListener("click", (e) => {
          // deleting image
          deleteImage();
        });
    } else {
      // if it's not type image, then empty it
      imagePreview.src = "";
    }
  });
  // this function will delete the chosen image
  function deleteImage() {
    imagePreview.src = ""; // resetting the image preview
    imageInput.value = ""; // reset image input value
    imagePreviewContainer.style.display = "none"; // remove the display of the imagePreviewContainer
    missingImgText.style.display = "none"; // removing the display of the 'missingImg' text
  }
}

prepareSelectedImagePreview();
