<table class="w70np" id="admin_remove_user_table">
    <?php

        if(isset($_GET['delete']) and $_GET['delete'] <> 0) {
            $query = "DELETE FROM users WHERE id=?";
            $stmt = mysqli_stmt_init($MySQL);
            mysqli_stmt_prepare($stmt, $query);
            mysqli_stmt_bind_param($stmt,'s', $_GET['delete']);
            mysqli_stmt_execute($stmt);
            $_SESSION['user']['message'] = "User removed";
        }
        if(isset($_GET['admin']) and $_GET['admin'] <> 0) {
            $query = "SELECT admin FROM users WHERE id=?";
            $stmt = mysqli_stmt_init($MySQL);
            mysqli_stmt_prepare($stmt, $query);
            mysqli_stmt_bind_param($stmt,'s', $_GET['admin']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $admin_lvl);
            mysqli_stmt_fetch($stmt);
            $query = "UPDATE users SET admin=? WHERE id=?";
            mysqli_stmt_prepare($stmt, $query);
            mysqli_stmt_bind_param($stmt,'is', abs($admin_lvl - 1), $_GET['admin']);
            mysqli_stmt_execute($stmt);
            $_SESSION['user']['message'] = "Admin level change";
        }

        if(isset($_GET['delete']) or isset($_GET['admin'])) {
            unset($_GET['delete']);
            unset($_GET['admin']);
            header("Location: index.php?menu=4&control=3");
        }

        $amount = 10;

        $query = "SELECT CEILING(COUNT(*)/" . $amount . ") AS num FROM users";
        $result = mysqli_query($MySQL, $query);
        $result = mysqli_fetch_array($result);
        $page_num = $result['num'];

        if (isset($_GET['page'])) { $_GET['page'] = (int)$_GET['page']; }
	    if (isset($_GET['page']) and $_GET['page'] > $page_num)  { $_GET['page'] = $page_num; } 
	    if (!isset($_GET['page']) or ($_GET['page'] < 1)) { $_GET['page'] = 1; }

        $query = "SELECT * FROM users WHERE id != " . $_SESSION['user']['id'] . " ORDER BY id DESC LIMIT " . $amount . " OFFSET " . (($_GET['page'] * $amount) - $amount);
        $result = mysqli_query($MySQL, $query);
        while ($row = mysqli_fetch_array($result)) {
            echo '
                <tr>
                <td>' . $row['username'] . ' - ' . $row['email'] . (($row['admin'] == 1) ? ' <mark>(admin)</mark>' : '') . '</td>
                <td>
                    <a href="index.php?menu=4&control=3&page=' . $_GET['page'] . '&admin=' . $row['id'] . '">
                        <img class="small_icon" src="img/crown.png">
                    </a>
                </td>
                <td>
                    <a href="index.php?menu=4&control=3&page=' . $_GET['page'] . '&delete=' . $row['id'] . '">
                        <img class="small_icon" src="img/trash-can.png">
                    </a>
                </td>
                </tr>
            ';
            echo "<tr><td colspan=\"3\"><hr></td></tr>";
        }
        echo '<tr><td colspan="3">
            <nav>';
                if ($_GET['page'] > 1) {
                    echo "<a href=\"index.php?menu=4&control=3&page=" . $_GET['page'] - 1 . "\">Back</a>";
                } else {
                    echo '<div>Back</div>';
                }
                if ($_GET['page'] < $page_num) {
                    echo "<a href=\"index.php?menu=4&control=3&page=" . $_GET['page'] + 1 . "\">Next</a>";
                } else {
                    echo '<div>Next</div>';
                }
        echo '</nav
        </td></tr>';
    ?>
</table>