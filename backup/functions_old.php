<?php
    function get_image_name($date, $image, $category, $MySQL) {
        $query = "SELECT image FROM `news` WHERE category='" . $category . "' AND date='" . $date . "' ORDER BY image ASC;";
        $result = mysqli_query($MySQL, $query);
        $image_num = 1;
        while ($row = mysqli_fetch_array($result)) {
            $row_image = $row['image'];
            $number_of_image = strtok(substr($row_image, 9), '.');
            while($number_of_image[0] == '0') {
                $number_of_image = substr($number_of_image, 1);
            }
            if ($number_of_image == $image_num) {
                $image_num++;
            } else {
                break;
            }
        }
        $extension = substr($image, strrpos($image, '.'));
        $edited_date = new DateTime($date);
        return $edited_date->format('d-m-y') . $category[0] . ($image_num < 10 ? "0" : "") . $image_num . $extension;
    }

    function set_user($id, $username, $firstname, $lastname) {
        $_SESSION['user']['id'] = $id;
        $_SESSION['user']['username'] = $username;
		$_SESSION['user']['firstname'] = $firstname;
		$_SESSION['user']['lastname'] = $lastname;
		$_SESSION['user']['message'] = "Welcome " . $username;
    }
?>