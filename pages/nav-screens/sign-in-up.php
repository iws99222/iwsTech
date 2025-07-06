<!-- MAIN SIGN_IN and Register Screen -->
<?php
session_start();


/*
Sometimes, i navigate back into this page in fault.
I want when starting the page checking if the user signed in
to redirect him to the main page, not stucking on this login pagr
*/
if(isset($_SESSION['username'])){ // so if the username exists, this means that user still signed in
    header('Location:main.php'); // heading to main page
}
?>

<head>
    <!-- including the header -->
    <?php
        include '../../pages/components/header.html'?>
    <link rel="stylesheet" href="../../styles/signInUpStyle.css" />
    <!-- this for custom dialog -->
    <link rel="stylesheet" href="../../styles/custom-dialog.css" />
    <!-- outer links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <!-- the whole background image -->
    <img class="background-image" />
    <!-- main container -->
    <div class="container">
        <div class="form-box login">
            <form id="sign-in-form">
                <!-- login section  -->
                <div class="box">
                    <h1>Login</h1>
                    <div class="upper-box">
                        <!-- enmail box -->
                        <div class="input-box">
                            <input class="my-input" type="email" placeholder="Email" value="" name="email" required
                                autofocus />
                            <i><img src="../../drawables/icons/ic_email" /> </i>
                        </div>
                        <!-- pass box -->
                        <div class="input-box password-container">
                            <input class="my-input" type="password" placeholder="Password" value="" name="password"
                                required />
                            <i><img class="password-visibility" src="../../drawables/icons/ic-eye-closed" /> </i>
                            <i><img src="../../drawables/icons/ic_lock" /> </i>
                        </div>
                        <!-- remember me switch -->
                        <div class="remember-me-container">
                            <input class="keep-sign-in-box" type="checkbox" name="keep-sign-in" />
                            <label for="Remember Me">Keep me logged in</label>
                        </div>
                        <br>
                        <button type="submit" class="btn login-btn" name="submit-login">Log In</button>
                    </div>
                    <!-- dont have an account text  -->
                    <div>
                        <p>
                            Don't have an account?
                            <a class="link register-link-txt">Register</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
        <!-- register section  -->
        <div class="form-box register">
            <form id="register-form" autocomplete="off">
                <div class="box">
                    <!-- register  -->
                    <h1>Register</h1>
                    <div class="upper-box">
                        <div class="input-box">
                            <!-- username input -->
                            <input class="my-input" type="text" placeholder="Name" name="username" required />
                            <i><img src="../../drawables/icons/ic_user" /> </i>
                        </div>
                        <!-- email input -->
                        <div class="input-box">
                            <input class="my-input" type="email" placeholder="Email" name="email" required />
                            <i><img src="../../drawables/icons/ic_email" /> </i>
                        </div>
                        <!-- password input -->
                        <div class="input-box password-container">
                            <input class="my-input password" type="password" placeholder="Password" name="password"
                                required />
                            <!-- password visibility -->
                            <i><img class="password-visibility" src="../../drawables/icons/ic-eye-closed" /></i>
                            <i><img src="../../drawables/icons/ic_lock" /> </i>
                        </div>
                        <!-- confirm password input -->
                        <div class="input-box password-container">
                            <input class="my-input confirm-password" type="password" placeholder="Confirm Password"
                                onchange="" name="confirm-password" required />
                            <i><img class="password-visibility" src="../../drawables/icons/ic-eye-closed" /> </i>
                            <i><img src="../../drawables/icons/ic_lock" /> </i>
                        </div>

                        <button type="submit" class="btn register-btn">Register</button>
                        <!-- this will be showing if 'password' and 'confirm password' not match -->
                        <p style="
                        display:none;
                        color:red;
                        margin-top:30px;
                        font-weight:bolder" id="error"></p>
                    </div>
                    <!-- already have an account -->
                    <div class="lower-box">
                        <p>
                            Already have an account?
                            <a class="link login-link-txt">Log in</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>

        <!-- this is the moved panel  -->
        <div class="panel">
            <!-- setting a simple video -->
            <!-- auto playing, muted, looping 
                without control, user can't control it-->
            <video class="my-panel-video" src="../../drawables/panel_video.mp4" autoplay muted loop></video>
        </div>
    </div>


    <!-- SIGN IN, UP dialog show -->
    <!-- this for showing dialog container -->
    <div class="dialog-container">
        <!-- we are showing the title we want -->
        <h2 class="dialog-title">title</h2>
        <br>
        <!-- and message we want -->
        <p class="dialog-message">message</p>
        <!-- close btn -->
        <button class="close-dialog-btn" type="submit">Close</button>
    </div>
</body>
</div>

<script src="../../javascript/sign-in-up.js">

</script>
</body>

</html>