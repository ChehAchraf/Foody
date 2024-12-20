<?php 
    include('db.php');
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_SESSION['id']) && isset($_POST['send'])) {
            $id = $_SESSION['id'];
            $user_name = sanitize($_POST['name']);
            $time = sanitize($_POST['time']);
            $date = sanitize($_POST['date']);
            $places = sanitize($_POST['places']);
            $menu = sanitize($_POST['menu']);
            $insert = $conn->prepare("INSERT INTO `reservations`(`client_id`, `menu_id`, `reservation_date`, `reservation_time`, `num_people`, `status`, `created_at`) 
                                      VALUES(?, ?, ?, ?, ?, 'pending', NOW())");

            $insert->bind_param("iisss", $id, $menu, $date, $time, $places);
            $insert->execute();
            if ($insert->affected_rows > 0) {
                $_SESSION['res_done'] = "ss";
                header("Location: ../index.php");
            } else {
                echo "Reservation failed.";
            }
        }
    }

    function sanitize($str) {
        return trim(htmlspecialchars(htmlentities($str)));
    }
?>
