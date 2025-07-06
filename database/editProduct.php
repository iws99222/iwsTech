<!-- THIS FILE RESPPONSIBLE FOR VIEWING AND EDITING A PRODUCT -->
<?php

session_start();

    include 'connection.php';
    include '../pages/components/header.html';

    // getting the selected product id from the url
    $productID = $_POST['productID'] ?? 17;
   

    // setting the query to retrieve the info of the selected product
    $query = "
    SELECT * 
    FROM Products
    Where productID = $productID;
    ";

    // start the result query
    $result = mysqli_query($db , $query) or die (mysqli_error($db));
    // getting the result
    $currentProduct = mysqli_fetch_assoc($result);
?>

<!-- including style of editProduct -->
<link rel="stylesheet" href="../../styles/editProduct.css">
<!-- edit form data -->
<form action="../../database/updateProduct.php" method="POST" enctype="multipart/form-data">
    <!-- edit product container -->
    <div class="edit-product-container">
        <!-- info container -->
        <div class="product-info-container">
            <img id="changed-photo-preview" src="../../drawables/uploaded-images/<?=$currentProduct['productImage']?>"
                alt="current_product_img" />
            <!-- product name -->
            <div>
                <label for="">Product ID</label>
                <input type="number" name="productID" value=<?= $productID?> readonly />
                <!-- product name -->
                <label for="product-name-Field">Product
                    Name *</label>
                <input type="text" id="product-name-field" name="productName"
                    value="<?= $currentProduct['productName']?>" />
                <!-- product price -->
                <label for="prodcut-price-field">Product Price*</label>
                <input type="number" id="product-price-field" name="productPrice"
                    value="<?= number_format($currentProduct['price'],2) ?>" />
            </div>
        </div>
        <br>
        <!-- image file input -->
        <input type="file" id="product-image-input" name="fileImage" accept="image/*" hidden>
        <label for="product-image-input" class="btn-change-product-image">Change Photo</label>
        <br>
        <!-- description container -->
        <div class="description-container">
            <h1>Description</h1>
            <textarea name="productDescription"><?= $currentProduct['productDescription'] ?></textarea>
        </div>

        <!-- save button -->
        <button type="submit" class="btn save">Save</button>
</form>