<!DOCTYPE html>
<html class="no-js">
<?php
    error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include("db_connect.php"); //connect to database
    include("login.php");
   
	if(isset($_SESSION['logged_in'])){
        //$log_id = $_SESSION['logged_in_user_id'];
        $select_palettes_query = 
                                "SELECT
                                    u.user_name,
                                    p.palette_name,
                                    p.palette_colors,
                                    p.palette_id,
                                    p.website_name
                                FROM cb_users u, cb_palettes p
                                WHERE p.user_id = u.user_id
                                AND u.user_id = '".$_SESSION['logged_in_user_id']."'
                                ORDER BY palette_id DESC";

        $select_palettes_result = mysqli_query($connection,$select_palettes_query);
    }

?>


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
        <!--
        ==================================================
        Header Section Start
        ================================================== -->
        <header id="top-bar" class="navbar-fixed-top animated-header">
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
                            <h2>Color Buddy</h2>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="index.php">
                                        <i class="ion-ios-home"></i> Home
                                    </a>
                                </li>
                                <li class="active">Color</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/#Page header-->
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
        <div class="palette_count">
            <p>Count</p>
            <p id="count">0</p>
            <a href="#view_palette">View</a>
        </div>
        <section id="blog-full-width">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Find Color Swatches</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="search widget">
                        <form action="" method="get" class="searchform" role="search">
                            <div class="input-group">
                                <input type="text" id="url_text" required class="form-control text-center" placeholder="Insert website url...">
                                <span class="input-group-btn">
                                    <button id="url_search" class="btn btn-default" type="submit"> <i class="ion-search"></i> </button>
                                </span>
                            </div>
							<div class="alert alert-info alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>Important!</strong> Select a maximum of 5 colors to create a palette.
							</div>
                            <!-- /input-group -->
                        </form>
                    </div>  <!-- div search widget end-->
                </div>      <!-- col end --> 
                <div class="col-lg-3"></div>
            </div>          <!-- div row end-->
             <div class="row"> 
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6 text-center">
                    <div class="screen-thum">
                        <img class="col-lg-12" src="images/balls.svg" alt="loading..." id="loading1" style="display:none;" width="128" height="128">
                        <!--<img src="http://api.screenshotlayer.com/api/capture?access_key=d25d40f9853f09059b70e9e7fa3bfb82&url=http://facebook.com&viewport=1440x900&width=600&height=400&format=jpg" id="thumbnail" style="display:none;"> --><!--Image Thumbnail-->
                    </div>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
            <div class="row"> <!-- Where colors will apear --> 
                <form class="col-lg-12" id="swatches">
                    
                </form>
                <img class="col-lg-12" src="images/balls.svg" alt="loading..." id="loading" style="display:none;" width="128" height="128"><!--loading-->
            </div>

        </div>              <!-- div container end -->
    </section>
    <section id="view_palette">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
             <?php if(isset($_SESSION['logged_in'])){ ?>
                 <h3 class="text-center">Create Palette</h3>
             <?php }?>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                <form action="" method="POST" name="create" id="make_palette">
                    <!--<div class="col-lg-12">-->
                        <div class="e_palette">
                            <!--Individual hex colors added as palettes-->
                        </div>
                    <!--</div>-->
                    <?php if(isset($_SESSION['logged_in'])){ ?>
                    <!--<div class="create_group">-->
                       <!-- <div class="col-lg-12">-->
                            <div class="form-group">
                                <input type="text" class="form-control" required name="name_palette" placeholder="Palette name" id="name_palette" style="display:none;">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-default" name="make_palette_button" id="make_palette_button" value="Create Palette" style="display:none;">
                            </div>
                        <!--</div>-->
                    <!--</div>-->
                    <?php } ?>
                    <!-- <div class="row">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-6">
                    
                    </div>
                    <div class="col-lg-3">
                    </div>
                </div>-->
                </form>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        </div>
        </div>
    </section>
    <hr>
    <?php if(isset($_SESSION['logged_in'])){?>
    <section id="my-palettes">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center"> My Palettes </h3>
                </div>
                <div class="row" id="list_palettes"> <!-- Color Palettes go in here -->
            <?php 
                
                function longUrl($x, $length){
                    
                    if(strlen($x)<=$length){
                        echo $x;
                    }else{
                        $y=substr($x,0,$length) . '...';
                        echo $y;
                    }
                }

                    //if(mysqli_num_rows($select_palettes_result) == 1 ){
                        while($row = mysqli_fetch_array($select_palettes_result,MYSQLI_ASSOC)){
                          $ex =  explode(',', $row["palette_colors"]);
                            echo '<div class="col-lg-4">';
                            echo   '<p>'.$row["palette_name"].'</p>';
                            echo  '<div class="palette_wrap">';
                        foreach ($ex as $value) {
                             echo '<div title="'.$value.'" style="background-color:'.$value.'; width:70px; height:200px; display:inline-block;">';
                             echo '</div>';
                            // echo '<p>'.$value.'</p>';
                          }
                          unset($value);
                          echo  '<p><em><strong>Made from:</strong>'.' '; 
                          echo   longUrl($row["website_name"],25);
                          echo  '</em></p>';
                          echo  '</div>';
                          echo  '</div>';
                      
                        }
                  
               // }
            ?>

                </div>
            </div>  <!-- end row -->
        </div>      <!-- end container -->
    </section>
    <?php }?>
        <!--
                    ==================================================
                    Call To Action Section Start
                    ================================================== -->
        <section id="call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <h2 class="title wow fadeInDown" data-wow-delay=".3s" data-wow-duration="300ms">SO WHAT DO YOU THINK ?</h1>
                                <p class="wow fadeInDown" data-wow-delay=".5s" data-wow-duration="300ms">Colors as you can see can be manipulated in many different ways.<br>
                                    Have any questions about the use of color? Drop us a message today.</p>
                                <a href="contact.php" class="btn btn-default btn-contact wow fadeInDown" data-wow-delay=".7s" data-wow-duration="300ms">Contact Me</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
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
        <script>
            // Get the modal
            var modal = document.getElementById('id01');
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
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
    <?php mysqli_close($connection);?>

</html>