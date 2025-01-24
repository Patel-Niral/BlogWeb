<?php
require 'config/database.php';
// categories  category
if (isset($_GET['id'])) {
    //fetching user details
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categories WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    //fetch all user details through id
    $category = mysqli_fetch_assoc($result);

  
    //deleteing categories
    $delete_category_query = "DELETE FROM categories WHERE id = $id";
    $delete_category_result = mysqli_query($conn, $delete_category_query);
    if (mysqli_errno($conn)) {
        $_SESSION['delete-category'] = "Couldn't Delete category {$category['title']}";
    } else {
        $_SESSION['delete-category-success'] = "category {$user['title']}Deleted Successfully";
    }
}


header('location:' . ROOT_URL . 'admin/manage_category.php');