<table class="w70np" id="admin_remove_news_table">
    <?php
        if(isset($_GET['delete']) and $_GET['delete'] <> 0) {
            $query = "SELECT image FROM news WHERE id=?";
            $stmt = mysqli_stmt_init($MySQL);
            mysqli_stmt_prepare($stmt, $query);
            mysqli_stmt_bind_param($stmt,'i', $_GET['delete']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $result_image);
            mysqli_stmt_fetch($stmt);

            $image = "img/news/" . $result_image;
            $query = "DELETE FROM news WHERE id=" . $_GET['delete'];
            $result = mysqli_query($MySQL, $query);
            unlink($image);
            unset($_GET['delete']);
            $_SESSION['user']['message'] = "Article removed";
            header("Location: index.php?menu=4&control=2");
        }

        $amount = 8;

        $query = "SELECT CEILING(COUNT(*)/" . $amount . ") AS num FROM news";
        $result = mysqli_query($MySQL, $query);
        $result = mysqli_fetch_array($result);
        $page_num = $result['num'];

        if (isset($_GET['page'])) { $_GET['page'] = (int)$_GET['page']; }
	    if (isset($_GET['page']) and $_GET['page'] > $page_num)  { $_GET['page'] = $page_num; } 
	    if (!isset($_GET['page']) or ($_GET['page'] < 1)) { $_GET['page'] = 1; }

        $query = "SELECT * FROM news ORDER BY date DESC LIMIT " . $amount . " OFFSET " . (($_GET['page'] * $amount) - $amount);
        $result = mysqli_query($MySQL, $query);
        while ($row = mysqli_fetch_array($result)) {
            echo '
                <tr>
                <td>
                    <img class="admin_remove_news_table_img" src="img/news/' . $row['image'] . '">
                </td>
                <td>' . $row['title_small'] . '</td>
                <td>
                    <a href="index.php?menu=4&control=2&page=' . $_GET['page'] . '&delete=' . $row['id'] . '">
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
                    echo "<a href=\"index.php?menu=4&control=2&page=" . $_GET['page'] - 1 . "\">Back</a>";
                } else {
                    echo '<div>Back</div>';
                }
                if ($_GET['page'] < $page_num) {
                    echo "<a href=\"index.php?menu=4&control=2&page=" . $_GET['page'] + 1 . "\">Next</a>";
                } else {
                    echo '<div>Next</div>';
                }
        echo '</nav
        </td></tr>';
    ?>
</table>