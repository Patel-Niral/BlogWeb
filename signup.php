<?php
require('config/constants.php');


// data is restore if there is an error like in google form if there is erroe the data is not changed
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

//delete session
unset($_SESSION['signup-data']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Web App</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <section class="form_section">
        <div class="container form_section-container">
            <h2>Sign up</h2>
            <?php
            if (isset($_SESSION['signup'])) { ?> 
                <div class="alert_message success">
                    <p><?php echo $_SESSION['signup']; 
                    unset($_SESSION['signup'])
                    ?></p>
                    </div>
                <?php
            }

            ?>

            <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="first name">
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="last name">
                <input type="text" name="username" value="<?= $username ?>" placeholder="user name">
                <input type="email" name="email" value="<?= $email ?>" placeholder="email">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
                <div class="form_control">
                    <label for="avatar"></label>
                    <input type="file" id="avatar" name="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Sign up</button>
                <small>Already have an Account? <a href="<?= ROOT_URL ?>signin.php">Sign in</a></small>
            </form>
        </div>
    </section>
</body>

</html>