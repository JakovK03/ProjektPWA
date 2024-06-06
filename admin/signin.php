<?php
    if (!isset($_POST['signin'])) {
        echo '
        <div id="signin_form">
            <form class="flex_v" action="" method="POST">

                <label for="username">Username</label>
                <input class="form_elem" type="text" id="username" name="username" required>
                                        
                <label for="password">Password</label>
                <input class="form_elem" type="password" id="password" name="password" required>
                                        
                <input class="form_submit" name="signin" type="submit" value="Sign in">
            </form>
        </div>';
        unset($_SESSION['user']);
    } else {
        $query  = "SELECT id, password FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($MySQL);
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt,'s', $_POST['username']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $result_id, $result_pass);
            mysqli_stmt_fetch($stmt);
            if (password_verify($_POST['password'], $result_pass)) {
                set_user($result_id, $_POST['username'], $_POST['firstname'], $_POST['surname']);
                header("Location: index.php?menu=4&control=0");
            } else {
                unset($_SESSION['user']);
                $_SESSION['user']['message'] = 'You entered wrong username or password!';
                header("Location: index.php?menu=4&control=0&fail=1");
            }
        } else {
            unset($_SESSION['user']);
            $_SESSION['user']['message'] = 'SQL injestion detected, please no.';
            header("Location: index.php?menu=4&control=0&fail=1");
        }
    }
?>