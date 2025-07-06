<?php
 /* 
 Session must be included, because we want to get the role of the current user to control
 the visibility of 'Edit' and 'Delete' buttons
 */
session_start();


// including the connection.php
include 'connection.php';
// including header
include '../pages/components/header.html';

// getting the product (from productdata-set)
$productID = $_POST['productId'] ?? '';



// we will assign this after fetching the 'currentProduct'
$currentProduct = null;

// Here we are getting the current product with respect to the id
$getCurrentProduct=
 '
 SELECT *
 FROM Products p
 JOIN Category c ON c.categoryID = p.categoryID
 WHERE p.productID ='.$productID; ;

// executing the query
$result = mysqli_query($db , $getCurrentProduct) or die(mysqli_error($conn));
// fetching the product
if($row = mysqli_fetch_assoc($result)){
    $productName = $row['productName'];
    $currentProduct = $row;
}

?>

<!-- including the viewProduct style -->
<link rel="stylesheet" href="../../styles/viewProduct.css">
<div class="view-product-container">
    <div class="product-info-container" data-set-productID='10'>
        <img src="../../drawables/uploaded-images/<?= $currentProduct['productImage']?>" alt="current_product_img" />
        <div>
            <div>
                <!-- product name -->
                <p id="product-name-txt"><strong><?= $currentProduct['productName']?></strong></p>
                <!-- product category -->
                <p id="product-category-txt"><strong>Category:</strong> <?= $currentProduct['categoryName']?></p>
                <!-- product price -->
                <b id="product-price-txt">$<?= number_format($currentProduct['price'],2)?></b>
            </div>

            <div class="btn-container">
                <!-- these buttons (edit, delete) for only admin 
                    Only admin can edit and delete products
                    - So will be checking if the logged user is an 'Admin'
                -->
                <?php
                if($_SESSION['role'] === 'Admin'){?>
                <!-- 
                HINT: - Here we are setting the productID as a custom attribute (-data_set_current_product_id) 
                       in edit button
                    - This in order to get the current product id and controlling it's js file
                -->
                <button class="btn edit-product" data-set-current-product-id="<?= $productID?>">Edit</button>
                <button class="btn delete-btn" data_set_current_product_id="<?= $productID?>">Delete</button>
                <?php } ?>
            </div>
        </div>


    </div>

    <div class="description-container">
        <h3 class="title"><?= $currentProduct['productName']?></h3>
        <!--  getting the product description -->
        <?= $currentProduct['productDescription'] ?>
    </div>
</div>