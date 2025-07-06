<?php
// starting session
session_start();

// we are checking here, if the session[username] is empty
// this means that the user didn't sign in yet, so will direct
// him to sign-in-up page
if(!isset($_SESSION['username'])){
    // redirecting user to the sign-in-up page
    header('Location:../../pages/nav-screens/sign-in-up.php');
    exit(); // exit
}


// Include the shared HTML header
include '../../pages/components/header.html';
?>

<!-- Link to the main stylesheet -->
<link rel="stylesheet" href="../../styles/main.css">

<!-- THE MAIN BODY -->

<body>
    <!-- Include the site's main navigation bar -->
    <?php include  '../../pages/components/main-nav-bar.php'; ?>

    <!-- Main container where dynamic content will be loaded -->
    <div class="main-container">
    </div>
    <!-- Include the site's footer -->
    <?php include '../../pages/components/footer.html'; ?>
</body>

<!-- Include the main JavaScript file -->
<script src="../../javascript/main.js"></script>
<script src="../../javscript/getProductsByCategory"></script>

</html>