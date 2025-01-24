<?php 
include ('partials/header.php');

$category_id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
if(isset($category_id)){
    $query = "SELECT * FROM categories WHERE id = $category_id";
    $result = mysqli_query($conn, $query);
    $category = mysqli_fetch_assoc($result);
    $category_title = $category['title'];
}

// fetching post of that category
$posts_query = "SELECT * FROM posts WHERE category_id = $category_id ORDER BY date_time DESC";
$posts_result = mysqli_query($conn, $posts_query);

?>
<!DOCTYPE html>
<html lang="en">

    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->
    <!-- <script src="https://unicons.iconscout.com/release/v4.0.0"></script>  // suggested only not neccessary-->

    <section class="search_bar">
        <form action="" class="container search_bar-container">
            <div>
                <i class="uil uil-search"></i>
                <input type="search" name="" placeholder="Search"></div>
                <button type="submit" class="btn">Go</button>
        </form>
    </section>

    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

    <!-- h5^small
     <h5></h5>
    <small></small> -->

    <header class="category_title">
        <h2><?= $category_title ?></h2>
    </header>

    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

    <section class="posts">
        <div class="container post_container">
        <?php while ($post = mysqli_fetch_assoc($posts_result)) :
        ?>
            <article class="post">
            <a class="postblock" href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>">
            <div class="post_thumbnail"><img src="./images/<?= $post['thumbnail'] ?>" alt=""></div></a>
            <div class="post_info">
                <a href="category-post.php" class="category_button"><?= $category['title'] ?></a>
                        <h3 class="post_title"><a href="./post.php"><?= $post['title'] ?></a></h3>
                    </div>
                    <p class="post_body">
                        <?= substr($post['body'], 0, 100) ?>...
                    </p>

                    <!-- // fetching user info -->
                    <?php
                    $user_query = "SELECT * FROM users WHERE id = $post[author_id]";
                    $user_result = mysqli_query($conn, $user_query);
                    $user_post = mysqli_fetch_assoc($user_result);

                    ?>
                    <div class="post_author">
                        <div class="post_author-avatar">
                            <img src="<?= ROOT_URL ?>images/<?= $user_post['avatar'] ?>" alt="">
                        </div>
                        <div class="postauthor-info">
                            <h5><?= $user_post['username'] ?></h5>

                            <!-- M: Abbreviated month name (e.g., Jan, Feb). D: Abbreviated day name (e.g., Mon, Tue). d: Day of the month (e.g., 01, 02). Y: Full year (e.g., 2025). h: Hour in 12-hour format (e.g., 01, 02). i: Minutes with leading zero (e.g., 01, 59). A: Uppercase AM or PM (e.g., AM, PM). -->
                               
                            <small><?= date("M  D , d Y ", strtotime($post['date_time'])) ?></small>
                        </div>
                    </div>
            </article>
            <?php endwhile ?>
        </div>
    </section>
    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->
    <section class=" category-container">
    <?php
    $qcategory = "SELECT * FROM categories";
    $rcategory = mysqli_query($conn, $qcategory);

    ?>
    <div class="container category_button-container ">
        <?php while ($category = mysqli_fetch_assoc($rcategory)) : ?>
            <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category['id'] ?>" class="category_button"><?= $category['title'] ?></a>
        <?php endwhile ?>
    </div>
</section>
    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

    <?php include ('partials/footer.php'); ?>

</body>

</html>