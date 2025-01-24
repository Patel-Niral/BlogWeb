<?php

require 'config/constants.php';

//destroying session and redirect tp sign up page

session_destroy();
header('location:' . ROOT_URL);
die();