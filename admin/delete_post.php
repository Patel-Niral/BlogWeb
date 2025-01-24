<?php

require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Correct table name here
    $query = "SELECT * FROM posts WHERE id = '$id'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail_name;

        if (file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }

        $delete_post_query = "DELETE FROM posts WHERE id = '$id' LIMIT 1";
        $delete_post_result = mysqli_query($conn, $delete_post_query) or die(mysqli_error($conn));

        if ($delete_post_result) {
            $_SESSION['delete-post-success'] = "Post deleted successfully.";
        }
    } else {
        $_SESSION['delete-post-error'] = "Post not found.";
    }
}

header('location:' . ROOT_URL . 'admin/');
die();
