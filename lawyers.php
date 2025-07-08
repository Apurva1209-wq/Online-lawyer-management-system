<?php
// Start the session to use $_SESSION variables
session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Bootstrap CSS -->
        <!-- Removed commented out Bootstrap CSS link as it's redundant with local files -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" xintegrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/simple-sidebar.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/media.css">
        <title>Lawyers Profile</title> <!-- Added a specific title -->
    </head>
    <body>
        <header class="customnav bg-success">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg ">
                            <a class="navbar-brand cus-a" href="index.php">Lawyer Management System</a>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto ">
                                    <li class="">
                                        <a class="nav-link cus-a" href="index.php">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="active"> <!-- Marked Lawyers as active in nav -->
                                        <a class="nav-link cus-a" href="lawyers.php">Lawyers</a>
                                    </li>
                                    <li class="">
                                        <a class="nav-link cus-a" href="#">About Us</a>
                                    </li>
                                    <?php if(isset($_SESSION['login']) && $_SESSION['login'] == TRUE){ ?>
                                        <li class="">
                                            <a class="nav-link cus-a" href="user_dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="">
                                            <a class="nav-link cus-a" href="logout.php">Logout</a>
                                        </li>
                                        <?php }else{ ?>
                                        <li class="">
                                            <a class="nav-link cus-a" href="login.php">Login</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle cus-a" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Register
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="lawyer_register.php">Register as a lawyer</a>
                                                <a class="dropdown-item" href="user_register.php">Register as a user</a>
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

        <!-- Main Content Area to display Lawyers -->
        <body>
            <div class="" id="wrapper">
                <section class="">
                    <div class="container">
                        <br/>
                        <a href="searchLawyer.php"type="submit" class="btn btn-md btn-primary "><i class="fa fa-search"></i>&nbsp; Find Lawyer</a>
                        <hr/>
                        <div class="row">
                            <?php
                                include_once 'db_con/dbCon.php';
                                $conn = connect();
                                
                                // SQL query to select active lawyers
                                $sql = "SELECT user.first_Name, user.last_Name, user.u_id, user.status, lawyer.speciality, lawyer.practise_Length, lawyer.image 
                                        FROM user, lawyer 
                                        WHERE user.u_id = lawyer.lawyer_id AND user.status = 'Active'";
                                $result = mysqli_query($conn, $sql);
                                
                                // Check if the query returned any rows
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_array($result)) {
                            ?>
                                    <div class="col-md-4 mb-4"> <!-- Added mb-4 for bottom margin -->
                                        <div class="card" style="width: 18rem;">
                                            <!-- DEBUGGING: Echo the image path to see what's being generated -->
                                            <?php 
                                            // This will print the full path being used for the image.
                                            // Check your browser's inspect element (console or elements tab) for this output.
                                            // Example: Debug Image Path: images/upload/1575882.jpg
                                            echo "<!-- Debug Image Path: images/upload/" . htmlspecialchars($row["image"]) . " -->";
                                            ?>
                                            <img src="images/upload/<?php echo htmlspecialchars($row["image"]); ?>" class="card-img-top cusimg img-fluid" alt="Lawyer Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo htmlspecialchars($row["first_Name"]); ?> <?php echo htmlspecialchars($row["last_Name"]); ?></h5>
                                                <h6 class="card-title"><?php echo htmlspecialchars($row["speciality"]); ?></h6>
                                                <h6 class="card-title"><span>Practise Length: <?php echo htmlspecialchars($row["practise_Length"]); ?> Years</span></h6>
                                                
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
            </div>
        </body>
        
        <footer class ="bg-success mt-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h5>All rights reserved 2025</h5>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Optional JavaScript -->
        <!-- jQuery -->
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" xintegrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" xintegrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>
