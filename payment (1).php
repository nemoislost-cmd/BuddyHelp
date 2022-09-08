
<?php

session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
session_unset(); // unset $_SESSION variable for the run-time
session_destroy(); 
header("location: ../BuddyHelp/index.php");// destroy session data in storage}

}
?>
<?php
if(isset($_POST['rid']))
  {
    
    $_SESSION['receipt_id']=$_POST['rid'];
    echo "".($_SESSION['recipt_id'])."";
    
    $receipt_id=$_SESSION["recipt_id"];
    $student_id=$_SESSION["student_id"];
    $paid="yes";
    

             global $errorMsg,$success,$start,$max_entries,$receipt_id,$student_id,$paid;
                        
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
                $stmt="UPDATE service_has_product SET recipt_id = ".$receipt_id.", paid = ".$paid." WHERE student_id=".$_SESSION["student_id"]." and recipt_id is null";
                       mysqli_query($conn, $stmt);
               if (!$stmt->execute())        
               {            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;  
                            echo $errorMsg;
                            $success = false;        
               
               }        
               $stmt->close();      
      }
      $conn->close();        
      echo "hi";
  }
  

  
  
?>
<html>
    <body><p>hi</p></body>
</html>