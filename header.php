<div class="container">
    <div class="navbar-header">
        <!-- responsive nav button -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
        <!-- /responsive nav button -->

        <!-- logo -->
        <div class="navbar-brand">
            <a href="index.php">
                <img src="images/mstile.png" alt="">
            </a>
        </div>
        <!-- /logo -->
    </div>
    <!-- main menu -->
    <nav class="collapse navbar-collapse navbar-right" role="navigation">
        <div class="main-menu">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="color.php">Color Buddy</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if(!isset($_SESSION['logged_in'])){?>
                <li>
                    <!--<h2>Log In Here!</h2>-->
                    <button class="log_reg" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
                </li>
                <?php }?>
                <?php if(isset($_SESSION['logged_in'])){
                             echo "<li><a href=\"logout.php\">Logout</a><li>";
                            }?>
                <?php if(isset($_SESSION['logged_in'])){
                            echo "<li id=\"user-icon\" style=\"color:#000;\"><i class=\"ion-android-person\"></i> ".$_SESSION['logged_in_user']."</li>";
                             }?>
            </ul>
        </div>
    </nav>
    <!-- /main nav -->
</div>