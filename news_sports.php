<?php
    $category = (($_GET['menu'] == 2) ? 'news' : 'sports');
    $query = "SELECT CEILING(COUNT(*)/4) AS num FROM news WHERE category='" . $category . "'";
    $result = mysqli_query($MySQL, $query);
    $result = mysqli_fetch_array($result);
    $page_num = $result['num'];
    
	if (isset($_GET['page'])) { $_GET['page'] = (int)$_GET['page']; }
	if (isset($_GET['page']) and $_GET['page'] > $page_num)  { $_GET['page'] = $page_num; } 
	if (!isset($_GET['page']) or ($_GET['page'] < 1)) { $_GET['page'] = 1; }
?>

<section class="w70" id='<?php echo (($_GET['menu'] == 2) ? 'news_content' : 'sports_content');?>'>
    <h1><?php echo ucfirst($category); ?></h1>
    <div class="flex_container" id="news_sports_container">
        <?php
            $query = "SELECT * FROM news WHERE category='" . $category . "' ORDER BY date DESC LIMIT 4 OFFSET " . (($_GET['page'] * 4) - 4);
            $result = mysqli_query($MySQL, $query);
            while ($row = mysqli_fetch_array($result)) {
                echo '<a href="index.php?news=' . $row['id'] . '">
                <img src="img/news/' . $row['image'] . '">
                <h3>' . $row['title_small'] . '</h3>
                <p>' . $row['title'] . '</p>
                </a>';
            }
        ?>
    </div>
    <nav id="news_sports_nav">
        <?php
            if ($_GET['page'] > 1) {
                echo "<a href=\"index.php?menu=" . $_GET['menu'] . "&page=" . $_GET['page'] - 1 . "\">Newer</a>";
            } else {
                echo '<div>Newer</div>';
            }
            if ($_GET['page'] < $page_num) {
                echo "<a href=\"index.php?menu=" . $_GET['menu'] . "&page=" . $_GET['page'] + 1 . "\">Older</a>";
            } else {
                echo '<div>Older</div>';
            }
        ?>
    </nav>
</section>