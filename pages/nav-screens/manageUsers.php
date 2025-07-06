<?php

// including connection
include '../../database/connection.php';




// preparing the query which will retrieve all users, but we won't show the admin in the user's list
// so we will retrieve only who's role is 'User'
$getAllUsers = "
            SELECT *
            FROM USERS
            where role LIKE '%user%'; 
";
// executing the query
$result = mysqli_query($db , $getAllUsers) or die(mysqli_error($db));


// including header
include '../../pages/components/header.html';


?>
<!-- manage users style-->
<link rel="stylesheet" href="../../styles/manageUsers.css" />
<h1>Manage Users </h1>
<table cellspacing="0" cellpadding="0">
    <!-- headers -->
    <thead>
        <tr>
            <th>Photo</th>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
    while ($row = mysqli_fetch_assoc($result)){  ?>
        <tr>
            <!-- displaying user profile -->
            <td>
                <img src="../../drawables/uploaded-images/<?= $row['profilePhoto'] ?>" alt="user-profile"
                    class="user-profile">
            </td>
            <!-- displaying user id -->
            <td> <?= $row['userID'] ?> </td>
            <!-- Displaying username -->
            <td> <?=$row['username'] ?></td>
            <!-- Displaying email -->
            <td> <?=$row['email'] ?></td>
            <!-- This button is toggle for activating and deactivating user -->
            <td>
                <button class="activation-toggle-btn" data-set-user-id=<?= $row['userID']?>
                    data-set-account-status=<?= intval($row['status'])?>>
                    <!-- we need to check if the user is active or not
                if active, this means that we must set the button text to 'Deactivate'
                else set to 'Activate'
            -->
                    <?php 
              // getting the status of each user, (casting to int)
              echo intval($row['status']) === 0 ? "Deactivate" : "Activate";
            ?>
                </button>
            </td>
        </tr>
        <?php }?>
    <tbody>
</table>