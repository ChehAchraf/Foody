<?php
include('../inc/db.php');
session_start();

if (isset($_SESSION['id']) && $_SESSION['id'] == 1) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reservation_id = isset($_POST['reservation_id']) ? intval($_POST['reservation_id']) : null;

        if ($reservation_id) {
            $delete_query = "DELETE FROM reservations WHERE id = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param("i", $reservation_id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Reservation deleted successfully!";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Failed to delete reservation.";
                $_SESSION['message_type'] = "danger";
            }
            $stmt->close();
        } else {
            $_SESSION['message'] = "Invalid reservation ID.";
            $_SESSION['message_type'] = "danger";
        }
    }
    header("Location: ../dash/reservation.php");
    exit();
} else {
    header("Location: ../profile.php");
    exit();
}
?>
