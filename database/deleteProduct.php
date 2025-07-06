<?php

// including connection
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    // now after we confirm the delete product form dialog
    // and gotten the product id
    $productID = $_POST['productId'];

    // we are ready to delete
    $deleteQuery = "DELETE FROM products
                    WHERE productID = $productID;
        ";
    // executing the query
    $result = mysqli_query($db , $deleteQuery) or die(mysqli_error($db));
    // if query success
    if($result){
        // heading to the main page
        header('Location:../../pages/nav-screens/main.php');
    }
}