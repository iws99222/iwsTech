<!-- when user log out, all of these above will be needed -->
<?php

// first we are starting session
session_start();

// unsetting all session variables
session_unset();
// destroying it
session_destroy();

// also, deleting all cookies
setcookie("userID","",time()- 3600 , "/");
// back to sign in up page
header('Location:../../pages/nav-screens/sign-in-up.php');



?>