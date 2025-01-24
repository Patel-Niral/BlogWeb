<?php
// admin/config
require '../partials/header.php';

// fetching user details



if(!isset($_SESSION['user_id'])){
    header('location:' . ROOT_URL . 'signup.php');
}

?>

