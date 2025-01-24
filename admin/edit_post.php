<?php
include('partials/header.php');

// Fetch category data
$category_query = "SELECT * FROM categories";
$result_category = mysqli_query($conn, $category_query);

// Fetch post data
if (isset($_GET['id'])) {
    $post_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id = $post_id";
    $user_post_result = mysqli_query($conn, $query);
    if ($user_post_result && mysqli_num_rows($user_post_result) > 0) {
        $fetchpost = mysqli_fetch_assoc($user_post_result);
    } else {
        $_SESSION['edit-post'] = "Post not found.";
        header('Location: ' . ROOT_URL . 'admin/');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<section class="form_section">
    <div class="container form_section-container">
        <h2>Edit Post</h2>
        <?php if (isset($_SESSION['edit-post'])): ?>
            <div class="alert_message error">
                <p><?= $_SESSION['edit-post']; unset($_SESSION['edit-post']); ?></p>
            </div>
        <?php endif; ?>
        

        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $post_id ?>">
            <input type="hidden" name="previous_thumbnail" value="<?= $fetchpost['thumbnail'] ?>">
            <input type="text" name="title" value="<?= $fetchpost['title'] ?>" placeholder="Title">
            <select name="category">
                <option value="">Select Category</option>
                <?php while ($category = mysqli_fetch_assoc($result_category)): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $fetchpost['category_id'] ? 'selected' : '' ?>><?= $category['title'] ?></option>
                <?php endwhile; ?>
            </select>
            <textarea name="body" placeholder="Body" rows="4"><?= $fetchpost['body'] ?></textarea>
            <div>
                <label for="is_featured">Featured</label>
                <input type="checkbox" id="is_featured" name="is_featured" value="1" <?= $fetchpost['featured'] ? 'checked' : '' ?>>
            </div>
            <div class="form_control">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail" accept=".png, .jpg, .jpeg">
            </div>
            <button type="submit" name="submit" class="btn">Update Post</button>
        </form>
    </div>
</section>
<?php include('../partials/footer.php'); ?>
