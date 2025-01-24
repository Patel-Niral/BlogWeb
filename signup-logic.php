<?php
session_start();
require 'config/database.php';
//signup from data

if (isset($_POST['submit'])) {

    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_password = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    if (!$firstname) {
        $_SESSION['signup'] = "Please enter your first name";
    } elseif (!$lastname) {
        $_SESSION['signup'] = "Please enter your last name";
    } elseif (!$username) {
        $_SESSION['signup'] = "Please enter your username";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please enter a valid email";
    } elseif (strlen($createpassword) < 8) {
        $_SESSION['signup'] = "Password must be at least 8 characters";
    } elseif ($createpassword !== $confirm_password) {
        $_SESSION['signup'] = "Passwords do not match";
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Please select an image";
    } else {
        $hashedpassword = password_hash($createpassword, PASSWORD_DEFAULT);

        // Check if user already exists
        $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $user_check_result = mysqli_query($conn, $user_check_query);

        if (mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['signup'] = "Username or email already exists";
        } else {
            // Handle avatar upload
            $time = time();
            $avatar_name = $time . $avatar['name'];
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination_path = "images/" . $avatar_name;
            $allowed_extensions = ['png', 'jpg', 'jpeg'];
            $extension = pathinfo($avatar_name, PATHINFO_EXTENSION);

            if (in_array($extension, $allowed_extensions)) {
                if ($avatar['size'] < 1000000) {
                    move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                } else {
                    $_SESSION['signup'] = "Image size is too large";
                }
            } else {
                $_SESSION['signup'] = "Invalid file type";
            }

            if (!isset($_SESSION['signup'])) {
                $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashedpassword', '$avatar_name', 0)";
                $insert_user_result = mysqli_query($conn, $insert_user_query);

                if (!$insert_user_result) {
                    die("Database query failed: " . mysqli_error($conn));
                } else {
                    $_SESSION['signup-success'] = "Registration Successful, Please log in";
                    header('location:' . ROOT_URL . 'signin.php');
                    exit;
                }
            }
        }
    }
///redirect to signup page is any error

    if (isset($_SESSION['signup'])) {
        $_SESSION['signup-data'] = $_POST;
        header('location:' . ROOT_URL . 'signup.php');
        exit;
    }
} else {
    header('location:' . ROOT_URL . 'signup.php');
    exit;
}





































































// OPTIONAL CODE FOR SIGN UP 


/*
if (isset($_POST['submit'])) {

    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_password = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];


    if (!$firstname) {
        $_SESSION['signup'] = "plese enter your first name";
    } elseif (!$lastname) {
        $_SESSION['signup'] = "plese enter your last name";
    } elseif (!$username) {
        $_SESSION['signup'] = "plese enter your user name";
    } elseif (!$email) {
        $_SESSION['signup'] = "plese enter your user name";
    } elseif (!$username) {
        $_SESSION['signup'] = "plese enter your valid email";
    } elseif (strlen($createpassword) < 8) {
        $_SESSION['add-user'] = "Password must be at least 8 characters";
    } elseif (strlen($createpassword) < 8) {
        $_SESSION['add-user'] = "Password must be at least 8 characters";
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "plese select image";
    } else {
        //password check
        if ($createpassword !== $confirm_password) {
            $_SESSION['signup'] = "password not match";
        } else {
            //hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            //check if already user exists
            $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
            $user_check_result = mysqli_query($conn, $user_check_query);
            //check for users row
            $user_check_row = mysqli_num_rows($user_check_result);
            if ($user_check_row == 1) {
                $_SESSION['signup'] = "username or email already exist";
            } else {
                // avatar name
                $time = time(); //is used to make image name like in mobile when we capture image
                $avatar_name = $time . $avatar['name'];
                $avatar_temp_name = $avatar['tmp_name'];
                $avatar_destination_path = "images/" . $avatar_name;

                // check that it is image
                $val_file = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $val_file)) {
                    //make sure image is not too large (> 1 mb)
                    if ($avatar['size'] < 1000000) {
                        //move image to destination
                        move_uploaded_file($avatar_temp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['signup'] = "image size is too large";
                    }
                } else {
                    $_SESSION['signup'] = "file is not valid";
                }
            }
        }
    }
    if (isset($_SESSION['signup'])) {
        //direct again to signup page
        $_SESSION['signup-data'] = $_POST;
        header('location:' . ROOT_URL . 'signup.php');
    } else {
        //insert user into database
        $insert_user_query = "INSERT INTO users (id,firstname, lastname, username, email, password, avatar, is_admin) VALUES (NULL,'$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name' , 0)";
        $insert_user_result = mysqli_query($conn, $insert_user_query);

        if (!mysqli_errno($conn)) {
            //redirect to login page with success message
            $_SESSION['signup-success'] = "Registeration Successful, Please log-in";
            header('location:' . ROOT_URL . 'signin.php');
        }
    }
    /////
} else {
    //direct again to signup page
    header('location:' . ROOT_URL . 'signup.php');
    die();
}
*/