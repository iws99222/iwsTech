<!-- THIS PAGE IS THE RESPONSIBLE FOR RETREIVING ALL PRODUCTS -->


<!-- including the style of the product card list -->
<link rel="stylesheet" href="../../styles/product-card.css" />


<?php
include 'connection.php';
$all_fetched_products =[];
/* // NOTE:
        - 'getProductsQuery': will be defined in other pages
        'such as: -In 'Home' page, we will get only the latest 10 in desc
                    - In 'Categories' we will be using join tables, in order to get
                    p roducts with respect to chosen category. 
        - Every page, we will execute different queries

*/

// now we will execute the query
$result = mysqli_query($db, $getProductsQuery) or die(mysqli_error($db));
while($row = mysqli_fetch_assoc($result)){
    // fetching each row and appending in the list
    $all_fetched_products[] = $row;
}?>
<!-- the main products section -->
<section class='products-section'>
    <?php
    // getting all fetched products and viewing 
    foreach($all_fetched_products as $product):?>
    <!-- main product card  -->
    <div class="product-card" data-set-product-id="<?= 
    // I am adding here the attribute 'data-set-productid'
    // because, when i click on each product, i want to send the 
    // product id saved on this data-set in order to POST it and view the 
    // selected product details.
    $product['productID']?>" onclick="   
    /**** 
     REGISTERING ON CLICK ON EACH PRODUCT, EACH TIME I CLICK ON PRODUCT
     I WANT TO NAVIGATE TO PRODUCT DETAILS PAGE
     ****/  
     // ------------- STEP 1:      
             // Get the main container where content will be replaced
            var mainContainer = document.querySelector('.main-container');
            // Getting the product id which we set as attribute
            var productID = this.getAttribute('data-set-product-id');

            // creating and configuring the AJAX request to fetch product detail
            var viewPageRequest = new XMLHttpRequest();
            // open request
            viewPageRequest.open('POST', '../../database/viewProduct.php');
            // setting form  request header to the request
            viewPageRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // on loading request
            viewPageRequest.onload = function () {
                // checking the request status if success
                if (viewPageRequest.status === 200) {
                // so i am getting the response text from the 'viewProduct' page
                // and setting it in the main container
                console.log('status Successful');
                // Replace the main container's content with the response (product detail HTML)
                mainContainer.innerHTML = viewPageRequest.responseText;
                // appending script file
                 const script = document.createElement('script');
                script.src = '../../javascript/viewProduct.js';
                mainContainer.appendChild(script); 
                
                } else {
                console.log('status not successful');
                }
            };
            // finally sending the ajax, appending the product id (from data-set which we set)
            viewPageRequest.send('productId=' + productID);">

        <!-- product image -->
        <img src="../../drawables/uploaded-images/<?= $product['productImage']?>" alt="" />
        <!-- product name -->
        <p><?= $product['productName']?></p>
        <!-- product price with ONLY text -->
        <h4 id="product-card-price">
            <!-- formatting number in order to show as double -->
            $ <?= number_format($product['price'],2)?><span id="for-only-txt">_only_</span>
        </h4>
    </div>
    <?php endforeach ?>
</section>