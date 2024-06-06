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
        $query  = "SELECT * FROM users WHERE username='" .  $_POST['username'] . "'";
		$result = mysqli_query($MySQL, $query);
		$result = mysqli_fetch_array($result);
		
		if (password_verify($_POST['password'], $result['password'])) {
			set_user($result['id'], $_POST['username'], $_POST['firstname'], $_POST['surname']);
			header("Location: index.php?menu=4&control=0");
		} else {
			unset($_SESSION['user']);
			$_SESSION['user']['message'] = 'You entered wrong username or password!';
            header("Location: index.php?menu=4&control=0&fail=1");
		}
    }
?>