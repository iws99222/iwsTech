<!-- THIS Page is responsible for filtering the products by categroy -->


<?php

// this is the list of the drop down sorting list
// we will create a sort drop down item for each
$sort_list = [
    "Name (A–Z)",
    "Name (Z–A)",
    "Price (Low to High)",
    "Price (High to Low)",
    "Newest First",
    "Oldest First"
];

// this text will be set under category type
// Sorting by (sortingType)
$sorting_text= '';

// including connection
include 'connection.php';


// ensuring category is posted
if(isset($_POST['category'])){
    // Base query
    $getProductsQuery = "
    SELECT p.*
    FROM Products p
    JOIN Category c ON c.categoryID = p.categoryID"; // joining category to access category name

    // getting the chosen category
    $category = $_POST['category'] ?? "";
    // checking if the selected is 'All Products', this means we will show all products
    // so we will execute the Base query, by getting all products
    if($category!=='All Categories'){
    // else, we are getting the products of specific category
    $getProductsQuery .= " where c.categoryName = '$category'";
    }

    
    // checking if the 'sort' field is set in the POST request
    // if it's set, it means the user is trying to sort the products
    if (isset($_POST['sort'])) {
         // storing the selected sort type from the form
          $sortType = $_POST['sort'];
         
    // we'll use switch-case to handle different sort types
     switch ($sortType) {
        // sorting by product name in ascending order (A to Z)
        case 'Name (A–Z)':
            $sorting_text = 'Name (A–Z)';
            $getProductsQuery .= " ORDER BY productName ASC";
            break;

        // sorting by product name in descending order (Z to A)
        case 'Name (Z–A)':
            $sorting_text = 'Name (Z-A)';
            $getProductsQuery .= " ORDER BY productName DESC";
            break;

        // sorting by price from low to high
        case 'Price (Low to High)':
            $sorting_text = 'Price (Low to High)';
            $getProductsQuery .= " ORDER BY price ASC";
            break;

        // sorting by price from high to low
        case 'Price (High to Low)':
            $sorting_text = 'Price (high to low)';
            $getProductsQuery .= " ORDER BY price DESC";
            break;

        // sorting by newest products first (assuming higher productID is newer)
        case 'Newest First':
            $sorting_text = 'Newest First';
            $getProductsQuery .= " ORDER BY productID DESC";
            break;

        // sorting by oldest products first (lower productID is older)
        case 'Oldest First':
            $sorting_text = 'Oldest First';
            $getProductsQuery .= " ORDER BY productID ASC";
            break;
    }
}

  ?>

<!-- including style of the sorting drop menu-->
<link rel="stylesheet" href="../../styles/sortDropDown.css" />

<div class="mainGetProductsContainer">
    <!-- the container which we set the 
        'showing product of categories' + sort button -->
    <div class="categories-product-top-container">
        <!-- showing products btn -->
        <div>
            <!-- showing products title -->
            <h2>Showing Products in: <span style='color:red'><?=$category?></span></h2>
            <!-- sorting BY text (if sorting) -->
            <?php if(isset($_POST['sort'])){
            echo '<p>Sorting by '.$sorting_text .'</p>';
        }?>
        </div>
        <!-- sort button -->
        <button class="btn-sort-products">
            <img src="../../drawables/icons/ic_sort.png" alt="sort_icon" />
            <!-- and here's the sort drop down list -->
            <ul class="sort-drop-down-list">
                <?php foreach($sort_list as $sort_item): ?>
                <!-- setting data-sort in order to get in the js -->
                <li class="sort-nav-container" data-sort="<?= htmlspecialchars($sort_item) ?>"
                    data-category="<?=$category?>" ; onclick="sortProducts(this)">
                    <?= htmlspecialchars($sort_item) ?>
                </li>
                <?php endforeach ?>
            </ul>
        </button>
    </div>

    <!-- including getProducts.php for showing the products list -->
    <div class=" categories-product-container">
        <?php 
        include 'getProducts.php';?>
    </div>
    <?php } ?>
</div>