<?php

require 'config/database.php';

if (isset($_POST['submit'])) {

    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_password = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    if (!$firstname) {
        $_SESSION['add-user'] = "Please enter your first name";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "Please enter your last name";
    } elseif (!$username) {
        $_SESSION['add-user'] = "Please enter your username";
    } elseif (!$email) {
        $_SESSION['add-user'] = "Please enter a valid email";
    } elseif (strlen($createpassword) < 8) {
        $_SESSION['add-user'] = "Password must be at least 8 characters";
    } elseif (strlen($createpassword) < 8) {
        $_SESSION['add-user'] = "Password must be at least 8 characters";
    } elseif ($createpassword !== $confirm_password) {
        $_SESSION['add-user'] = "Passwords do not match";
    } elseif (!$avatar['name']) {
        $_SESSION['add-user'] = "Please select an image";
    } else {
        $hashedpassword = password_hash($createpassword, PASSWORD_DEFAULT);

        // Check if user already exists
        $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $user_check_result = mysqli_query($conn, $user_check_query);

        if (mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['add-user'] = "Username or email already exists";
        } else {
            // Handle avatar upload
            $time = time();
            $avatar_name = $time . $avatar['name'];
            $avatar_temp_name = $avatar['tmp_name'];
            $avatar_destination_path = "../images/" . $avatar_name;
            $allowed_extensions = ['png', 'jpg', 'jpeg'];
            $extension = pathinfo($avatar_name, PATHINFO_EXTENSION);

            if (in_array($extension, $allowed_extensions)) {
                if ($avatar['size'] < 10000000) {
                    move_uploaded_file($avatar_temp_name, $avatar_destination_path);
                } else {
                    $_SESSION['add-user'] = "Image size is too large";
                }
            } else {
                $_SESSION['add-user'] = "Invalid file type";
            }

            // check for any previous error or active session if session exists it will skip below if block
            if (!isset($_SESSION['add-user'])) {
                $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashedpassword', '$avatar_name', '$is_admin')";
                $insert_user_result = mysqli_query($conn, $insert_user_query);
                    //below block check that insert query is executed or not
                if (!$insert_user_result) {
                    die("Database query failed: " . mysqli_error($conn));
                } else {
                    $_SESSION['add-user-success'] = "Registration Successful, Please log in";
                    header('location:' . ROOT_URL . 'admin/manage_user.php');
                    exit;
                }
            }
        }
    }
///redirect to add-user page if any error
    if (isset($_SESSION['add-user'])) {
        $_SESSION['add-user-data'] = $_POST;
        header('location:' . ROOT_URL . 'admin/add_user.php');
        exit;
    }
} else {
    header('location:' . ROOT_URL . 'admin/add_user.php');
    exit;
}
