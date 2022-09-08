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
        <?php
        include "head.inc.php";
        
        ?>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        
        <?php
        
        $student_id=$_SESSION['student_id'];
        connectToDB();

        function connectToDB()
        {
            global $errorMsg,$success,$student_id;
                        
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
           
                $stmt = $conn->prepare("SELECT * FROM product P, service_has_product S WHERE P.product_id = S.product_product_id AND student_id=".$student_id."");
                $stmt->execute();
                $result=$stmt->get_result();
                
                $_SESSION['result']=$result;
                
                
                $stmt3 = $conn->prepare("SELECT * FROM service T, service_has_product S WHERE T.service_id = S.service_service_id AND student_id=".$student_id."");
                $stmt3->execute();
                $result3=$stmt3->get_result();
                
                $_SESSION['result3']=$result3;
             }
            }
            
        
           ?>
        
        <div class="table-responsive-md">
        <table class="table table-borderless">
            <thread>
                <tr>
                    <th scope="col">Details</th>
                    <th scope="col">Actions</th>
                </tr>
                <tbody action="payment.php" method="post">
                    <?php
                    echo "<p id=product_id></p>";
                    while ($row=$_SESSION['result']->fetch_assoc()){
                        echo "<tr>";
                        echo "<td> #".($row['module_code'])." Notes <br><br>";
                        echo ($row["description"])."<br><br>";
                        echo "Price : $".($row["price"])."";
                        echo "</td>";
                        echo "<p id=product_id></p>";
                        
                        
                    }
                        
                    echo "<p id=service_id></p>";
                    while ($row=$_SESSION['result3']->fetch_assoc()){
                        echo "<tr>";
                        echo "<td> #".($row['module'])." Service <br><br>";
                        echo "Price : $".($row["price"])."/".($row["time"])."";
                        echo "Mode of Service : ".($row["mode_of_service"])."";
                        echo "</td>";
                        echo "<p id=service_id></p>";
                        
                        
                    }

                    ?>
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                </tbody>
                
      
     </div>
    </body>
     
     
<?php 
        include "footer_other.php";
 ?>    
        
</html>
                

                
