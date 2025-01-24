<?php
include('./partials/header.php');
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categories WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $fetch = mysqli_fetch_assoc($result);
    }
} else {
    header('location:' . ROOT_URL . 'admin/manage_category.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">



<section class="form_section">
    <div class="container form_section-container">
        <h2>Edit Categories</h2>


        <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" enctype="multipart/form-data" method="POST">

            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="text" name="title" value="<?= $fetch['title'] ?>" placeholder="Title">
            <textarea name="description" rows="4" placeholder="description"><?= $fetch['description'] ?></textarea>
            <button type="submit" name="submit" class="btn">Update categories</button>
        </form>
    </div>
</section>

<?php include('../partials/footer.php') ?>

</body>

</html>