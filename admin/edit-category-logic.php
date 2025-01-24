<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);

    //check valid input
    if (!$title) {
        $_SESSION['edit-category'] = "Please Edit title ";
    } elseif (!$description) {
        $_SESSION['edit-category'] = "Please Edit description ";
    } else {
        $update = "UPDATE categories SET title = '$title', description = '$description'  WHERE id = '$id'  ";
        $result = mysqli_query($conn, $update);
        if($result){
            $_SESSION['edit-category-success'] = "category Updated Successfully";
            header('location:' . ROOT_URL . 'admin/manage_category.php');
        }
        //if any error in connection
        if (mysqli_errno($conn)) {
            $_SESSION['edit-category'] = "Error Updating category";
        }
    }
}

header('location' . ROOT_URL . 'admin/edit_category.php');
die();