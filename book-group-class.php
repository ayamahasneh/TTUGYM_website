<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("connect.php");

if (isset($_GET['session_id'])) {
    $session_id = $_GET['session_id'];
} else {
    header("Location: group-classes.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$check_booking_query = "SELECT * FROM session_bookings WHERE user_id = '$user_id' AND session_id = '$session_id'";
$check_booking_result = $conn->query($check_booking_query);

if ($check_booking_result === FALSE) {
    echo "Error checking booking: " . $conn->error;
    exit();
}

if ($check_booking_result->num_rows > 0) {
    header("Location: group-classes.php?error=already_booked");
    exit();
} else {
    $insert_booking_query = "INSERT INTO session_bookings (user_id, session_id, booking_date, session_type) VALUES ('$user_id', '$session_id', NOW(), 'group')";

    $update_slots_query = "UPDATE group_classes SET available_slots = available_slots - 1 WHERE id = '$session_id' AND available_slots > 0";

    $conn->begin_transaction();

    if ($conn->query($insert_booking_query) === TRUE) {
        if ($conn->query($update_slots_query) === TRUE) {
            $conn->commit();
            header("Location: group-classes.php?success=booking_successful");
            exit();
        } else {
            $conn->rollback();
            echo "Update Error: " . $conn->error;
            header("Location: group-classes.php?error=booking_failed");
            exit();
        }
    } else {
        $conn->rollback();
        echo "Insert Error: " . $conn->error;
        header("Location: group-classes.php?error=booking_failed");
        exit();
    }
}

$conn->close();
?>
