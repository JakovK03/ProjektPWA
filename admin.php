<section class="w70" id="admin_board">
    <h1>Administration</h1>
    <?php
        if(isset($_SESSION['user']['username'])) {
            $query = "SELECT admin FROM users WHERE username='" . $_SESSION['user']['username'] . "'";
            $result = mysqli_query($MySQL, $query);
            $result = mysqli_fetch_array($result);
            if ($result['admin'] == 1) {
                $admin = TRUE;
            } else {
                $admin = FALSE;
            }
        } else {
            if ($_GET['control'] <> 4 and $_GET['control'] <> 5) {
                $_GET['control'] = 0;
            }
        }
    ?>
    <div id="admin_control">
        <aside class="w20np">
            <ul>
                <?php
                    if (isset($_SESSION['user']['message'])) {
                        echo "<p class='msg'>" . $_SESSION['user']['message'] . "</p>";
                    }
                    if (isset($_SESSION['user']['username']) and $admin == TRUE) {
                        echo '
                            <li>
                                <a href="index.php?menu=4&control=1">Add news</a>
                            </li>
                            <li>
                                <a href="index.php?menu=4&control=2&page=1">Remove news</a>
                            </li>
                            <li>
                                <a href="index.php?menu=4&control=3&page=1">Manage users</a>
                            </li>
                        ';
                    } if(isset($_SESSION['user']['username'])) {
                        echo '
                            <li>
                                <a href="index.php?menu=4&control=4">Sign out</a>
                            </li>
                        ';
                    } else {
                        echo '
                            <li>
                                <a href="index.php?menu=4&control=4">Sign in</a>
                            </li>
                            <li>
                                <a href="index.php?menu=4&control=5">Register</a>
                            </li>
                        ';
                    }
                ?>
            </ul>
        </aside>
        <?php
            if ($_GET['control'] == 1) {
                include("admin/add_news.php");
            } elseif ($_GET['control'] == 2) {
                include("admin/remove_news.php");
            } elseif ($_GET['control'] == 3) {
                include("admin/remove_users.php");
            } elseif ($_GET['control'] == 4) {
                if (isset($_SESSION['user']['username'])) {
                    include("admin/signout.php");
                } else {
                    include("admin/signin.php");
                }
            } elseif ($_GET['control'] == 5) {
                include("admin/register.php");
            }
        ?>
    </div>
</section>