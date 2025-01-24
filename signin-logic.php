<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION['signin'] = "Enter Username OR Email";
    } elseif (!$password) {
        $_SESSION['signin'] = "Enter password";
    } else {
        $fetch_user_query = "SELECT * FROM users WHERE username = '$username_email' OR email = '$username_email'";
        $fetch_user_result = mysqli_query($conn, $fetch_user_query);

        // check if user exists
        if (mysqli_num_rows($fetch_user_result) == 1) {
            $user_data = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_data['password'];
            //checking if password match
            if (password_verify($password, $db_password)) {
                //set session for access
                $_SESSION['user_id'] = $user_data['id'];
                //  set session if user is admin//
                if ($user_data['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }

                header('location:' . ROOT_URL . 'admin/');
            } else {
                $_SESSION['signin'] = "Invalid Password";
            }
        }

        //user details is incorrect
        else {
            $_SESSION['signin'] = "Invalid Username OR Email";
        }
    }

    // sign in problem occur
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location:' . ROOT_URL . 'signin.php');
        die();
    }
    ////    
} else {
    header('location : ' . ROOT_URL . 'signin.php');
}
