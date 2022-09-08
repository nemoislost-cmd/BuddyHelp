<!DOCTYPE html>
<?php

session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
session_unset(); // unset $_SESSION variable for the run-time
session_destroy(); 
header("location: ../BuddyHelp/index.php");// destroy session data in storage}
}
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/invoice.css"> 
    <?php
    include "head.inc.php";
    include "navbar.php";
    ?>
</head>
<body>
<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
     <div class="card">
         <div class="card-header p-4">
             <!--<a class="pt-2 d-inline-block" href="index.html" data-abc="true">Buddy Help</a>
             <div class="float-right">
                 <h3 class="mb-0">Invoice #1234</h3> -->
                 <?php
                 $receipt_id=$_SESSION["rid"];
                 echo "Date: " . date("d-m-Y") . "<br>";
                 //echo $_SESSION['pid1'];
                 //echo var_dump($pid1);
                 $pid1 = $_SESSION['pid1'];
                 $pid_array = str_split($pid1);
                 //echo $pid1;
                 //echo $pid_array[1];
                 //echo $pid_array[2];
                 // Create database connection.
                $config = parse_ini_file('../../private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'],
                        $config['password'], $config['dbname']);
                // Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                }
                
                function connectToDB()
        {
            global $errorMsg,$success,$student_id,$receipt_id;
                        
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
                $stmt = $conn->prepare("SELECT * FROM service_has_product WHERE student_id=".$_SESSION["student_id"]." and recipt_id=".$receipt_id."");
                $stmt->execute();
                $result=$stmt->get_result();
                $_SESSION['result']=$result;
             }
            }
            
            
                ?>
             <script>
                 // Math.random is unique because of its seeding algorithm.
                 // Convert it to base 36 (numbers + letters), and grab the first 9 characters after the decimal.
                 
             </script>
                 <a class="pt-2 d-inline-block" href="index.html" data-abc="true">Buddy Help</a>
                <div class="float-right">
                 <h3 class="mb-0">Invoice #<span id="serial"></span></h3>
                
                 
                 
             </div>
         </div>
         <div class="card-body">
             <div class="table-responsive-sm">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th class="center">#</th>
                             <th>Item</th>
                             <th>Digital<br>/Physical</th>
                             <th>Description</th>
                             <th class="right">Price</th>
                             <th class="center">Status</th>
                         </tr>
                     </thead>
                     <tbody>
                     <?php
                     for ($i = 0; $i < count($pid_array); $i++) {
                         //echo "The number is: $x <br>";
                         $x = $i+1;
                         if ($pid1!=0) {
                            $sql = "SELECT * FROM Buddy_Help.product where product_id=$pid_array[$i];";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                               $module_code = $row['module_code'];
                               $notestype = $row['notestype'];
                               $description = $row['description'];
                               $price = $row['price'];

                               echo "  
                                   var_dump($pid1);
                                   var_dump($pid_array[i]);
                                   <tr>
                                   <td class='center'>$x</td>
                                   <td class='left strong'>$module_code</td>
                                   <td class='left'>$notestype</td>
                                   <td class='left'>$description</td>
                                   <td class='right'>$$price</td>
                                   <td><input type='checkbox' name='status' />&nbsp;</td>
                                   </tr>
                                       ";
                               $total += $price;
                            }
                        } elseif ($pid1==0) {
                            echo "<td>No items in cart to display! </td>";
                        }
                     }
                     ?> 
                     </tbody>
                 </table>
             </div>
             <?php
             if ($module_code != NULL) {
                 echo "
                    <div class='row'>
                        <div class='col-lg-4 col-sm-5'>
                        </div>
                        <div class='col-lg-4 col-sm-5 ml-auto'>
                            <table class='table table-clear'>
                                <tbody>
                                    <tr>
                                        <td class='left'>
                                            <strong class='text-dark'>Total</strong> </td>
                                        <td class='right'>
                                            <strong class='text-dark'>$$total</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>        
             ";
             }
             ?>
         </div>
     </div>
 </div>
</body>
<footer>
    <?php
    include "footer.php";
    ?>
</footer>
    
