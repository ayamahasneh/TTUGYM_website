<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("connect.php");

$sql = "SELECT * FROM personal_training";
$result = $conn->query($sql);

$user_id = $_SESSION['user_id'];
$booked_sessions = array();

$check_user_bookings_query = "SELECT session_id FROM session_bookings WHERE user_id = '$user_id'";
$check_user_bookings_result = $conn->query($check_user_bookings_query);

if ($check_user_bookings_result->num_rows > 0) {
    while ($row = $check_user_bookings_result->fetch_assoc()) {
        $booked_sessions[] = $row['session_id'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Training Sessions</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/training.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <div class="menu-toggle" id="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <a href="#" class="logo">GYM<B>TTU</B></a>
            <ol class="nav-links">
                <li><a href="welcome.php">Home</a></li>
                <li><a href="#">Classes</a></li>
                <li><a href="#">Schedule</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li>    
                    <div class="search-container">
                        <input type="text" id="search-input" placeholder="Search...">
                        <button id="search-button"><i class="fa fa-search"></i></button>
                    </div>
                </li>
            </ol>
        </nav>

        <section class="personal-training">
            <div class="content">
                <h2>Personal Training Sessions</h2>
                <p>Get one-on-one guidance from our certified trainers to help you achieve your fitness goals.</p>
                <div class="sessions">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $session_id = $row['per_id'];
                            $trainer_name = $row['trainer_name'];
                            $date = $row['session_date'];
                            $time = $row['session_time'];
                            $available_slots = $row['available_slots'];
                            $description = $row['description'];

                            $has_booked = in_array($session_id, $booked_sessions);
                    ?>
                    <div class="session">
                        <h3><?php echo $trainer_name; ?></h3>
                        <p>Date: <?php echo $date; ?></p>
                        <p>Time: <?php echo $time; ?></p>
                        <p>Available Slots: <?php echo $available_slots; ?></p>
                        <p>Description: <?php echo $description; ?></p>
                        <?php if ($has_booked) { ?>
                            <button type="button" class="btn disabled">Booked</button>
                        <?php } else { ?>
                            <a href="book-session.php?session_id=<?php echo $session_id; ?>" class="btn">Book Now</a>
                        <?php } ?>
                    </div>
                    <?php
                        }
                    } else {
                        echo "<p>No personal training sessions available at the moment.</p>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <p>&copy; 2023 Aya Almahasneh</p>
    </footer>
</body>
</html>
