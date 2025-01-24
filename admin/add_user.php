<?php 
include ('partials/header.php');

// data is restore if there is an error like in google form if there is erroe the data is not changed
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;

//delete session
unset($_SESSION['add-user-data']);

?>
<!DOCTYPE html>
<html lang="en">


    <section class="form_section">
        <div class="container form_section-container">
            <h2>Add user</h2>
            <?php
            if (isset($_SESSION['add-user'])) { ?> 
                <div class="alert_message error">
                    <p><?php echo $_SESSION['add-user']; 
                    unset($_SESSION['add-user'])
                    ?></p>
                    </div>
                <?php
            }?>

            <form action="<?= ROOT_URL?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="first name">
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="last name">
                <input type="text" name="username" value="<?= $username ?>" placeholder="user name">
                <input type="email" name="email" value="<?= $email ?>" placeholder="email">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
               <select name="userrole" id="">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
                <div class="form_control">
                    <label for="avatar"></label>
                    <input type="file" id="avatar" name="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Add User</button>
            </form>
        </div>
    </section>

    <?php include ('../partials/footer.php') ?>


</body>

</html>