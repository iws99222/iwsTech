<!-- THIS PAGE FOR ADDING A NEW ITEM -->
<?php
include '../../pages/components/header.html';
?>

<link rel="stylesheet" href="../../styles/addProduct.css">

<div class="main-container">
    <!-- header -->
    <h2>ADDING A NEW PRODUCT</h2>
    <!-- add item form -->
    <form id="form-add-product" method="POST" action="../../database/insertProduct.php" enctype="multipart/form-data">
        <!-- Image upload input
        by default it's not required, the admin may not upload a picture 
        -->
        <div class="main-photo-section">
            <input id="upload-img" type="file" class="my-input productImage" name="fileImage" accept="image/*" hidden />
            <label for="upload-img" class="btn-upload-photo"><span> <img
                        src="../../drawables/icons/ic_upload.png" /></span>Upload Photo</label>
            <!-- this div includes, the image preview, with delete photo btn -->
            <div class="preview-image-container">
                <!-- this image preview  -->
                <img class="image-preview" />
                <!-- this is the delete btn: deleting the chosen image -->
                <button type="button" class="btn-delete-chosen-img" />
            </div>
            <!-- missing img text -->
            <b id="txt-missing-img">Please select an image</b>
        </div>
        <label>Product Name*</label>
        <!-- product name field -->
        <input class="my-input" type="text" name="productName" placeholder="Product Name" minlength="10" required />
        <!-- product description field -->
        <label>Product Description*</label>
        <textarea class="my-input" name="productDescription" placeholder="Product Description" minlength="10"
            required></textarea>
        <!-- select category select -->
        <label>Select Category*</label>
        <select class="category-select-box" name="categoryID" required>
            <option value="" disabled selected> Select a category</option>
            <!-- now we will fetch all categories -->
            <?php 
             include '../../database/getAllCategories.php';
             foreach($fetched_categories as $category): ?>
            <option value="<?= 
            /*VERY IMPORTANT HINT: we are setting the value here to the categoryID, because we want to insert the id to the products table
            and from this id we will refer to the category table to get the category name later.
            */
            $category['categoryID']?>">
                <!-- but we show in the select, the category name normally -->
                <?=$category['categoryName']?>
            </option>
            <?php endforeach ?>
        </select>
        <label>Price*</label>
        <!-- product price field -->
        <input class="my-input price" type="number" name="productPrice" placeholder="Price" min="1" step="0.01"
            oninput="if (this.value > 100000) this.value = 100000;/* This for validating the price */" required />
        <button type="submit" class="add-btn" name="submit">Add Product</button>
    </form>
</div>

<script src="../../javascript/addProduct.js"></script>