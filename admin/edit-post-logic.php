<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user_id'];
    $post_id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail = filter_var($_POST['previous_thumbnail'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $thumbnail = $_FILES['thumbnail'];

    // Validate inputs
    if (!$title) {
        $_SESSION['edit-post'] = "Title is required.";
    } elseif (!$category_id) {
        $_SESSION['edit-post'] = "Category is required.";
    } elseif (!$body) {
        $_SESSION['edit-post'] = "Body is required.";
    } else {
        // Handle thumbnail upload
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../images/' . $previous_thumbnail;
            if (file_exists($previous_thumbnail_path)) {
                unlink($previous_thumbnail_path); // Delete old thumbnail
            }

            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;

            $allowed_extensions = ['png', 'jpg', 'jpeg'];
            $extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION);

            if (in_array($extension, $allowed_extensions) && $thumbnail['size'] < 10000000) {
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['edit-post'] = "Invalid file type or size exceeds 10MB.";
            }
        }

        // Ensure only one featured post
        if ($is_featured == 1) {
            $query = "UPDATE posts SET featured = 0";
            mysqli_query($conn, $query);
        }

        // Update post in database
        $thumbnail_post = $thumbnail_name ?? $previous_thumbnail;
        $query = "UPDATE posts 
                  SET title='$title', body='$body', thumbnail='$thumbnail_post', category_id='$category_id', author_id='$author_id', featured='$is_featured' 
                  WHERE id='$post_id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['edit-post-success'] = "Post updated successfully.";
            header('Location: ' . ROOT_URL . 'admin/');
            exit();
        } else {
            $_SESSION['edit-post'] = "Failed to update post.";
        }
    }

    // Redirect back if there's an error
    $_SESSION['edit-post-data'] = $_POST;
    header('Location: ' . ROOT_URL . 'admin/edit_post.php?id=' . $post_id);
    exit();
}

header('Location: ' . ROOT_URL . 'admin/');
exit();
