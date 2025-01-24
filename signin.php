<?php
require('config/constants.php');


$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);
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
        <div class="container from_section-container">
            <h2>Sign in</h2>
            <?php
            if (isset($_SESSION['signup-success'])) { ?>
                <div class="alert_message success">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']);
                        ?>
                        </p>
                </div>
                <?php
            }
            elseif (isset($_SESSION['signin'])) {  ?>
                <div class="alert_message error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']);
                        ?>
                        </p>
                </div>
                <?php
            }

            ?>
            <form action="<?= ROOT_URL ?>signin-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="username_email" value="<?=$username_email?>" placeholder="Username or Email">
                <input type="password" name="password" value="<?=$password?>"  placeholder="Password">
                <button type="submit" name="submit" class="btn">Sign in</button>
                <small>Don't have a Account? <a href="<?= ROOT_URL ?>signup.php">Sign Up</a></small>
            </form>
        </div>
    </section>
</body>

</html>