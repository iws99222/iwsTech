<?php
// first we must require the 'connection.php'
include 'connection.php';

// $username = 'Issa Walid Sleiman';
// $email= "iws@gmail.com";
// $password="1234";
// now we are getting the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


// after getting the password, we need to hash it
// because we want to saved the password hashed
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// now we will start the insert query
$insertQuery = $db ->prepare( "INSERT INTO Users (username,email,hashed_password) VALUES (?,?,?)");
// binding params: sss which means all values are string
$insertQuery ->bind_param("sss",$username , $email,$hashed_password);
if($insertQuery ->execute() === TRUE){
    echo "success";
}else{
    echo "Something went wrong.Please try again";
}