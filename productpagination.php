<?php

$max_entries=5;

if (isset($_GET["page"])){
    $page=$_GET["page"];
    
}else{
    $page=1;
}

$start=($page-1)*$max_entries;

function connectToDB()
{
    global $errorMsg,$success,$start,$max_entries;
                        
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
          $stmt = $conn->prepare("SELECT * FROM product LIMIT $start,$max_entries");
          $stmt->execute();
          $result=$stmt->get_result();
          while ($row=$result->fetch_assoc()){
              echo $row['id'];
          }
      }
      }
      
      
?>
      
