<?php
require 'config/constants.php';


// connect database
$conn = new mysqli(db_host,db_user,db_pass,db_name);

if(mysqli_errno($conn)){
    die(mysqli_error($conn));
}