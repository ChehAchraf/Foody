<?php
include('../inc/db.php');
session_start();

if (isset($_SESSION['id']) && $_SESSION['id'] == 1) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reservation_id = isset($_POST['reservation_id']) ? intval($_POST['reservation_id']) : null;
        $new_status = isset($_POST['status']) ? $_POST['status'] : null;

        if ($reservation_id && in_array($new_status, ['pending', 'confirmed', 'cancelled'])) {
            $update_query = "UPDATE reservations SET status = ? WHERE id = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("si", $new_status, $reservation_id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Reservation status updated successfully!";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Failed to update reservation status.";
                $_SESSION['message_type'] = "danger";
            }
            $stmt->close();
        } else {
            $_SESSION['message'] = "Invalid reservation or status.";
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
