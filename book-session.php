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
    header("Location: personal-training.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$check_booking_query = "SELECT * FROM session_bookings WHERE user_id = '$user_id' AND session_id = '$session_id'";
$check_booking_result = $conn->query($check_booking_query);

if ($check_booking_result->num_rows > 0) {
    header("Location: personal-training.php?error=already_booked");
    exit();
} else {
    $insert_booking_query = "INSERT INTO session_bookings (user_id, session_id, booking_date, session_type) VALUES ('$user_id', '$session_id', NOW(), 'personal')";
    if ($conn->query($insert_booking_query) === TRUE) {
        header("Location: personal-training.php?success=booking_successful");
        exit();
    } else {
        header("Location: personal-training.php?error=booking_failed");
        exit();
    }
}

$conn->close();
?>
