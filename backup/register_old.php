<?php
    if (!isset($_POST['registration'])) {
        echo  '
        <div id="registration_form">
            <form class="flex_v" action="" method="POST">
                <h2>Register</h2>
                <label for="name">First Name</label>
                <input class="form_elem" type="text" id="name" name="firstname" placeholder="Your name..." required>
                
                <label for="sname">Last Name</label>
                <input class="form_elem" type="text" id="sname" name="surname" placeholder="Your surname..." required>
                    
                <label for="email">Your E-mail</label>
                <input class="form_elem" type="email" id="email" name="email" placeholder="Your e-mail..." required>
                    
                <label for="uname">Your Username</label>
                <input class="form_elem" type="text" id="uname" name="username" placeholder="Your username..." required>
                    
                <label for="pass">Your Password</label>
                <input class="form_elem" type="password" id="pass" name="password" placeholder="Your password..." required>
                    
                <label for="rpass">Repeat Password</label>
                <input class="form_elem" type="password" id="rpass" name="rpass" placeholder="Your password again..." required>

                <label for="country">Country</label>
                <select class="form_elem" id="country" name="country">
                    <option selected disabled>Please select</option> ';
                    $query  = "SELECT * FROM countries";
                    $result = mysqli_query($MySQL, $query);
                    while($row = mysqli_fetch_array($result)) {
                        print '<option value="' . $row['id'] . '">' . $row['country_name'] . '</option>';
                    }
            echo '
                </select>

                <input class="form_submit" name="registration" type="submit" value="Register">
            </form>
        </div>';
    } else {
        if ($_POST['password'] == $_POST['rpass']) {
            $query = "SELECT * FROM users WHERE email='" . $_POST['email'] . "' OR username='" . $_POST['username'] . "'";
            $result = mysqli_query($MySQL, $query);
            $row = mysqli_fetch_array($result);
            if (empty($row['email'])) {
                $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
                $query = "INSERT INTO users (name, surname, email, username, password, countryId)
                VALUES ('" . $_POST['firstname'] . "', '" . $_POST['surname'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $hashed_password . "', '" . $_POST['country'] . "')";
                mysqli_query($MySQL, $query);
                echo '<p>' . ucfirst(strtolower($_POST['firstname'])) . ' ' .  ucfirst(strtolower($_POST['surname'])) . ', thank you for registration </p>';
                
                $query = "SELECT id FROM users WHERE name='" . $_POST['firstname'] . "' AND surname='" . $_POST['surname'] . 
                "' AND email='" . $_POST['email'] . "' AND username='" . $_POST['username'] . "'";
                $result = mysqli_query($MySQL, $query);
                $result = mysqli_fetch_array($result);
                set_user($result['id'], $_POST['username'], $_POST['firstname'], $_POST['surname']);
                header("Location: index.php?menu=4&control=0");
            } else {
                $_SESSION['user']['message'] = "This email or username is already taken!";
                header("Location: index.php?menu=4&control=0");
            }
        } else {
            $_SESSION['user']['message'] = "Password and repeated password need to match!";
            header("Location: index.php?menu=4&control=0");
        }
    }
?>