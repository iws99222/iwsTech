<!-- THIS FILE IS RESPONSIBLE FOR UPDATING PRODUCT -->
<?php

// including connection.php
include 'connection.php';


if($_SERVER['REQUEST_METHOD']== 'POST'){
    // getting the product id
    $productID = $_POST['productID'];  
    $productName  = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = intval($_POST['productPrice']);
    echo '<p>Product id:'.$productID.'</p>';
    
    // we are checking here if the 'productImage' is set
    if(isset($_FILES['fileImage']) && $_FILES['fileImage']['error'] === 0 ){
     // if it's set, this means that the admin has changed the photo of the product
        echo 'product image changed';
        // getting the updated file image
        $fileImage = $_FILES['fileImage'];
        // including the 'upload.php' file 
        include 'uploadFile.php';
        // Now the new image is uploaded to the folder
        // we are ready to update the photo in the table
        $updateQuery = "
        UPDATE Products
        set productName='$productName', productDescription = '$productDescription', price = $productPrice, productImage = '$newImageFileName'
        where productID = $productID;
        ";
    }else{
      // else, we must do nothing with the productImage in the table
        echo 'product image still same';
    // the query must only update the title, desc, and price
    // now setting the update query
    $updateQuery = "
    UPDATE Products
    set productName='$productName', productDescription = '$productDescription', price = $productPrice
    where productID = $productID
    ";

  }
    // exeuting the update query
    $result = mysqli_query($db, $updateQuery) or die(mysqli_error($db));
    if($result){
        header('Location:../../pages/nav-screens/main.php');
    }
}