<?php

session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
session_unset(); // unset $_SESSION variable for the run-time
session_destroy(); 
header("location: ../BuddyHelp/index.php");// destroy session data in storage}
}
?>
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
        <script type="text/javascript">
            
            
            
         function cart(service_id)
         {
             
             $.ajax({
                 type: 'POST',
                 url: 'addtocart.php',
                 data:{
                     sid: service_id
                     
                 },
                 success:function(response){
                     document.getElementById("service_id").innerHTML=response
                     
                     console.log(response);
                 }
             });
         }
         </script>
        <title></title>
    </head>
    <body>
         <?php
        include "nav.inc.php";
        
        $service_id=$_GET['sid'];
        $curr_page=$_SESSION['page'];
        connectToDB();
        
        function connectToDB()
        {
            global $errorMsg,$success,$service_id,$curr_page;
                        
            $config = parse_ini_file('../../private/db-config.ini');    
            $conn = new mysqli($config['servername'], $config['username'],           
                $config['password'], $config['dbname']);    
      // Check connection    
            if ($conn->connect_error)    
            {        $errorMsg = "Connection failed: " . $conn->connect_error;   
                     echo $errorMsg;
                     $success = false;    
               
            }
            else
            {
                $stmt = $conn->prepare("SELECT * FROM service WHERE service_id=".$service_id."");
               // $stmt = $conn->prepare("SELECT email FROM buddy_help_members B, service S Where B.student_id = S.seller_id And S.service_id=".$service_id."");
                $stmt->execute();
                $result=$stmt->get_result();
                $_SESSION['curr_service']=$result;
             }
            }
      
        ?>
       <div class="table-responsive-md">
        <table class="table table-borderless">
            <a href="viewservice.php?page=<?php echo $curr_page?>">Return back to service page!</a>
            <thread>
                <tr>
                    <th scope="col">Service Details</th>
                </tr>
                <tbody>
                    <?php                   
                    echo "<p id=service_id class='addtocart'></p>";
                    while ($row=$_SESSION['curr_service']->fetch_assoc()){
                        echo "<tr>"; 
                        echo "<td>#".($row['module'])." Service<br><br>";
                        echo "Seller ID: ".($row['seller_id'])."<br><br>";
                        echo "Status: ". $_SESSION["status"]."<br><br>";
                        echo "Tutor Type: ".($row['mode_of_service'])."<br><br>";
                        echo "Price : $".($row["price"])."/".($row['time'])."<br><br>";
                        echo "Days Available: ".($row["date"])."<br><br>";
                        echo "For More Detailed Planning Please Contact The Tutor Personally AFTER Payment.<br><br>";
                       // echo "Tutor Email: ".($row['email'])."<br><br>";
                        echo "<div class='icon1'><a onclick='cart(".$row["service_id"].")' ><img class='icon1' src='images/addcart3.png' width='55px' height='65px' alt='alt'/><p class='icondescription1'>Click here to add to cart!</p></a></div>";
                        echo "</td>";
                        
                    }
                        

                    ?>
   
                </tbody>
        
</html>