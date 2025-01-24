<?php
include('partials/header.php');


// data is restore if there is an error like in google form if there is erroe the data is not changed
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;
$is_featured = $_SESSION['add-post-data']['is_featured'] ?? null;
$thumbnail = $_SESSION['add-post-data']['thumbnail'] ?? null;

unset($_SESSION['add-post-data']);
//fetching categories 
$category_query = "SELECT * FROM categories";
$result_category = mysqli_query($conn, $category_query);

?>
<!DOCTYPE html>
<html lang="en">



<section class="form_section">
    <div class="container form_section-container">
        <h2>Add Post</h2>
        <?php
            if (isset($_SESSION['add-post'])) { ?> 
                <div class="alert_message error container">
                    <p><?php echo $_SESSION['add-post']; 
                    unset($_SESSION['add-post'])
                    ?></p>
                    </div>
                <?php
            }?>
            
        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" value="<?= $title ?>" name="title" placeholder="Title">
            <select name="category" id="" placeholder="Category">
                <!-- below option see that when page load no default categories are selected -->
                <option value="0" <?= !isset($_POST['category']) ? 'selected' : '' ?>>None</option>
                <?php while ($category = mysqli_fetch_assoc($result_category)): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title']  ?></option>
                <?php endwhile ?>
            </select>
            <textarea name="body" id="" rows="4" placeholder="body"><?= $body ?></textarea>
            <?php if (isset($_SESSION['user_is_admin'])): ?>
                <div class="form_control inline">
                    <label for="is_featured" >Is Featured</label>
                    <input name="is_featured" value="1" type="checkbox" id="is_featured" checked>
                </div>
            <?php endif ?>
            <div class="form_control">
                <label for="thumbnail">Add thumbnail</label>
                <input name="thumbnail" type="file" id="thumbnail" accept=".png, .jpg, .jpeg">
            </div>

            <button type="submit" name="submit" class="btn">Add Post</button>
    </div>
    </form>
</section>

<?php include('../partials/footer.php') ?>

</body>

</html>