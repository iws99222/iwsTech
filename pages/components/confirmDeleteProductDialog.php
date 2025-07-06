<?php 
// including header
include '../../pages/components/header.html';

// getting the productID from the url in order to use it when dialog button confirm delete
$productID = $_GET['productId'];

?>

<style>
body {
    margin: 0;
    background-color: #f4f6f8;
}

/* main overlay confirm dialog  container */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(3px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

/* confirm dialog */
.confirm-dialog {
    background: white;
    padding: 30px;
    border-radius: 12px;
    width: 90%;
    max-width: 400px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    text-align: center;
}

/* h2 */
.confirm-dialog h2 {
    margin: 0 0 10px;
    color: var(--red-color);
}

/* p */
.confirm-dialog p {
    margin-bottom: 25px;
    font-size: 16px;
    color: #555;
}

/* confirm dialog buttons */
.dialog-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
}

/* btn specific*/
.btn {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

/* cancel btn */
.btn-cancel {
    background-color: var(--highlight-color);
    color: #2c3e50;
}

/* btn cancel hover */
.btn-cancel:hover {
    background-color: var(--highlight-color);
}

/* btn delete style */
.btn-delete {
    background-color: #e74c3c;
    color: #fff;
}

/* btn delete hover */
.btn-delete:hover {
    background-color: #c0392b;
}
</style>
</head>

<body>

    <!-- main dialog overlay -->
    <div class="overlay" id="deleteDialog">
        <!-- confirm dialog container -->
        <div class="confirm-dialog">
            <!-- dialog title -->
            <h2>Delete Product</h2>
            <!-- dialog description -->
            <p>Are you sure you want to delete this product? This action cannot be undone.</p>
            <!-- dialog buttons -->
            <div class="dialog-buttons">
                <!-- cancel btn -->
                <button class="btn btn-cancel" onclick="
                // navigating to back when cancelling
                window.history.back();
                ">Cancel</button>
                <!-- delete product buttons inside form -->
                <form method="POST" action="../../database/deleteProduct.php">
                    <input type="hidden" name="productId" value="<?=$productID?>">
                    <button type="submit" class="btn btn-delete">Delete</button>
                </form>

            </div>
        </div>
    </div>