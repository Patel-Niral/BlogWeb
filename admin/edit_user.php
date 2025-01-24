<?php
include('partials/header.php');

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);
} else {
    header('location:' . ROOT_URL . 'admin/manage_user.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">


<section class="form_section">
    <div class="container form_section-container">
        <h2>Edit user</h2>


        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" enctype="multipart/form-data" method="post">
            <input type="hidden" value="<?= $fetch['id'] ?>" name="id" placeholder="id">
            <input type="text" value="<?= $fetch['firstname'] ?>" name="firstname" placeholder="first name">
            <input type="text" value="<?= $fetch['lastname'] ?>" name="lastname" placeholder="last name">

            <select name="userrole" id="">
                <option value="0">Author</option>
                <option value="1" <?= $fetch['is_admin'] === "1" ? 'selected' : '' ?>>Admin</option>
            </select>

            <button type="submit" class="btn" name="submit">Update User</button>
        </form>
    </div>
</section>

<?php include('../partials/footer.php') ?>


</body>

</html>