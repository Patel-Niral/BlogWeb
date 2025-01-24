<?php

require 'config/database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user_id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var( $_POST['category'], FILTER_SANITIZE_NUMBER_INT);

    // checking if post is featured if created normaly like other it will generate error as defalut vale is 0 and it means false in backend
    $is_featured = filter_var(isset($_POST['is_featured']) ? 1 : 0, FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

   


    //validate
    if (!$title) {
        $_SESSION['add-post'] = "Enter title";
    }

    // below comment block prevent null condition in category i.e user has to compulsory choos 1 category 
    //  elseif (!$category_id) {
    //     $_SESSION['add-post'] = "Select category";
    // }
     elseif (!$body) {
        $_SESSION['add-post'] = "Enter body";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "choose thumbnail";
    } else {

        /// work on thumnail
        //rename image
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];

        /// IT should BE tmp not temp( pre built)
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/'.$thumbnail_name;

        //checking file type
        $allowed_extensions = ['png', 'jpg', 'jpeg'];
        $extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION);

        if (in_array($extension, $allowed_extensions)) {
            if ($thumbnail['size'] < 10000000) {
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['add-post'] = "Image size is too large > 10MB";
            }
        } else {
            $_SESSION['add-post'] = "Invalid file type";
        }

    }


    //if any error like connection
    if (isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('Location:'.ROOT_URL.'admin/add_post.php');
        die();
    }
    else{
        //Below code make sure that there only 1 featured post
        if($is_featured == 1){
            $zero_all_featured_post_query = "UPDATE posts SET featured = 0";
            $zero_all_featured_post_result = mysqli_query($conn, $zero_all_featured_post_query);
        }

        //inserting post in DB
        $query = "INSERT  INTO posts (title, body, thumbnail, category_id, author_id, featured) VALUES ('$title', '$body', '$thumbnail_name', '$category_id', '$author_id', '$is_featured')";
        $result = mysqli_query($conn, $query);

        if(!mysqli_errno($conn)){
            $_SESSION['add-post-success'] = "Post Uploaded Successfully";
            header('location:'.ROOT_URL.'admin/');
            die();
        }

    }

    //////////
}

header('location:'.ROOT_URL.'admin/add_post.php');
die();