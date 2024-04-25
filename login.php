<?php
session_start();

include("connect.php");

$login_email = $_POST['login_email'];
$login_password = $_POST['login_password'];

$sql = "SELECT * FROM users WHERE email = '$login_email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = mysqli_fetch_assoc($result);
    $storedHashedPassword = $user['password'];

    if (password_verify($login_password, $storedHashedPassword)) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['admin'] = $user['admin'];
        if($_SESSION['admin'] == 1){
            header("Location: dashboard.php");
        }else{
            header("Location: welcome.php");
        }
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}

$conn->close();
?>