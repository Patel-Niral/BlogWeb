<?php
include('partials/header.php');

//fetching featured post from DB
$featured_query = "SELECT * FROM posts WHERE featured = 1 ";
$featured_result = mysqli_query($conn, $featured_query);
$featured_post = mysqli_fetch_assoc($featured_result);

//fetching post from post table
$posts_query = "SELECT * FROM posts ORDER BY date_time DESC";
$posts_result = mysqli_query($conn, $posts_query);



?>
<!DOCTYPE html>
<html lang="en">

<!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->
<?php if (mysqli_num_rows($featured_result) == 1) : ?>
    <section class="featured">
        <a href="<?= ROOT_URL ?>post.php?id=<?= $featured_post['id'] ?>">
            <div class="container featured_container">
                <div class="post_thumbnail"><img src="images/<?= $featured_post['thumbnail'] ?>" alt=""></div>
                <div class="post_info">
                    <!-- // for fetching category -->
                    <?php
                    $category_query = "SELECT * FROM categories WHERE id = $featured_post[category_id]";
                    $category_result = mysqli_query($conn, $category_query);
                    $category_post = mysqli_fetch_assoc($category_result);

                    ?>

                    <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category_post['id'] ?>" class="category_button"><?= $category_post['title'] ?></a>
                    <h2 class="post_title"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured_post['id'] ?>"><?= $featured_post['title'] ?></a></h2>
                    <p class="post_body"><?= substr($featured_post['body'], 0, 300) ?>...</p>
                    <?php
                    $user_query = "SELECT * FROM users WHERE id = $featured_post[author_id]";
                    $user_result = mysqli_query($conn, $user_query);
                    $user_post = mysqli_fetch_assoc($user_result);

                    ?>
                    <div class="post_author">
                        <div class="post_author-avatar">
                            <img src="<?= ROOT_URL ?>images/<?= $user_post['avatar'] ?>" alt="">
                        </div>
                        <div class="postauthor-info">
                            <h5><?= $user_post['username'] ?></h5>

                            <!-- M: Abbreviated month name (e.g., Jan, Feb). D: Abbreviated day name (e.g., Mon, Tue). d: Day of the month (e.g., 01, 02). Y: Full year (e.g., 2025). 
                         h: Hour in 12-hour format (e.g., 01, 02). i: Minutes with leading zero (e.g., 01, 59). A: Uppercase AM or PM (e.g., AM, PM). -->
                            <small><?= date("M  D , d Y , h:i A", strtotime($featured_post['date_time'])) ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </section>
<?php endif; ?>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

<!-- h5^small
     <h5></h5>
    <small></small> -->

<!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

<section class="posts">
    <div class="container post_container">
        <?php while ($post = mysqli_fetch_assoc($posts_result)) :
            if ($post['featured'] != 1) :
        ?>
                    <article class="post">
                        <a class="postblock" href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>">
                        <div class="post_thumbnail"><img src="./images/<?= $post['thumbnail'] ?>" alt=""></div></a>
                        <div class="post_info">
                            <!-- // fetching category -->
                            <?php
                            $category_query = "SELECT * FROM categories WHERE id = $post[category_id]";
                            $category_result = mysqli_query($conn, $category_query);
                            $category_post = mysqli_fetch_assoc($category_result);

                            ?>
                            <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category_post['id'] ?>" class="category_button"><?= $category_post['title'] ?></a>
                            <h3 class="post_title"><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h3>
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
        <?php
            endif;
        endwhile ?>
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

<?php
include('partials/footer.php');
?>
</body>

</html>