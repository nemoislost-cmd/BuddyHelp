<?php
    session_start();
?>

<!DOCTYPE html>
<header>

  <nav class="navbar navbar-expand-sm"  style="background-color: #C4CBCC;" >   
      <a class="navbar-brand" href="/index.php"><img src='images/SIT_Buddy_Help_red_logo.png' style="max-width:90px" alt='LOGO'/></a> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-right: 5%;">
            <ul class="navbar-nav mr-auto mx-auto" >       
                <li class="nav-item">            
                    <a class="nav-link" href="index.php">Home</a>        
                </li>  
                <li class="nav-item">            
                    <a class="nav-link" href="about.php">About</a>        
                </li>        
                <li class="nav-item">            
                    <a class="nav-link" href="viewproducts.php">Product</a>        
                </li>   
                 <li class="nav-item">            
                    <a class="nav-link" href="services.php">Services</a>        
                </li> 
                <?php
                    if (isset($_SESSION["student_id"])) {
                        echo "<li><a class='nav-link' href='profile.php'>Profile</a></li>";
                        echo "<li><a class='nav-link' href='logout.php'>Logout</a></li>";
                    }
                    else {
                        echo "<li><a class='nav-link' href='register.php'>Register</a></li>";
                        echo "<li><a class='nav-link' href='login.php'>Login</a></li>";
                    }
                ?>
                <!-- <li class="nav-item">            
                    <a class="nav-link" href="register.php">Register</a>        
                </li>
                <li class="nav-item">            
                    <a class="nav-link" href="login.php">Login</a>        
                </li> -->
            </ul>

        </div>                
    </nav>
</header>

