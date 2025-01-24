<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $userrole = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    //check valid input
    if (!$firstname) {
        $_SESSION['add-user'] = "Please Edit Firstname ";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "Please Edit Lastname ";
    } else {
        $update = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', is_admin = '$userrole'  WHERE id = '$id' LIMIT 1 ";
        $result = mysqli_query($conn, $update);
        if($result){
            $_SESSION['edit-user-sucess'] = "User Updated Successfully";
            header('location:' . ROOT_URL . 'admin/manage_user.php');
        }
        //if any error in connection
        if (mysqli_errno($conn)) {
            $_SESSION['edit-user'] = "Error Updating User";
        }
    }
}

header('location' . ROOT_URL . 'admin/edit_user.php');
die();