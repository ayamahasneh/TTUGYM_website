<?php
session_start();
include("connect.php");
$user_id = $_SESSION['user_id'];
$id = $_GET["id"];
$role = $_GET["role"];

if($role == "delete"){

    $delete_user = "DELETE FROM users WHERE id = '$id'";
    $result = $conn->query($delete_user);

    if ($result) {
        echo "<script>console.log('User with ID $id deleted successfully');</script>";
        header("location: dashboard.php");
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

elseif($role == "addAdmin")
{
    $update = "UPDATE users SET admin = '1' where id = '$id'";
    $result = $conn->query($update);
    header("location: dashboard.php");
}

?>