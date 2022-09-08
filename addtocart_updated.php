
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
if(isset($_POST['id']))
  {
    
    $_SESSION['product_id']=$_POST['id'];
    echo "Item successfully added to cart!";
    echo "".($_SESSION['product_id'])."";
    
 /* }
     if(isset($_SESSION['product_id'])){

        $item_array_id = array_column($_SESSION['product_id'], "product_id");

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{

            $count = count($_SESSION['product_id']);
            $item_array = array(
                'product_id' => $_POST['id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['id']
        );

        // Create new session variable
        $_SESSION['product_id'][0] = $item_array;
        print_r($_SESSION['product_id']);
    }
  
 
  */
    
    $product_id=$_SESSION["product_id"];
    $student_id=$_SESSION["student_id"];
    $paid=0;

             global $errorMsg,$success,$start,$max_entries,$product_id,$student_id,$paid;
                        
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
                $stmt = $conn->prepare("INSERT INTO service_has_product (product_product_id, student_id,paid) VALUES (?, ?, ?)");  
                $stmt->bind_param("ssd", $product_id, $student_id,$paid); 
               if (!$stmt->execute())        
               {            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;  
                            echo $errorMsg;
                            $success = false;        
               
               }        
               $stmt->close();  
            }
  }
  
  elseif(isset($_POST['sid'])){
      
      $_SESSION['service_id']=$_POST['sid'];
       echo "Item successfully added to cart!";
    echo "".($_SESSION['service_id'])."";
  
   $service_id=$_SESSION["service_id"];
    $student_id=$_SESSION["student_id"];
    $paid=0;
    

             global $errorMsg,$success,$start,$max_entries,$service_id,$paid;
                        
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
                $stmt = $conn->prepare("INSERT INTO service_has_product (service_service_id, student_id,paid) VALUES (?, ?, ?)");  
                $stmt->bind_param("ssd", $service_id, $student_id,$paid); 
               if (!$stmt->execute())        
               {            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;  
                            echo $errorMsg;
                            $success = false;        
               
               }        
               $stmt->close();  
            }
  }
  
?>
