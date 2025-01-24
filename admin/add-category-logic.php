<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // getting data 
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // echo "$title $description";

    if (!$title) {
        $_SESSION['add-category'] = "Enter title";
    } elseif (!$description) {
        $_SESSION['add-category'] = "Enter description";
    }

    // // redirect to category page
    if (isset($_SESSION['add-category'])) {
        $_SESSION['add-category-data'] = $_POST;
        header('location:' . ROOT_URL . 'admin/add_category.php');
        die();
    }
    else {
        // insert in DB
        $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_errno($conn)) {
            $_SESSION['add-category'] = "Couldn't add category";
            header('location:' . ROOT_URL . 'admin/add_category.php');
            die();
        } else {
            $_SESSION['add-category-success'] = "Category added successfully";
            //do header to manage_category
            header('location:' . ROOT_URL . 'admin/manage_category.php');
            die();
        }
    }
}
