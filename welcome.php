<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to Our Gym</title>

        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/welcome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class="container">
            <div class="navbar">
                <div class="menu-toggle" id="menu-toggle">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>

                <a href="#" class="logo">GYM<B>TTU</B></a>

                <div class="nav-link">
                    <a href="logout.php">Log Out</a>
                    <div class="search-container">
                        <input type="text" id="search-input" placeholder="Search...">
                        <button id="search-button"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                        
            </div>
            <section class="home">
                <div class="banner" style="background-image: url('imgs/banner.jpg');"></div>
                <div class="highlights">
                    <h2>Welcome, <span><?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?></span></h2>
                    <h1>Transform Your Body</h1>
                    <div class="tagline">Achieve your fitness goals with our expert trainers.</div>
                </div>
            </section>
            <section class="features">
                <div class="content">
                    <div class="frame">
                        <div class="box">
                            <img src="imgs/personal-training.jpg">
                        </div>
                        <h3 class="title">Personal Training</h3>
                        <p>Get one-on-one guidance from our certified trainers.</p>
                        <a href="personal-training.php">Learn More</a>
                    </div>
                    <div class="frame">
                        <div class="box">
                            <img src="imgs/group-classes.jpg">
                        </div>
                        <h3 class="title">Group Classes</h3>
                        <p>Join our group fitness classes to stay motivated and fit.</p>
                        <a href="group-classes.php">Learn More</a>
                    </div>
                    <div class="frame">
                        <div class="box">
                            <img src="imgs/nutrition-plan.png">
                        </div>
                        <h3 class="title">Nutrition Plan</h3>
                        <p>Receive customized nutrition plans to fuel your workouts.</p>
                        <a href="#">Learn More</a>
                    </div>
                </div>
            </section>
            <footer>
                <p>&copy; 2023 Aya Almahasneh</p>
            </footer>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-input');
                const searchButton = document.getElementById('search-button');

                searchButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    const query = searchInput.value.toLowerCase();
                    performSearch(query);
                });

                function performSearch(query) {
                    const frames = document.querySelectorAll('.frame');
                    let foundFrame = null;

                    for (const frame of frames) {
                        const title = frame.querySelector('.title').textContent.toLowerCase();
                        if (title.includes(query)) {
                            foundFrame = frame;
                            break;
                        }
                    }

                    if (foundFrame) {
                        foundFrame.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        </script>
    </body>
</html>