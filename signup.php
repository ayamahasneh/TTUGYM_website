<?php
include("connect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$Password = $_POST['password'];
$hashedPassword = password_hash($Password, PASSWORD_BCRYPT);


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
} else {
    $emailCheckQuery = "SELECT id FROM users WHERE email='$email'";
    $emailCheckResult = $conn->query($emailCheckQuery);

    if ($emailCheckResult->num_rows > 0) {
        echo "Email already exists";
    } else {
        $sql = "INSERT INTO users (first_name, last_name, birthday, gender, email, password)
                VALUES ('$first_name', '$last_name', '$birthday', '$gender', '$email', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>