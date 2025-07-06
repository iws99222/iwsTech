<?php

// starting session if not exists
if(session_id() === ""){
session_start();
}


// creating the main navList here
// each nav containing: label, icon, and destination which will be the 'data-page'
// this is the default nav list
$navList = [
    ["className" => "nav-container","label" => "Home", "icon" => "ic_home.png", "destination" => "home.php"],
    // this will have different class, since it's not clickable
    ["className" => "nav-container category","label" => "Categories", "icon" => "ic_categories.png", "destination" => "categories.php"],
   
];  
// now we will check the user logged in if 'admin' or not
if($_SESSION['role'] === 'Admin'){
    // if admin, we will show the additional tabs, 'Manage Users' and 'Add Product'
$navList = array_merge($navList, [
    ["className" => "nav-container",'label' => 'Manage Users' , 'icon' => 'ic-manage.png' ,'destination' =>'manageUsers.php'],
    ["className" => "nav-container",'label' => 'Add Product' , 'icon' => 'ic-add.png' ,'destination' =>'addProduct.php'],
]);
}  

$navList[] = ["className" => "nav-container","label" => "Log out", "icon" => "ic-logout.png", "destination" => "log out.php"];
?>

<head>
    <link rel="stylesheet" href="../../styles/globalStyle.css">
    <link rel="stylesheet" href="../../styles/main-nav-bar.css">
</head>
<header>
    <nav class="main-nav-bar">
        <!-- starting building the navigation bar -->

        <!-- site logo -->
        <img class="nav-logo" src="../../drawables/logo-white.png" />
        <ul>
            <!-- preparing the nav list -->
            <?php foreach($navList as $navItem): ?>
            <li class="<?= $navItem['className'] ?>" data-page="<?= $navItem['destination'] ?>">
                <div class="nav-icon-lbl-container">
                    <img src="../../drawables/icons/<?= $navItem['icon'] ?>" alt="<?= $navItem['label'] ?> icon"
                        class="nav-icon" />
                    <span class="nav-link"><?= $navItem['label'] ?></span>
                </div>
                <!-- this list here will be only for category nav item -->
                <!-- in order to show it as a drop down when hovering on category -->
                <?php if($navItem['label'] == 'Categories'){ ?>
                <ul class="categories-drop-list">
                    <li class="category-drop-item">All Categories</li>
                    <!-- <li class="category-drop-item">All</li> -->
                    <?php
                    // including the 'getAllCategories.php'
                    // in order to get the categories
                    include '../../database/getAllCategories.php';
                    // preparing categories drop down menu list
                    foreach($fetched_categories as $category):
                    ?>
                    <!-- adding each fetched category in the drop list  -->
                    <li class='category-drop-item'>
                        <?= $category['categoryName']?>
                        <?php endforeach ?>
                    </li>
                </ul>
                <?php } ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <!-- user welcoming & profile -->
        <div class=" user-welcoming">
            <!-- welcoming (role: admin or user) -->
            <p>Welcome <span class="nav-user-role"><?= $_SESSION['role']?>,</span> <strong
                    class="nav-username"><?= $_SESSION['username'] ?></strong></span></p>
            <!-- user profile photo -->
            <!-- navigating to drawables/uploaded-images/currentUserProfilePhoto -->
            <img class="nav-bar-profile-icon" src="../../drawables/uploaded-images/<?= $_SESSION['photo'] ?>"
                alt="user_profile">


            <!-- user profile container -->
            <div class="user-profile-container">
                <!-- edit profile form -->
                <form id="editProfileForm" action="../../database/updateUserInfo.php" method="POST"
                    enctype="multipart/form-data">
                    <div class="profile-image-section">
                        <img src="../../drawables/uploaded-images/<?= $_SESSION['photo']?>" alt="Profile Picture"
                            id="profilePreview">
                        <!-- we set it disable, because we won't show the default file choose, we
                         will show a label in button style  -->
                        <input type="file" class="image-input" id="profilePictureInput" name="fileImage"
                            accept="image/*" hidden>
                        <!-- change photo label button -->
                        <label for="profilePictureInput" class="lbl-btn-change-photo">Change Photo</label>
                    </div>
                    <!-- full name form group -->
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <!-- getting the current username form the session -->
                        <input type="text" id="name" name="updatedUsername" value="<?= $_SESSION['username'] ?>">
                    </div>
                    <!-- email address form group -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <!-- getting the current user email from the session -->
                        <input type="email" id="email" name="email" value="<?= $_SESSION['email']?>" disabled>
                    </div>
                    <!-- btn save changes -->
                    <button class="btn-save-changes" type="submit">Save Changes</button>
                </form>
            </div>
        </div>

    </nav>

</header>


<script src="../../javascript/main-nav-bar.js"></script>