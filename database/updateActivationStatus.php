<?php

// including the connection
include 'Connection.php';

// Check if both 'activationStatus' and 'currentUserID' is set
// if (isset($_POST['activationStatus'], $_POST['currentUserID'])) {
    $activationStatus = $_POST['activationStatus'];
    $userID = intval($_POST['currentUserID']);

    echo 'Activation Status:'.$activationStatus;
    echo 'Current User ID:'. $userID;

   
   

   // preparing the query that will update the activation status
    $updateStatusQuery = "
        UPDATE Users
        SET status = $activationStatus
        WHERE userID = $userID;
        
    ";
    $result = mysqli_query($db , $updateStatusQuery) or die(mysqli_error($db));
    if($result){
        echo "Successfully";
    }else{
        echo "failed";
    }


?>