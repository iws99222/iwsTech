<!-- THIS PAGE IS RESPONSILE FOR RETRIEVING ALL CATEGORIES -->

<?php
// this list, will be holding all categories fetched
// will be used in all needed pages
$fetched_categories = [];

 // including connection.php
include "connection.php";

// getting all categories query
$getAllCategoriesQuery = 'SELECT * FROM Category';
// executing the query
$result = mysqli_query($db , $getAllCategoriesQuery) or die(mysqli_error($db));
// getting all the categories
while($row = mysqli_fetch_assoc($result)){
    // we are filling the 'fetch_categories' with all rows inside table
    // so we will be using it globally
    $fetched_categories[]= $row;
}
?>