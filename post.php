<?php
include('partials/header.php');

$post_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
if (isset($post_id)) {
    $query = "SELECT * FROM posts WHERE id = $post_id";
    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);
    $post_title = $post['title'];
    $post_body = $post['body'];
    $post_thumbnail = $post['thumbnail'];
    $post_category = $post['category_id'];
    $post_author = $post['author_id'];
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->


<section class="singlepost">
    <div class="container singlepost_container">
        <h2><?= $post_title ?></h2>
        <div class="singlepost-thumbnail"><img src="<?= ROOT_URL ?>images/<?= $post_thumbnail ?>" alt=""></div>
        <div class="post_author">
            <div class="post_author-avatar"><img src="" alt=""></div>
        </div>

   <!-- // fetching user details -->
   <?php
        $user_query = "SELECT * FROM users WHERE id = $post_author";
        $user_result = mysqli_query($conn, $user_query);
        $user_post = mysqli_fetch_assoc($user_result);

        ?>
        <div class="post_author">
            <div class="post_author-avatar">
                <img src="<?= ROOT_URL ?>images/<?= $user_post['avatar'] ?>" alt="">
            </div>
            <div class="postauthor-info">
                <h5><?= $user_post['username'] ?></h5>
        <!-- ///user end -->


        <!-- // fetching categories -->
        <?php
        $category_query = "SELECT * FROM categories WHERE id = $post[category_id]";
        $category_result = mysqli_query($conn, $category_query);
        $category_post = mysqli_fetch_assoc($category_result);

        ?>
        <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category_post['id'] ?>" class="category_button"><?= $category_post['title'] ?></a>
        <!-- /// category end -->

     
                <!-- M: Abbreviated month name (e.g., Jan, Feb). D: Abbreviated day name (e.g., Mon, Tue). d: Day of the month (e.g., 01, 02). Y: Full year (e.g., 2025). h: Hour in 12-hour format (e.g., 01, 02). i: Minutes with leading zero (e.g., 01, 59). A: Uppercase AM or PM (e.g., AM, PM). -->
                <small><?= date("M  D , d Y ", strtotime($post['date_time'])) ?></small>
            </div>
        </div>
        <p><?= $post_body ?></p>
    </div>
</section>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

<?php
include('partials/footer.php');
?>

</body>

</html>