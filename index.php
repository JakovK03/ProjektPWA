<?php
    session_start();
    include("dbconn.php");
    include("functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        if(isset($_GET['menu'])) { $menu = (int)$_GET['menu']; }
        if (!isset($menu)) { $menu = 1; }
    ?>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <title>Projekt</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>
                    <img src="img/header.png" alt="BBC London">
                </li>
                <li>
                    <a href="index.php?menu=1">Home</a>
                </li>
                <li>
                    <a href="index.php?menu=2&page=1">News</a>
                </li>
                <li>
                    <a href="index.php?menu=3&page=1">Sports</a>
                </li>
                <li>
                    <a href="index.php?menu=4&control=0">Administration</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
            if (isset($_GET['news'])) {
                include("article.php");
            } else {
                if ($menu <> 4 and !isset($_SESSION['user']['username'])) {
                    unset($_SESSION['user']['message']);
                }
                if (!isset($menu) || $menu == 1) { include("home.php"); }
                else if ($menu == 2) { include("news_sports.php"); }
                else if ($menu == 3) { include("news_sports.php"); }
                else if ($menu == 4) { include("admin.php"); }
            }
        ?>
    </main>
    <footer class="<?php
        if (isset($_GET['news'])) {
            echo "w50";
        } else {
            echo "w70";
        }
    ?>">
        <hr>
        <div>
		    <p>Copyright &copy <?php echo date("Y");?> Jakov Košutić; jkosutic@tvz.hr ; <a href="https://github.com/JakovK03/ProjektPWA">GITHub</a></p>
            <a href="#top">Back to top</a>
        </div>
	</footer>
</body>
</html>