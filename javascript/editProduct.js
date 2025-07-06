// getting the change product image button
const productImageInput = document.getElementById("product-image-input");
// getting the image preview where we will display the image
const imagePreview = document.getElementById("changed-photo-preview");
// adding change event, to capture image changing
productImageInput.addEventListener("change", (e) => {
  // getting the selected file from the input
  let newImgFile = e.target.files[0];
  // ensuring the file is selected and it's type is an image
  if (newImgFile && newImgFile.type.startsWith("image/")) {
    // creating a temp new image url
    let newImageUrl = URL.createObjectURL(newImgFile);
    imagePreview.src = newImageUrl; // setting the new image in the preview
    console.log("new image url: " + newImageUrl);
  }
});
