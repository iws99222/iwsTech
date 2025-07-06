<?php
// including the main connection
include '../database/connection.php';



if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['submit'])){
    // getting all information of the new product adding
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    // casting the price to float
    $productPrice = floatval($_POST['productPrice']);
    // casting the categoryId to int
    $categoryID = intval($_POST['categoryID']);

 
    // we want to check if admin chosen an image for the added product
    // Check if a product image was uploaded and there's no error
    if (isset($_FILES['fileImage']) && $_FILES['fileImage']['error'] === 0) {
    echo 'Product image set';

    // Retrieve the uploaded image file data
    $fileImage = $_FILES['fileImage'];

    // Include the uploadFile.php script to handle moving the uploaded image
    // This script should return or define $newImageFileName after saving the file
    include '../database/uploadFile.php';

    // Insert the product details into the database, including the image filename
    $insertQuery = "
        INSERT INTO Products (categoryID, productName, productDescription, productImage, price) 
        VALUES ($categoryID, '$productName', '$productDescription', '$newImageFileName', $productPrice)";
    } else {
    echo 'Product image not set';

    // Insert the product details into the database without an image
    $insertQuery = "
        INSERT INTO Products (categoryID, productName, productDescription,productImage, price) 
        VALUES ($categoryID, '$productName', '$productDescription','ic_product_placeholder.png', $productPrice)";
    }

    // now we will execute the insert query
    $result = mysqli_query($db, $insertQuery) or die(mysqli_error($db));

    // checking the result
    if($result){
        echo "Inserted Successfully";
        // so we will be heading to the main page
        header('Location:../../pages/nav-screens/main.php');
    }else{
        echo 'Something went wrong in insertion';
    }
}