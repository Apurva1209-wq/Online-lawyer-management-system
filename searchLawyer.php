<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/simple-sidebar.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/media.css">
		<title></title>
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
									<li class="active">
										<a class="nav-link cus-a" href="index.php">Home <span class="sr-only">(current)</span></a>
									</li>
									<li class="">
										<a class="nav-link cus-a" href="lawyers.php">Lawyers</a><!--lawyers.html page-->
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
												<a class="dropdown-item" href="lawyer_register.php">Register as a lawyer</a><!--redirect lawyer register page-->
												<a class="dropdown-item" href="user_register.php">Register as a user</a><!--redirect user register page-->
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
		<body>
			<section class="lawyerscard">
				<div class="container">
					<form method="post" novalidate="novalidate" >
						
						<div class="row">
							
							<div class="col-md-4">
								<div class="form-group">
									<label for="experience">Experience</label>
									<select name="experience" class="form-control">
										<option value="" selected>Choose...</option>
										<option value="1-5 years">1-5 years</option>
										<option value="6-10 years">6-10 years</option>
										<option value="11-15 years">11-15 years</option>
										<option value="16-20 years">16-20 years</option>
										<option value="Most Senior">Most Senior</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group ">
									<label for="speciality">Speciality</label>
									<select name="speciality" class="form-control">
										<option value="" selected>Choose...</option>
										<option value="Criminal law">Criminal law</option>
										<option value="Civil law">Civil law</option>
										<option value="Writ Jurisdiction">Writ Jurisdiction</option>
										<option value="Company law">Company law</option>
										<option value="Contract law">Contract law</option>
										<option value="Commercial law">Commercial law</option>
										<option value="Construction law">Construction law</option>
										<option value="IT law">IT law</option>
										<option value="Family law">Family law</option>
										<option value="Religious law">Religious law</option>
										<option value="Investment law">Investment law</option>
										<option value="Labour law">Labour law</option>
										<option value="Property law">Property law</option>
										<option value="Taxation law">Taxation law</option>
										
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<label for="location">Location</label>
								<select name="location" class="form-control"> 
									<option selected>Choose...</option>
									<option value="Mumbai">Mumbai</option>
									<option value="Delhi">Pune</option>
									<option value="Goa">Goa</option>
									<option value="Jalgaon">Jalgaon</option>
									<option value="Surat">Surat</option>
									<option value="Nandurbar">Nandurbar</option>
									<option value="Nashik">Nashik</option>
									<option value="Shirpur">Shirpur</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8"></div>
							<div class="col-md-4">
								<button id="button" type="submit" class="btn btn-mg btn-primary" name="submit" value="submit" style="float:right"><i class="fa fa-search"></i>&nbsp; Search Information</button>
							</div>	
						</div>
					</form>
					<hr/>
					<div class="row " >
						
						<?php
							include_once 'db_con/dbCon.php';
							$conn = connect();
							if (isset($_POST['submit'])){
								$experience=$_POST['experience'];
								$speciality=$_POST['speciality'];
								$location=$_POST['location'];
								
								$result = mysqli_query($conn,"SELECT * FROM user,lawyer WHERE user.u_id=lawyer.lawyer_id 
								AND user.status='Active'
								OR practise_Length='$experience'
								OR speciality='$speciality'
								OR city='$location'");
								
								while($row = mysqli_fetch_array($result)) {
									
								?>
								<div class="col-md-4">
									<div class="card" style="width: 18rem;">
										<img src="images/upload/<?php echo $row["image"]; ?>" class="card-img-top cusimg img-fluid" alt="img">
										<div class="card-body">
											<h5 class="card-title"><?php echo $row["first_Name"]; ?> <?php echo $row["last_Name"]; ?></h5> <!--lawyers name dynamic-->
											<h6 class="card-title"><?php echo $row["speciality"]; ?></h6> <!--lawyers practice speciality dynamic-->
											<h6 class="card-title"><span><?php echo $row["practise_Length"]; ?></span></h6> <!--lawyers practice time dynamic-->
											
											<a class="btn btn-sm btn-info" href="single_lawyer.php?u_id=<?php echo $row["u_id"]; ?>"><i class="fa fa-street-view"></i>&nbsp; View Full Profile</a>
										</div>
									</div>
								</div>
								<?php
								}}
						?>
					</div>
				</div>
			</div>
		</section>
		
		
		
		<footer class="bg-success">
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
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	</body>
</html>
