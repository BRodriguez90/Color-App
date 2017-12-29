<?php

//accountcreate.php provides a form for users to create an account. It checks to see if the account exists. If not, it randomly generates pet stats and then creates the account and stores to database.


	session_start();
	include("db_connect.php"); //Connects to database
    include("login.php");
	
	if(isset($_POST['submit'])){	//If data in form field
		//Store form values into variables using the POST method
		$username = $_POST['username'];
		$password = $_POST['password'];

		
		$sql = "SELECT * FROM cb_users WHERE user_name='" . $username . "' LIMIT 1"; //Check to see if account already exists
		$result = mysqli_query($connection, $sql); //store results of query in $result var
		
		if (mysqli_num_rows($result) == 1){	//If at least one result
			echo "Account already exists. Please try a new username."; //account already exists
		
		}else{	//If new account
			$sql = "INSERT INTO cb_users (user_name,user_password) VALUES('$username','$password')"; //prepare to add stats to database table
			mysqli_query($connection, $sql); //run the query
			echo "Account successfully created. Log in to get started! You will be redirected to the login page in 3 seconds.";
			header("Refresh: 3; url=color.php"); //Takes user to login page in 3 secs
		}
	
	} else {
		// do nothing
	}

?>

    <html>

    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <title>Color Buddy</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Template CSS Files
        ================================================== -->
        <link rel="stylesheet" href="css/login.css">
        <!-- Twitter Bootstrs CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Ionicons Fonts Css -->
        <link rel="stylesheet" href="css/ionicons.min.css">
        <!-- animate css -->
        <link rel="stylesheet" href="css/animate.css">
        <!-- Hero area slider css-->
        <link rel="stylesheet" href="css/slider.css">
        <!-- owl craousel css -->
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/jquery.fancybox.css">
        <!-- template main css file -->
        <link rel="stylesheet" href="css/main.css">
        <!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css">


    </head>

    <body>
        <header id="top-bar" class="navbar-inverse navbar-fixed-top animated-header">
            <?php include('header.php'); ?>
        </header>
        <!--
        ==================================================
        Global Page Section Start
        ================================================== -->
        <section class="global-page-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <h2>Color Pallets</h2>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="index.html">
                                        <i class="ion-ios-home"></i> Home
                                    </a>
                                </li>
                                <li class="active">Color</li>
                                <a href="color.php"></a>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/#Page header-->
        <section id="blog-full-width">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 align="center"><b>Create User Account Here</b></h3>
                    </div>

                    <div id="id01" class="modal">

                        <form class="modal-content animate" action="" method="POST">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                <img src="images/cb_logo.png" alt="Avatar" height="100" width="100f">
                            </div>

                            <div class="_container">
                                <label><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="username" required>

                                <label><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password" required>

                                <button class="log_reg" type="submit" name="login">Login</button>
                                <input type="checkbox" checked="checked"> Remember me
                            </div>

                            <div class="_container" style="background-color:#f1f1f1">
                                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                <span class="psw">Forgot <a href="#">password?</a></span>
                                <p>Don't have an account? <a href="accountcreate.php">Create one!</a></p>
                            </div>
                        </form>
                    </div>

                    <form class="contact-form" method="POST" action="">

                        <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".6s">
                            <div class="container">
                                <label><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="username" required>
                            </div>
                        </div>


                        <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".6s">
                            <div class="container">
                                <label><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password" required>
                            </div>
                        </div>

                        <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".6s">
                            <div class="container" style="background-color:##228B22">
                                <button type="submit" name="submit" class="cancelbtn">Register</button>
                                <input type="checkbox" checked="checked"> Remember me
                            </div>
                        </div>

                        <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".6s">
                            <div class="container" style="background-color:#f1f1f1">
                                <button type="button" class="cancelbtn">Cancel</button>
                            </div>
                        </div>
                    </form>



                    <!--
                    ==================================================
                    Footer Section Start
                    ================================================== -->
                    <footer id="footer">
                        <div class="container">
                            <div class="col-md-8">
                                <p class="copyright">Copyright: <span>2017</span> . Design and Developed by <a href="">Dig 4503 Rapid App</a></p>
                            </div>
                            <div class="col-md-4">
                                <!-- Social Media -->
                                <ul class="social">
                                    <li>
                                        <a href="#" class="Facebook">
                                            <i class="ion-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="Twitter">
                                            <i class="ion-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="Linkedin">
                                            <i class="ion-social-linkedin"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="Google Plus">
                                            <i class="ion-social-googleplus"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </footer>
                    <!-- /#footer -->
                    <!-- Template Javascript Files
        ================================================== -->
                    <!-- modernizr js -->
                    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
                    <!-- jquery -->
                    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                    <!-- owl carouserl js -->
                    <script src="js/owl.carousel.min.js"></script>
                    <!-- bootstrap js -->
                    <script src="js/bootstrap.min.js"></script>
                    <!-- wow js -->
                    <script src="js/wow.min.js"></script>
                    <!-- slider js -->
                    <script src="js/slider.js"></script>
                    <script src="js/jquery.fancybox.js"></script>
                    <!-- template main js -->
                    <script src="js/main.js"></script>

                    <script src="js/api_script.js"></script>
    </body>

    </html>