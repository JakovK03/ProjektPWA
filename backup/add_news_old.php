<div class="w70np" id="admin_add_news">
    <form enctype="multipart/form-data" action="index.php?menu=4&control=1" method="post">
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title"><br>
        <span class="error" id="titleMsg"></span>
        <label for="title_small">Short title</label><br>
        <input type="text" name="title_small" id="title_small"><br>
        <span class="error" id="titleSmallMsg"></span>
        <label for="content">Content</label><br>
        <textarea name="content" id="content"></textarea><br>
        <span class="error" id="contentMsg"></span>
        <div>
            <div>
                <label for="file">Image</label><br>
                <input type="file" name="image" id="image">
            </div>
            <div>
                <label for="date">Date</label><br>
                <input type="date" name="date" id="date">
            </div>
            <div>
                <label for="category">Category</label><br>
                <select name="category" id="category">
                    <option value="news">news</option>
                    <option value="sports">sports</option>
                </select>
            </div>
        </div>
        <input name="submit_add" id="submit_add" type="submit" value="Submit">
    </form>
    <script type="text/javascript">
        <?php include("addNewsValidation.js"); ?>
    </script>
    <?php
        if(isset($_POST['submit_add'])) {
            $image_real_name =  get_image_name($_POST['date'], $_FILES['image']['name'], $_POST['category'], $MySQL);
            $query = "INSERT INTO news(title, title_small, content, image, date, category) VALUES ('" . $_POST['title'] . "',
            '" . $_POST['title_small'] . "','" . $_POST['content'] . "','" . $image_real_name . "',
            '" . $_POST['date'] . "','" . $_POST['category'] . "')";
            if (mysqli_query($MySQL, $query)) {
                $_SESSION['user']['message'] = ucfirst($_POST['category']) . " article added";
                $target = 'img/news/' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                rename($target, 'img/news/' . $image_real_name);
            }
        }
    ?>
</div>