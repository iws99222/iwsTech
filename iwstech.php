<!-- 
- This page is the main page
- In this page we are controlling the landing page
- Here we will check the user if he when he logged in, he want to be signed in
or not.
- If yes, we will redirect this page immediately into the main page, else
into the sign-in-up page


-->
<?php
// starting the session
session_start();
// requiring db
require 'database/connection.php';
// we are checking, if the userId cookie is set and exists, this means that the user want to be logged in
if(isset($_COOKIE['userID'])){
    
    echo 'You are still signed in bro!!';
    // so we will fetch all the signed in user's information from the table

    // first preparing the query
    $getCurrentUserQuery = "SELECT * FROM Users where userID=".$_COOKIE['userID'];
    // $query = $db->prepare('select * from users where userID=?');
    // executing the query
    $result = mysqli_query($db , $getCurrentUserQuery) or die(mysqli_error($db));
    if($result){
        $currentUser = mysqli_fetch_assoc($result);
        //* setting up the session

        // current user uid
        $_SESSION['uid'] = $currentUser['userID'];
        // username
        $_SESSION['username'] = $currentUser['username'];
        // profile photo
        $_SESSION['photo'] = $currentUser['profilePhoto'];
        // role
        $_SESSION['role'] = $currentUser['role'];
        // email
        $_SESSION['email'] = $currentUser['email'];
       

        // finally redirecting to main page
        header('Location:../pages/nav-screens/main.php');
    } else {

    // otherwise, there's no saved cookie, which means the user will be signed out
    // when he open this page next time
    include 'database/logout.php';
    }  
}else {
    echo 'no saved accounts:(';
    // redirecting into sign-in-up page
    header('Location:../pages/nav-screens/sign-in-up.php');
}


?>