<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
               <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <!--jQuery--><script defer 
        src="https://code.jquery.com/jquery-3.4.1.min.js"    
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="    
        crossorigin="anonymous"></script>
        
        <!--Bootstrap JS--> <script defer    
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"    
        integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"   
        crossorigin="anonymous"></script>
        <script defer src="Js/Popup.js"></script>
        <link rel="stylesheet" href="css/project.css"> 
        <title></title>
    </head>
    <body>
        <header>
            <?php
            include "navbar.php";
                if (isset($_SESSION["student_id"])) {
                    echo "<p>Welcome " . $_SESSION["fname"] . " " . $_SESSION["lname"] ."!</p>";
                }
            ?>
        </header>
        <section>
            
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img class="d-block" src="images/notes1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
        <img class="d-block" src="images/notes1.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
        <img class="d-block" src="images/notes1.jpg" alt="Third slide">
    </div>
  </div>
            
            </div>

        </section>
        <?php
        // put your code here
        ?>
        
        
    <footer >    
          <div>
          <form action="action_page.php" >
              <h1>Contact us</h1>
                 <div id="textleft">
              <div class="flex-container">
          <div> <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Your name">
        </div> 
          <div> <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Your last name">
          </div>
        </div>

           
         <label for="email">Email</label>
         <input type="text" placeholder="Enter Email" name="email" id="email" required>
            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Enter your message here" maxlength="400"></textarea>
              </div>
            <input type="submit" value="Submit">

          </form>
               <p id="copywrite">Copyright &copy; 2021, SIT Buddy Help </p>
          </div>  
    </footer>           
    </body>
</html>
