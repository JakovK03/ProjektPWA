<?php
    if (!isset($_POST['registration'])) {
        echo  '
        <div id="registration_form">
            <form class="flex_v" action="" method="POST">
                <h2>Register</h2>
                <label for="name">First Name</label>
                <input class="form_elem" type="text" id="name" name="firstname" placeholder="Your name..." required>
                <span class="error_register" id="nameMsg"></span>
                
                <label for="sname">Last Name</label>
                <input class="form_elem" type="text" id="sname" name="surname" placeholder="Your surname..." required>
                <span class="error_register" id="snameMsg"></span>
                    
                <label for="email">Your E-mail</label>
                <input class="form_elem" type="email" id="email" name="email" placeholder="Your e-mail..." required>
                <span class="error_register" id="emailMsg"></span>
                    
                <label for="uname">Your Username</label>
                <input class="form_elem" type="text" id="uname" name="username" placeholder="Your username..." required>
                <span class="error_register" id="unameMsg"></span>
                    
                <label for="pass">Your Password</label>
                <input class="form_elem" type="password" id="pass" name="password" placeholder="Your password..." required>
                <span class="error_register" id="passMsg"></span>
                    
                <label for="rpass">Repeat Password</label>
                <input class="form_elem" type="password" id="rpass" name="rpass" placeholder="Your password again..." required>
                <span class="error_register" id="rpassMsg"></span>

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
                <span class="error_register" id="countryMsg"></span>

                <input class="form_submit" id="registration" name="registration" type="submit" value="Register">
            </form>
        </div>';
?>

<script type="text/javascript">
    <?php include("registerValidation.js"); ?>
</script>

<?php
    } else {
        if ($_POST['password'] == $_POST['rpass'] && isset($_POST['registration'])) {
            $query = "SELECT email FROM users WHERE email=? OR username=?";
            $stmt = mysqli_stmt_init($MySQL);
            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt,'ss', $_POST['email'], $_POST['username']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $result_email);
                mysqli_stmt_fetch($stmt);
                if (empty($result_email)) {
                    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
                    $query = "INSERT INTO users (name, surname, email, username, password, countryId)
                    VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($MySQL);
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt,'sssssi', $_POST['firstname'], $_POST['surname'], $_POST['email'], $_POST['username'], $hashed_password, $_POST['country']);
                        mysqli_stmt_execute($stmt);
                        echo '<p>' . ucfirst(strtolower($_POST['firstname'])) . ' ' .  ucfirst(strtolower($_POST['surname'])) . ', thank you for registration </p>';
                        //Ovaj dio bez zaštite od SQL injekcije jer gornji query već provjerava parametre
                        $query = "SELECT id FROM users WHERE name='" . $_POST['firstname'] . "' AND surname='" . $_POST['surname'] . 
                        "' AND email='" . $_POST['email'] . "' AND username='" . $_POST['username'] . "'";
                        $result = mysqli_query($MySQL, $query);
                        $result = mysqli_fetch_array($result);
                        set_user($result['id'], $_POST['username'], $_POST['firstname'], $_POST['surname']);
                        header("Location: index.php?menu=4&control=0");
                    }
                } else {
                    $_SESSION['user']['message'] = "This email or username is already taken!";
                    header("Location: index.php?menu=4&control=0");
                }
            }
        } else {
            $_SESSION['user']['message'] = "Password and repeated password need to match!";
            header("Location: index.php?menu=4&control=0");
        }
    }
?>