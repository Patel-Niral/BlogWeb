<?php
include('partials/header.php');

$author_id = $_SESSION['user_id'];



// used chat gpt to reduce the query
// for mqsql cehck tutorials : https://youtu.be/OT1RErkfLNQ?si=D2t6ieAuXbtyMFtO
$query = "
    SELECT posts.id AS post_id, posts.title AS post_title, categories.title AS category_title
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    WHERE posts.author_id = '$author_id'
";
$user_post_result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<!-- dashboard OR manage post -->
<section class="dashboard">

<?php
            if (isset($_SESSION['add-post-success'])) { ?> 
                <div class="alert_message success container">
                    <p><?php echo $_SESSION['add-post-success']; 
                    unset($_SESSION['add-post-success'])
                    ?></p>
                    </div>
                <?php
            }?>
<?php
            if (isset($_SESSION['delete-post-success'])) { ?> 
                <div class="alert_message success container">
                    <p><?php echo $_SESSION['delete-post-success']; 
                    unset($_SESSION['delete-post-success'])
                    ?></p>
                    </div>
                <?php
            }?>
    <div class="container dashboard_container">
        <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>

                <li><a href="<?= ROOT_URL ?>admin/add_post.php"><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a></li>
                <li><a href="<?= ROOT_URL ?>admin/index.php"><i class="uil uil-postcard"></i>
                        <h5>Manage Post </h5>
                    </a></li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li><a href="<?= ROOT_URL ?>admin/add_user.php"><i class="uil uil-user-plus"></i>
                            <h5>Add User </h5>
                        </a></li>
                    <li><a href="<?= ROOT_URL ?>admin/manage_user.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage User </h5>
                        </a></li>
                    <li><a href="<?= ROOT_URL ?>admin/add_category.php"><i class="uil uil-edit"></i>
                            <h5>Add category </h5>
                        </a></li>
                    <li><a href="<?= ROOT_URL ?>admin/manage_category.php" class="active"><i class="uil uil-list-ul"></i>
                            <h5>Manage Categories </h5>
                        </a></li>
                <?php endif ?>
            </ul>
        </aside>

        <main>
            <h2>Manage Post</h2>
            <?php //if (mysqli_num_rows($user_post) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>post title</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fetchposts = mysqli_fetch_assoc($user_post_result)): 
                        ?>
                        
                            <tr>
                                <td><?= $fetchposts['post_title'] ?></td>
                                <td><?= $fetchposts['category_title'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit_post.php?id=<?= $fetchposts['post_id'] ?>"  class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete_post.php?id=<?= $fetchposts['post_id'] ?>"  class="btn sm danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php //endif ?>
        </main>
    </div>
</section>


<?php include('../partials/footer.php') ?>


</body>

</html>