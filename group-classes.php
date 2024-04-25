<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("connect.php");

$sql = "SELECT * FROM group_classes";
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
    <title>Group Classes</title>
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
    
        <section class="group-classes">
            <div class="content">
                <h2>Group Classes</h2>
                <p>Join our group fitness classes to stay motivated and fit.</p>
                <div class="sessions">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $class_id = $row['id'];
                            $class_name = $row['class_name'];
                            $instructor = $row['instructor'];
                            $schedule = $row['schedule'];
                            $available_slots = $row['available_slots'];

                            $has_booked = in_array($class_id, $booked_sessions);
                    ?>
                    <div class="session">
                        <h3><?php echo $class_name; ?></h3>
                        <p>Instructor: <?php echo $instructor; ?></p>
                        <p>Schedule: <?php echo $schedule; ?></p>
                        <p>Available Slots: <?php echo $available_slots; ?></p>
                        <form method="post" action="book-group-class.php">
                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                            <input type="hidden" name="class_name" value="<?php echo $class_name; ?>">
                            <?php if ($available_slots > 0) { ?>
                                <?php if ($has_booked) { ?>
                                    <button type="button" class="btn disabled">Booked</button>
                                <?php } else { ?>
                                    <a href="book-group-class.php?session_id=<?php echo $class_id; ?>" class="btn">Book Now</a>
                                <?php } ?>
                            <?php } else { ?>
                                <button type="button" class="btn disabled">Fully Booked</button>
                            <?php } ?>
                        </form>
                    </div>
                    <?php
                        }
                    } else {
                        echo "<p>No group classes available at the moment.</p>";
                    }
                    ?>
                </div>
            </div>
        </section>
        
        <footer>
            <p>&copy; 2023 Aya Almahasneh</p>
        </footer>
    </div>
</body>
</html>
