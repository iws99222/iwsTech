// document.addEventListener("contextmenu", (e) => {
//   e.preventDefault();
// });
// GETTING THE MAIN CONTAINER
const mainContainer = document.querySelector(".main-container");
let currentPage = "";
console.log(currentPage);

// loading all when dom created
document.addEventListener("DOMContentLoaded", () => {
  loadPage();
  filterProductsByCategories();
  viewProductDetails();
  logout();
});

// this is the main function to load page with navigation bar
function loadPage() {
  const navLinks = document.querySelectorAll(".nav-container");
  // by default, we are loading the home page
  loadPageContent("home.php");

  // getting all nav-links
  navLinks.forEach((nav_link) => {
    // getting the datapage of each nav item
    const dataPage = nav_link.getAttribute("data-page");
    // now we want to select the home nav-item as default
    // when the user open the site, home nav will active
    if (dataPage === "home.php") {
      // adding .active in order to make it selected
      nav_link.classList.add("active");
    }

    // now registering click event on each nav link
    nav_link.addEventListener("click", () => {
      if (dataPage === "log out.php") {
        window.location.href = "../../database/logout.php";
      }
      // loading content of the page
      loadPageContent(dataPage);
      // we want to remove .active from all nav icons
      navLinks.forEach((link) => {
        //  so removing all active nav btns
        link.classList.remove("active");
      });
      // adding .active for the selected one
      nav_link.classList.add("active");
    });
  });

  function loadPageContent(page) {
    console.log(page);

    // now will use ajax for loading the current nav page
    const request = new XMLHttpRequest();
    // opening the 'loadPage.php' page
    request.open("POST", "../../pages/nav-screens/" + page);
    // onLoad request
    request.onload = function () {
      if (request.status == 200) {
        // setting the current page content in the main container
        mainContainer.innerHTML = request.responseText;
        // appending the js file for each
        const scriptFile = document.createElement("script");
        // setting the script, by navigating to the js folder and just replacing .php by .js
        scriptFile.src = `../../javascript/${page.replace(".php", ".js")}`;
        // appending script file to the mainContainer
        mainContainer.append(scriptFile);
      } else {
        console.log("page not loaded");
      }
    };
    request.onerror = () => {
      console.log("something went wrong");
    };
    // sending the request
    request.send();
  }
}
// this function is for filtering the products with categories
function filterProductsByCategories() {
  document.querySelectorAll(".category-drop-item").forEach((navItem) => {
    navItem.addEventListener("click", () => {
      document
        .querySelectorAll(".category-drop-item")
        .forEach((item) => item.classList.remove("active"));
      navItem.classList.add("active");
      const selectedCategory = navItem.textContent.trim();
      showCategoryProducts(selectedCategory);
    });
  });
}
// this function will be showing and listing the categories
function showCategoryProducts(targetCategory = "") {
  // init the categories request
  const categoriesLoadRequest = new XMLHttpRequest();
  // request is 'POST', and redirecting into the page
  categoriesLoadRequest.open(
    "POST", // request method
    "../../database/getProductsByCategory.php?category=" + targetCategory // where we will fetch all the selected products
  );
  //  setting form header
  categoriesLoadRequest.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );

  // now we will load the request and check
  categoriesLoadRequest.onload = () => {
    // if it's succeeded
    if (categoriesLoadRequest.status === 200) {
      // getting the page response text
      const htmlBody = categoriesLoadRequest.responseText;
      console.log(categoriesLoadRequest.responseText);
      // setting the response text in the main container (which the filtered products list )
      mainContainer.innerHTML = htmlBody;

      // appending it's js file
      const getProductsCategoryScript = document.createElement("script");
      // setting it's src
      getProductsCategoryScript.src =
        "../../javascript/getProductsByCategory.js";

      // appending it to the container
      mainContainer.appendChild(getProductsCategoryScript);
    } else {
      console.log("fail");
    }
  };
  // handling error
  categoriesLoadRequest.onerror = () => {
    console.log("Something went wrong in the url");
  };

  // Only send category if it exists
  const requestBody = targetCategory
    ? "category=" + encodeURIComponent(targetCategory)
    : "";
  categoriesLoadRequest.send(requestBody);
}

// function to log out btn
function logout() {
  document.querySelector(".logout-btn").addEventListener("click", () => {
    window.location.href = "../../database/logout.php";
  });
}

// this function will be sorting the products
function sortProducts(element) {
  // getting the data-sort attribute value
  const dataSort = element.getAttribute("data-sort");
  // also getting the data-category
  const dataCategory = element.getAttribute("data-category");

  // load the sorted products
  loadSortedProducts(dataSort, dataCategory);

  // this will load and show the sorted product
  // we are sending the sorting type and current category
  // in order to post to the 'getProductsByCategory
  function loadSortedProducts(sortingType, category) {
    // // init ajax
    const sortRequest = new XMLHttpRequest();
    // openning the request
    sortRequest.open("POST", "../../database/getProductsByCategory.php");
    // setting request header
    sortRequest.setRequestHeader(
      "Content-Type",
      "application/x-www-form-urlencoded"
    );
    // on load request
    sortRequest.onload = function () {
      // checking the status
      if (sortRequest.status == 200) {
        console.log(sortRequest.responseText);
        // this means that success
        // getting the response
        mainContainer.innerHTML = sortRequest.responseText;
      } else {
        console.log("URL not found.. Please be sure that is a valid url");
      }
    };

    // we must now send the sorting type with the category
    const data = `sort=${encodeURIComponent(
      sortingType
    )}&category=${encodeURIComponent(category)}`;

    // finally sending the data
    sortRequest.send(data);
  }
}
