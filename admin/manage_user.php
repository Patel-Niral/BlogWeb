<?php 
include ('partials/header.php');

//fetch users from DB 
$current_admin_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE NOT id = '$current_admin_id'";
$users = mysqli_query($conn, $query);


?>
<!DOCTYPE html>
<html lang="en">

    <section class="dashboard">
    <?php
            if (isset($_SESSION['add-user-success'])) { ?> 
                <div class="alert_message success container">
                    <p><?php echo $_SESSION['add-user-success']; 
                    unset($_SESSION['add-user-success'])
                    ?></p>
                    </div>
                <?php
            }?>
             <?php
            if (isset($_SESSION['edit-user-success'])) { ?> 
                <div class="alert_message success container">
                    <p><?php echo $_SESSION['edit-user-success']; 
                    unset($_SESSION['edit-user-success'])
                    ?></p>
                    </div>
                <?php
            }?>
             <?php
            if (isset($_SESSION['edit-user'])) { ?> 
                <div class="alert_message error container">
                    <p><?php echo $_SESSION['edit-user']; 
                    unset($_SESSION['edit-user'])
                    ?></p>
                    </div>
                <?php
            }?>
             <?php
            if (isset($_SESSION['delete-user'])) { ?> 
                <div class="alert_message error container">
                    <p><?php echo $_SESSION['delete-user']; 
                    unset($_SESSION['delete-user'])
                    ?></p>
                    </div>
                <?php
            }?>
            
             <?php
            if (isset($_SESSION['delete-user-success'])) { ?> 
                <div class="alert_message error container">
                    <p><?php echo $_SESSION['delete-user-success']; 
                    unset($_SESSION['delete-user-success'])
                    ?></p>
                    </div>
                <?php
            }?>
            
            
            
        <div class="container dashboard_container">
            <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
            <button id="hide_sidebar-btn"  class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
            <aside>
                <ul>
                    <li><a href="add_post.php"><i class="uil uil-pen"></i>
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
                <h2>Manage User</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($user = mysqli_fetch_assoc($users)) {
                        ?>
                        <tr>
                            <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                            <td><?= "{$user['username']}" ?></td>
                            <td><a href="<?= ROOT_URL ?>admin/edit_user.php?id=<?= $user['id']?>" class="btn sm ">Edit</a></td>
                            <td><a href="<?= ROOT_URL ?>admin/delete_user.php?id=<?= $user['id']?>" class="btn sm danger">Delete</a></td>
                            <td><?= $user['is_admin'] ? 'YES' : 'NO'   ?></td>
                        </tr>
                        <?php }  ?>
                    </tbody>
                </table>
            </main>
        </div>
    </section>


    <?php include ('../partials/footer.php') ?>


</body>

</html>