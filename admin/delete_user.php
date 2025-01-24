<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    //fetching user details
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    //fetch all user details through id
    $user = mysqli_fetch_assoc($result);

    //only one user details is fetched
    if (mysqli_num_rows($result) == 1) {
        //fetching user avatar
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        //delete avatar
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }
    // -----------------------------------------------------------------
    //for later 
    // fetch all thumbnails of user post

    // -----------------------------------------------------------------
    
    //deleteing user
    $delete_user_query = "DELETE FROM users WHERE id = $id";
    $delete_user_result = mysqli_query($conn, $delete_user_query);
    if (mysqli_errno($conn)) {
        $_SESSION['delete-user'] = "Couldn't Delete User {$user['firstname']} {$user['lastname']}";
    } else {
        $_SESSION['delete-user-success'] = "User {$user['firstname']} {$user['lastname']} Deleted Successfully";
    }
}


header('location:' . ROOT_URL . 'admin/manage_user.php');