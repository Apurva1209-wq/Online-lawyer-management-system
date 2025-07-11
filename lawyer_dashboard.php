<?php
    session_start();
    if($_SESSION['login']==TRUE AND $_SESSION['status']=='Active'){
        include("db_con/dbCon.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/simple-sidebar.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/media.css">
        <title>Lawyer Dashboard</title> </head>
    <body>
        <header class="customnav bg-success">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg ">
                            <a class="navbar-brand cus-a" href="#">Lawyer Management System</a>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto ">
                                    <li class="">
                                        <a class="nav-link cus-a" href="#">Full Name: <?php echo $_SESSION['first_Name'];?> <?php echo $_SESSION['last_Name'];?></a>
                                    </li>
                                    <li class="">
                                        <a class="nav-link cus-a" href="logout.php">Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <div class="d-flex" id="wrapper">
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">My Profile</div>
                <div class="list-group list-group-flush">
                    <a href="lawyer_dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                    <a href="lawyer_edit_profile.php" class="list-group-item list-group-item-action bg-light">Edit Profile</a>
                    <a href="lawyer_booking.php" class="list-group-item list-group-item-action bg-light">Booking requests</a>
                    <a href="update_password_admin.php" class="list-group-item list-group-item-action bg-light">Update Password</a>
                </div>
            </div>
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <?php if(isset($_GET['done'])){ ?>
                        <div class='alert alert-danger alert-dismissible fade show'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <strong>Welcome!</strong> You are login as Lawyer.
                        </div>
                    <?php }?>

                    

                    <?php
                    // Personalized greeting
                    $firstName = $_SESSION['first_Name'];
                    echo "<h2>Welcome, " . $firstName . "!</h2>";
                    echo "<p>We're glad to have you back.</p>"; 
                    ?>

                    
                </div>
            </div>
        </div>
        <footer>
            <div class="container bg-success">
                <div class="row">
                    <div class="col">
                        <h5>All rights reserved 2025</h5>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>        
<?php
    }else 
    header('location:login.php?deactivate');
?>