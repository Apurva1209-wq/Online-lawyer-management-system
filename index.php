<?php
    session_start();
    // Ensure dbCon.php is included. It's good practice to use include_once.
    include_once("db_con/dbCon.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="icon" type="image/png" href="images/upload/faviconicon.png">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" xintegrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/media.css">

        <style>
            body {
                /* Background image for the entire body.
                   Note: If you want a full-height banner, it's better to apply this to a specific section.
                   Setting height: 1vh; here will make the body very short.
                   Consider removing height: 1vh; or adjusting it to 100vh if you want the background to cover the whole viewport. */
                background-image: url('images/upload/backgroundimg.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                /* height: 1vh; - This line might make your page content very compressed. Consider removing or changing to 100vh. */
            }
            /* Custom styling for the banner section to ensure it has height and content is visible */
            .banner {
                padding: 100px 0; /* Adjust padding as needed */
                color: #fff; /* Text color for banner content */
                text-align: center;
                background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay on banner */
            }
            .lawyerscard {
                padding: 50px 0;
                background-color: #f8f9fa; /* Light background for lawyer cards section */
            }
            .card {
                margin-bottom: 20px; /* Space between cards */
            }
            .cusimg {
                height: 250px; /* Fixed height for images to ensure consistency */
                object-fit: cover; /* Ensures images cover the area without distortion */
            }
        </style>

        <title>Lawyer Management System</title>
    </head>
    <body>
        <header class="customnav bg-success">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand cus-a" href="index.php"><b>Lawyer Management System</b></a>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link cus-a" href="index.php"><b>Home</b></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link cus-a" href="lawyers.php"><b>Lawyers</b></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link cus-a" href="#aboutus"><b>About Us</b></a>
                                    </li>
                                    <?php if(isset($_SESSION['login']) && $_SESSION['login'] == TRUE){ ?>
                                        <li class="nav-item">
                                            <a class="nav-link cus-a" href="user_dashboard.php"><b>Dashboard</b></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link cus-a" href="logout.php"><b>Logout</b></a>
                                        </li>
                                        <?php }else{ ?>
                                        <li class="nav-item">
                                            <a class="nav-link cus-a" href="login.php"><b>Login</b></a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle cus-a" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Register
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="lawyer_register.php">Register as a Lawyer</a>
                                                <a class="dropdown-item" href="user_register.php">Register as a User</a>
                                            </div>
                                        </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Banner Section -->
        <section class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"> <!-- Changed col-md to col-md-12 for full width -->
                        <div class="banner_content">
                            <h1><b>Connecting You with Experienced Lawyers.</b></h1>
                            <button class="btn-lg cusbutton"><b>Book a Consultation</b></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Lawyers Card Section (Copied from lawyers.php) -->
        <section class="lawyerscard">
            <div class="container">
                <h2 class="text-center mb-4">Our Experienced Lawyers</h2> <!-- Added a heading for this section -->
                <div class="row">
                    <?php
                        $conn = connect(); // Using the connect() function from dbCon.php
                        
                        $sql = "SELECT user.first_Name, user.last_Name, user.u_id, user.status, lawyer.speciality, lawyer.practise_Length, lawyer.image 
                                FROM user,lawyer 
                                WHERE user.u_id=lawyer.lawyer_id AND user.status='Active'";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                    ?>
                                <div class="col-md-4 mb-4"> <!-- Added mb-4 for bottom margin -->
                                    <div class="card" style="width: 18rem;">
                                        <!-- DEBUGGING: Echo the image path to see what's being generated -->
                                        <?php 
                                        // This will print the full path being used for the image.
                                        // Check your browser's inspect element (console or elements tab) for this output.
                                        // Example: <!-- Debug Image Path: images/upload/1575882.jpg -->
                                        echo "<!-- Debug Image Path: images/upload/" . htmlspecialchars($row["image"]) . " -->";
                                        ?>
                                        <img src="images/upload/<?php echo htmlspecialchars($row["image"]); ?>" class="card-img-top cusimg img-fluid" alt="Lawyer Image">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($row["first_Name"]); ?> <?php echo htmlspecialchars($row["last_Name"]); ?></h5>
                                            <h6 class="card-title"><?php echo htmlspecialchars($row["speciality"]); ?></h6>
                                            <h6 class="card-title"><span>Practise Length: <?php echo htmlspecialchars($row["practise_Length"]); ?> years</span></h6>
                                            <a class="btn btn-sm btn-info" href="single_lawyer.php?u_id=<?php echo htmlspecialchars($row["u_id"]); ?>"><i class="fa fa-street-view"></i>&nbsp; View Full Profile</a>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        } else {
                            // Message if no active lawyers are found or query returns no results
                            echo "<div class='col-12 text-center'><p>No active lawyers found at the moment or a database issue occurred.</p></div>";
                            // DEBUGGING: Check for SQL errors if no results are returned
                            if (mysqli_error($conn)) {
                                echo "<div class='col-12 text-center text-danger'><p>Database Error: " . mysqli_error($conn) . "</p></div>";
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
        
        <!-- About Us Section -->
        <section class="aboutus" id="aboutus">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><b>About Us</b></h2>
                        <p>We connect clients with experienced legal professionals for seamless legal assistance. Our platform ensures easy access to qualified lawyers across various domains, making legal consultations and case management efficient and secure.</p>

                        <h2><b>Our Mission</b></h2>
                        <p>Our goal is to make legal services transparent, accessible, and efficient. We strive to help individuals and businesses find the right legal support quickly and effectively.</p>

                        <h2><b>Why Choose Us?</b></h2>
                        <ul>
                            <li>Wide network of skilled lawyers</li>
                            <li>Easy consultation booking</li>
                            <li>Secure and confidential case handling</li>
                            <li>Commitment to professionalism and client satisfaction</li>
                        </ul>

                        <h2><b>Contact Us</b></h2>
                        <p><b>Address:</b> Jalgaon.</p>
                        <p><b>Contact No.:</b> 9373584120</p>
                        <p><b>Email:</b>patilapurva1209@gmail.com</p>
                    </div>
                </div>
            </div>
        </section>
        
        <footer class="bg-success">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h5><b>All rights reserved 2025</b></h5>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" xintegrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" xintegrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>
