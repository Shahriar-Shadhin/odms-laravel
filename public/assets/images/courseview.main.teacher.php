<!DOCTYPE HTML>
<html>
<head>
	<title>Student Attendance System</title>
	<?php include('includes/header.php');?>

    <style>
    label{
        margin: 0px 0px 0px 0px;
    }
    </style>

</head>

<body class="is-preload">
	<!-- Header -->
	<header id="header">
		<a class="logo" href="index.php">Student Attendance System</a>
		<nav>
			<a href="#menu">Menu</a>
		</nav>
	</header>

	<!-- Nav -->
	<nav id="menu">
		<ul class="links">
			<li><a href="teacher.main.php">Home</a></li>
			<li><a href="index.php">Log Out</a></li>
			<!-- <li><a href="generic.html">Generic</a></li> -->
		</ul>
	</nav>

	<!-- Banner -->
	<section id="banner">
		<div class="inner">
			<h1>Course View</h1>
		</div>

	</section>

	<!-- Highlights -->
	<section class="wrapper">
		<div class="inner">

			<div class="highlights">
				<section>
					<div class="content">
						<header>
							<a href="courses.teacher.php" class="icon fa-files-o"><span class="label">Icon</span></a>
							<h3>Microprocessor and assembly language</h3>
						</header>
						<p>CSE-42001</p>
                        <form action="studentdetails.main.teacher.php" method="post">
                        <input type="submit" value="View student details" name="submit">
                        </form>
					</div>

                </section>

			</div>
		</div>
	</section>
	
	<!-- Footer -->
	<?php include('includes/footer.php')?>

	</body>

</html>