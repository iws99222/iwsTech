<!-- This page is responsible for saving user profile -->
<?php
   // ensuring session null before starting it 
   if(session_id() == ""){
    session_start(); // we will use it for retieving the current user id, in order to update his profile
   }

  // including connection
  include 'connection.php';

  // ensuring the request method 
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // now we want to ensure the updated username is set
    if(isset($_POST['updatedUsername'])){
    // getting user id from session
    $currentUserID = $_SESSION['uid'];
    // getting the updated username
    $updatedUsername = $_POST['updatedUsername'];
    // getting the updated user profile
    $updatedProfile = $_FILES['fileImage'];
    // we want to ensure that the user has picked a photo
    if(isset($_FILES['fileImage']) && $_FILES['fileImage']['error'] === 0){
        // so if the updated profile is set, and the error is === 0, this means that the user
        // has uploaded a profile photo
        // setting up the image
        $fileImage = $_FILES['fileImage'];
        // including 'uploadFile.php' to execute the image upload
        include 'uploadFile.php';
        // Now the new profile is uploaded to the folder
        // we are ready to update the user's photo
        $updateQuery = "
            UPDATE Users
            SET username = '$updatedUsername',
            profilePhoto = '$newImageFileName'
            where userID = $currentUserID;
            ";
        // updating the 'photo' in the session, to load the new photo when
        // starting the main screen
        $_SESSION['photo'] = '../../drawables/uploaded-images/'.$newImageFileName;
        echo 'User has updated his profile successfully';
    }else{
        // executing the query that only update username 
        echo "User didn't update his profile picture";
        $updateQuery = "
        UPDATE Users
        SET username = '$updatedUsername'
        where userID = $currentUserID;
        ";
    }


    // executing the query
    $result = mysqli_query($db, $updateQuery) or die(mysqli_error($db));
    // checking the result
    if($result){
        echo 'Updated Success';
        // updating session username in order to get the values when refreshing
        $_SESSION['username'] = $updatedUsername;
         // reloading the main page
         header('Location:../pages/nav-screens/main.php');
    }
}
}

?>