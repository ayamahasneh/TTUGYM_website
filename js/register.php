<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $conn = mysqli_connect("localhost", "root", "root", "book");
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    mysqli_query($conn, $query);
    mysqli_close($conn);

    echo "Registration successful!";
    header("location: index.php")
}
?>