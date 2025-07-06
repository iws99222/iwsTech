// getting the edit button
const editProductBtn = document.querySelector(".edit-product");
// getting the delete button
const deleteButton = document.querySelector(".delete-btn");

// adding click event on edit
editProductBtn.addEventListener("click", () => {
  navigateToEditPage();
});
// click event on delete
deleteButton.addEventListener("click", () => {
  deleteProduct();
});

// this function above will be redirecting to the edit page
// by setting the content of the 'editProduct.php' content
// in the main container
function navigateToEditPage() {
  // getting the main container for controlling the showing of edit
  const mainContainer = document.querySelector(".main-container");
  // getting the current product id from the attribute
  const dataSetCurrentProductId = editProductBtn.getAttribute(
    "data-set-current-product-id"
  );
  // building the request
  const editRequest = new XMLHttpRequest();
  //open request
  editRequest.open("POST", "../../database/editProduct.php");
  // setting request header form to the request
  editRequest.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );

  // request onLoad
  editRequest.onload = () => {
    if (editRequest.status == 200) {
      // setting the editPage in the main container
      mainContainer.innerHTML = editRequest.responseText;
      // appending it's js file
      // creating it's script element
      const script = document.createElement("script");
      // setting it's source
      script.src = "../../javascript/editProduct.js";

      // appending the script to the main container
      mainContainer.appendChild(script);
      console.log("edit page successful");
    } else {
      console.log("edit page failed");
    }
  };
  // sending the request with the current product id
  editRequest.send("productID=" + dataSetCurrentProductId);

  window.addEventListener(popstate, () => {
    alert("Backk");
  });
}

// this function will delete the product
function deleteProduct() {
  // getting the product id from button dataset
  const currentProductID = deleteButton.getAttribute(
    "data_set_current_product_id"
  );
  // navigating to the confirm delete product dialog
  window.location.href =
    "../../pages/components/confirmDeleteProductDialog?productId=" +
    currentProductID; // sending the current product id in url
  console.log("Current Product ID: " + currentProductID);
}
