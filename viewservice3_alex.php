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
                     document.getElementById("service_id").innerHTML=response;
                     
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
        ?>
        
        <?php
        
        
        $max_entries=4;

        if (isset($_GET["page"])){
            $page=$_GET["page"];
    
        }else{
            $page=1;
        }

        $start=($page-1)*$max_entries;
        $_SESSION['page']=$page;
        connectToDB();

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
                $stmt = $conn->prepare("SELECT * FROM service WHERE moduleyear=3 LIMIT $start,$max_entries");
                $stmt->execute();
                $result=$stmt->get_result();
                
                $_SESSION['result']=$result;
             }
            }
            
        function pageLinkDB()
            {
                global $errorMsg,$success,$start,$max_entries,$page,$result2;
                        
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
                    $stmt2 = "SELECT COUNT(*) FROM service";
                    $result2 = mysqli_query($conn,$stmt2);
                    $rows = mysqli_fetch_row($result2);

                    $TOTAL_SERVICES=$rows[0];
                    $max_pages=ceil($TOTAL_SERVICES/$max_entries);
                    $_SESSION['max_pages']=$max_pages;
                }
            }
            
            
        
           ?>
        <div class="table-responsive-md">
        <table class="table table-borderless">
            <thread>
                <tr>
                    <th scope="col">Services</th>
                    <th scope="col">Actions</th>
                </tr>
                <tbody>
                    <?php
                    echo "<p id=service_id class='addtocart'></p>";
                    while ($row=$_SESSION['result']->fetch_assoc()){
                        echo "<tr>";                 
                        echo "<td> #".($row['module'])." Service <br><br>";
                        echo "Rate : $".($row["price"])."/".($row["time"])."";
                        echo "</td>";
                        echo "<p id=service_id></p>";
                        
                        if (isset($_SESSION["student_id"])){
                            echo "<td><div class='icon1'><a href='viewservice.php?id=".$row["service_id"]."' ><img class='icon1' src='images/viewlisting.png' width='65px' height='75px' alt='View Full Listing' /><p class='icondescription1'>Click here to view Full Listing!</p></a></div>";
                            echo "<div class='icon1'><a onclick='cart(".$row["service_id"].")' ><img class='icon1' name='cart' src='images/addcart3.png' width='55px' height='65px' alt='alt'/><p class='icondescription1'>Click here to add to cart!</p></a></div>";
                            echo "</td>";
                            
                        }else{
                            echo "<td><div class='icon1'><img class='icon1' src='images/viewlisting.png' width='65px' height='75px' alt='View Full Listing' /><p class='icondescription1'>Please log in to access this feature!</p></div>";
                            echo "<div class='icon1'><img class='icon1' src='images/addcart3.png' width='55px' height='65px' alt='alt'/><p class='icondescription1'>Please log in to access this feature!</p></div>";
                            echo "</td>";
                            
                        }
                    }
                    
                    if(isset($_POST['cart'])){
                        printt_r($_POST);
                    }
                        

                    ?>
   
                </tbody>
        <div class="pagination">
         <?php
            pageLinkDB();
            $pagelink=" ";
            $page=$_SESSION['page'];
            $max_pages=$_SESSION['max_pages'];
            if($page>=2){
                echo "<a href='viewservice3.php'?page=".($page-1).">Prev</a>";
                    }
                    
            for ($num=1; $num<=$max_pages;$num++){
                if ($num==$page){
                    $pagelink.="<a onclick='gotospecificpage()'class= 'active' href='viewservice3.php'?page=".$num."'>".$num."</a>";
                }else{
                    $pagelink.="<a href='viewservice3.php'?page=".$num."'>".$num."</a>";

                }
                            
            }
            echo $pagelink;
            if ($page <$max_pages){
                echo "<a href='viewservice3.php?page=".($page+1)."'>Next</a>";
            }
                    
             
         
         ?>
        
                <div class="inline">
                    <input id="page" type="number" min= "1" max ="<?php echo $max_pages?>" placeholder="<?php echo $page."/".$max_pages;?>" required>
                    <button onClick="gotospecificpage()">Go</button>
                    
                </div>
        </div>
     </div>
    </body>
        
     <script>
      function gotospecificpage()   
{   
        var page = document.getElementById("page").value;   
        page = ((page><?php echo $max_pages; ?>)?<?php echo $max_pages; ?>:((page<1)?1:page));   
        window.location.href = 'viewservice3.php?page='+page;   
}   
      function gotopage()
{
          var page=document.getElementById("page").value;
          window.location.href='viewservice3.php?page='+page;
          
     </script>
     
     
<?php 
        include "footer_other.php";
 ?>    
        
</html>
                
