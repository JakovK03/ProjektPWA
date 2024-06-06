<section id="home_greet" class="w70">
    <h1>Welcome to BBC.com</h1>
    <?php
        echo "<p>" . date("l, j F") . "</p>";
    ?>
</section>
<section id="home_news_container" class="w70">
    <h2>News</h2>
    <?php
        echo '<div>';
        $query = "SELECT id, title, image, title_small FROM news WHERE category='news' ORDER BY date DESC LIMIT 3";
        $result = mysqli_query($MySQL, $query);
        while ($row = mysqli_fetch_array($result)) {
            echo '
                <a href="index.php?news=' . $row['id'] . '">
                    <article>
                        <img src="img/news/' . $row['image'] . '">
                        <h3>' . $row['title_small'] . '</h3>
                        <p>' . $row['title'] . '</p>
                    </article>
                </a>
            ';
        }
        echo '</div>';
    ?>
</section>
<section id="home_sports_container" class="w70">
    <h2>Sports</h2>
    <?php
        echo '<div>';
        $query = "SELECT id, title, image, title_small FROM news WHERE category='sports' ORDER BY date DESC LIMIT 3";
        $result = mysqli_query($MySQL, $query);
        while ($row = mysqli_fetch_array($result)) {
            echo '
                <a href="index.php?news=' . $row['id'] . '">
                    <article>
                        <img src="img/news/' . $row['image'] . '">
                        <h3>' . $row['title_small'] . '</h3>
                        <p>' . $row['title'] . '</p>
                    </article>
                </a>
            ';
        }
        echo '</div>';
    ?>
</section>