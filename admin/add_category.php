<?php 
include ('partials/header.php');
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">

    <section class="form_section" >
        <div class="container form_section-container">
            <h2>Add Categories</h2>
            <form action="<?= ROOT_URL ?>admin/add-category-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="title" placeholder="Title" required>
                <textarea name="description" id="" rows="4"  placeholder="description" required></textarea>
                <button type="submit" name="submit" class="btn">Add categories</button>
            </form>
        </div>
    </section>

    <?php include ('../partials/footer.php') ?>

</body>

</html>