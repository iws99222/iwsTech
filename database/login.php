<?php
session_start();
    // we must include the 'connection.php'
    include 'connection.php';

    // now we want to get the username and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
    // here's the Stay logged in method
    $stay_logged_in = isset($_POST['keep-sign-in']);
    


    // starting the query
    $getUserQuery= $db->prepare('select * from users where email = ?');
    // binding param
    $getUserQuery -> bind_param("s",$email);
    // executing
    $getUserQuery-> execute();
    // getting result of the executing
    $result = $getUserQuery ->get_result();
    // checking if the number of rows >0, means that the user exists
    if($result->num_rows > 0){
        // fetching the user
        $user = $result ->fetch_assoc();
        // here means that the username exists
        // so now we will check the password he wrote if matches that hashed_password(his main pass) 
        if(password_verify($password , $user['hashed_password'])){
            // here, the user has signed in successfully, he wrote the email and password correctly
            
            // we need to check the status of the user's account
            // if status === 0 , this means that deactivated
            if(intval($user['status']) === 0 ){
                    echo 'Account deactivated';
                // exit
                exit();
            }
            // user account is activated, so everything successful
            echo 'successfully signed in';
            // Setting up the sessions

            // user id
            $_SESSION['uid']= $user['userID'];
            // photo
            $_SESSION['photo']=$user['profilePhoto'];
            // name
            $_SESSION['username'] = $user['username'];
            // email
            $_SESSION['email'] = $user['email'];
            // role
            $_SESSION['role'] =$user['role'];

            // Stay SIGNED IN FUNCTIONALITY
            // here we are controlling the staying-logged-in
            // the user controlling 'keep me signed in', so if checked
            // means that will be signed in, otherwise, will be signed out
            // when getting back to the site
            if($stay_logged_in){
                // so here, the user wants to stay logged in. We will
                // save his id in a cookie, when saved, the user when get back to site later
                // we will get his id from cookie, selecting it from the table and log him in
                setCookie('userID',$user['userID'] , time() + 60 * 60 * 24 * 30/* making the cookie lasts for 1 month*/, '/');
            }
        }else{
            echo 'incorrect email/password';
        }
    }else{
        echo "User not found";
    }
   
   
    