<?php
    $query = "SELECT * FROM news WHERE id=" . $_GET['news'];
    $result = mysqli_query($MySQL, $query);
    $result = mysqli_fetch_array($result);
    echo "<div class='article_banner' id='";
    if ($result['category'] == 'sports') {
        echo "article_sports_banner'>SPORTS</div>";
    } elseif ($result['category'] == 'news') {
        echo "article_news_banner'>NEWS</div>";
    }
?>
<main class="w50" id="article_content">
    <h1><?php echo $result['title_small'];?></h1>
    <figure>
        <img src="img/news/<?php echo $result['image'];?>" alt="">
        <h2><?php echo $result['title'];?></h2>
    </figure>
    <pre>
        <?php echo $result['content'];?>
    </pre>
</main>