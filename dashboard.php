<?php
session_start();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//     $activity = $_POST['activity'];
//     $timeSlot = $_POST['timeSlot'];

//     $response = "Reservation for $activity at $timeSlot was successful!";
//     echo "<script>alert('$response');</script>";
// }

include("connect.php");

$user_id = $_SESSION['user_id'];


if($_SESSION["admin"] != "1")
{
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>gymttu</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>
    <header>
        <h1>GYM TTU Dashboard</h1>
    </header>
    <div class="container">
        <h2>Welcome to your dashboard, <?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?>    <a href="logout.php" target="_parent">Logout</a></h2>
        <ul class="tab">
            <li><button class="tablinks" onclick="controlTabs(event, 'users')">Users</button></li>
            <li><button class="tablinks" onclick="controlTabs(event, 'usersBook')">Users Book</button></li>
            <li><button class="tablinks" onclick="controlTabs(event, 'personalTraining')">Personal Training</button></li>
            <li><button class="tablinks" onclick="controlTabs(event, 'groupTraining')">Group Training</button></li>
        </ul>

        <!-- Start Users -->
        <form method="post" action="">
            <div id="users" class="tabcontent">                    
                <input type="text" class="form-control" placeholder="Search" id="search_user" name="search">

                <table  class="table">
                    <thead>
                        <th scope="col"> User ID </th>                        
                        <th scope="col"> Name </th>
                        <th scope="col"> Email </th>
                        <th scope="col"> Gender </th>
                        <th scope="col"> Birthday </th>
                        <th scope="col"> User Type </th>
                        <th scope="col"> Settings </th>
                    </thead>
                    <?php                    
                        $select_from = "SELECT * FROM users";                        
                        $result = $conn->query($select_from);
                        if($result)
                        {
                            echo '<tbody id="table_user">';
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '
                                    <tr scope="row">
                                        <td>'.$row["id"].'</td>                                        
                                        <td>'.$row["first_name"].' '.$row["last_name"].'</td>                                        
                                        <td>'.$row["email"].'</td>
                                        <td>'.$row["gender"].'</td>
                                        <td>'.$row["birthday"].'</td>
                                        <td>'.$row["admin"].'</td>
                                        <td>
                                            <a id="change_btn" href="setting.php?id='.$row["id"].'&role=delete" name="del_acc">Delete</a>
                                            <a id="change_btn" href="setting.php?id='.$row["id"].'&role=addAdmin" name="up_acc">+Admin</a>
                                        </td>
                                    </tr>
                                ';
                            }
                            echo '</tbody>';
                        }                                   
                    ?>
                </table>
            </div>
        </form>
        <!-- End Users -->
        <!-- Start Users Book -->
        <form method="post" action="">
            <div id="usersBook" class="tabcontent">                    
                <input type="text" class="form-control" placeholder="Search" id="usersBookSearch" name="search">
                
                <table  class="table">
                    <thead>
                        <th scope="col"> user_id </th>
                        <th scope="col"> Session Id </th>
                        <th scope="col"> booking_date </th>
                        <th scope="col"> session_type </th> 
                        <th scope="col"> Settings </th>                       
                    </thead>
                    <?php                    
                        $select_from = "SELECT * FROM session_bookings";                        
                        $result = $conn->query($select_from);
                        if($result)
                        {
                            echo '<tbody id="table_userBook">';
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '
                                    <tr scope="row">
                                        <td>'.$row["user_id"].'</td>                                                                               
                                        <td>'.$row["session_id"].'</td>
                                        <td>'.$row["booking_date"].'</td>
                                        <td>'.$row["session_type"].'</td>                                        
                                    </tr>
                                ';
                            }
                            echo '</tbody>';
                        }                                   
                    ?>
                </table>
            </div>
        </form>
        <!-- End Users Book -->
        <!-- Start Personal Training -->
        <form method="post" action="">
            <div id="personalTraining" class="tabcontent">                    
                <input type="text" class="form-control" placeholder="Search" id="search_personalTraining" name="search">
                
                <table  class="table">
                    <thead>
                        <th scope="col"> id </th>
                        <th scope="col"> Trainer Name </th>
                        <th scope="col"> session_date </th>
                        <th scope="col"> session_time </th>
                        <th scope="col"> available_slots </th>
                        <th scope="col"> description </th>
                        <th scope="col"> created_at </th>
                        <th scope="col"> created_at </th>
                        <th scope="col"> Settings </th>
                    </thead>
                    <?php                    
                        $select_from = "SELECT * FROM personal_training";                        
                        $result = $conn->query($select_from);
                        if($result)
                        {
                            echo '<tbody id="table_personal">';
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '
                                    <tr scope="row">
                                        <td>'.$row["per_id"].'</td>                                                                               
                                        <td>'.$row["trainer_name"].'</td>
                                        <td>'.$row["session_date"].'</td>
                                        <td>'.$row["session_time"].'</td>
                                        <td>'.$row["available_slots"].'</td>
                                        <td>'.$row["description"].'</td>
                                        <td>'.$row["created_at"].'</td>
                                        <td>'.$row["updated_at"].'</td>
                                    </tr>
                                ';
                            }
                            echo '</tbody>';
                        }                                   
                    ?>
                </table>
            </div>
        </form>
        <!-- End Personal Training -->
        <!-- Start Group Training -->
        <form method="post" action="">
            <div id="groupTraining" class="tabcontent">                    
                <input type="text" class="form-control" placeholder="Search" id="search_groupTraining" name="search">
                
                <table  class="table">
                    <thead>
                        <th scope="col"> id </th>
                        <th scope="col"> Class Name </th>
                        <th scope="col"> instructor </th>
                        <th scope="col"> schedule </th>
                        <th scope="col"> available_slots </th>
                        <th scope="col"> Settings </th>
                    </thead>
                    <?php                    
                        $select_from = "SELECT * FROM group_classes";                        
                        $result = $conn->query($select_from);
                        if($result)
                        {
                            echo '<tbody id="table_group">';
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '
                                    <tr scope="row">
                                        <td>'.$row["id"].'</td>                                                                               
                                        <td>'.$row["class_name"].'</td>
                                        <td>'.$row["instructor"].'</td>
                                        <td>'.$row["schedule"].'</td>
                                        <td>'.$row["available_slots"].'</td>
                                    </tr>
                                ';
                            }
                            echo '</tbody>';
                        }                                   
                    ?>
                </table>
            </div>
        </form>
        <!-- End Group Training -->  
    </div>
    <div>
        <?php include("footer.php");?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function show(){
            var showLog = document.getElementById("userLog");
            showLog.classList.toggle("userLogShow");
        }
        $(document).ready(function(){
            $("#search_user").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table_user tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
                
            $("#usersBookSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table_userBook tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
                
            $("#search_personalTraining").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table_personal tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $("#search_groupTraining").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table_group tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

        });

        // To Loud User Section Only When Page Loud
        document.addEventListener("DOMContentLoaded", function() {
            var tabcontent = document.getElementsByClassName("tabcontent");
            for (var i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            document.getElementById("users").style.display = "flex";
        });

        // To Active Section
        function controlTabs(evt, adminSection) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(adminSection).style.display = "flex";
            evt.currentTarget.className += " active";
        }
    </script> 
</body>
</html>