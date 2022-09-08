<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
               <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <!--jQuery-->
        <script defer 
        src="https://code.jquery.com/jquery-3.4.1.min.js"    
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="    
        crossorigin="anonymous"></script>
        
        <!--Bootstrap JS-->
        <script defer    
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"    
        integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"   
        crossorigin="anonymous"></script>
        <script defer src="Js/Popup.js"></script>
        <link rel="stylesheet" href="css/project.css"> 
                <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript">
            
            
            
         function cart(product_id)
         {
             
             $.ajax({
                 type: 'POST',
                 url: 'addtocart.php',
                 data:{
                     id: product_id
                     
                 },
                 success:function(response){
                     document.getElementById("product_id").innerHTML=response
                     
                     console.log(response);
                 }
             });
         }
         </script>
        <title></title>
    </head>
    <body>
        <?php
        include "navbar.php";
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
                     echo$errorMsg;
                     $success = false;    
               
            }
            else
            {
                $stmt = $conn->prepare("SELECT * FROM product LIMIT $start,$max_entries");
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
                         echo$errorMsg;
                         $success = false;    
               
                }
                else
                {
                    $stmt2 = "SELECT COUNT(*) FROM product";
                    $result2 = mysqli_query($conn,$stmt2);
                    $rows = mysqli_fetch_row($result2);

                    $TOTAL_PRODUCTS=$rows[0];
                    $max_pages=ceil($TOTAL_PRODUCTS/$max_entries);
                    $_SESSION['max_pages']=$max_pages;
                }
            }
            
            
        
           ?>
        <div class="table-responsive-md">
        <table class="table table-borderless">
            <thread>
                <tr>
                    <th scope="col">Product Image</th>
                    <th scope="col">Details</th>
                    <th scope="col">Actions</th>
                </tr>
                <tbody>
                    <?php
                    var_dump($_SESSION["loggedin"]);
                    var_dump($_SESSION["product_id"]);
                    echo "<p id=product_id class='addtocart'></p>";
                    while ($row=$_SESSION['result']->fetch_assoc()){
                        echo "<tr>";
                        echo "<th scope='row'>".'<div class="icon1"><img class="icon1" src="data:image/PNG;base64,'.base64_encode( $row['sample_image'] ).'" alt="sampleimage" height="100px" width ="100px" /><p class="icondescription1">Click to view full Image!</p></div>';
                        echo "<td> #".($row['module_code'])." Notes <br><br>";
                        echo ($row["description"])."<br><br>";
                        echo "Price : $".($row["price"])."";
                        echo "</td>";
                        echo "<p id=product_id></p>";
                        
                        if ($_SESSION["loggedin"]==1){
                            echo "<td><div class='icon1'><a href='viewlisting.php'><img class='icon1' src='images/viewlisting.png' width='65px' height='75px' alt='View Full Listing' /><p class='icondescription1'>Click here to view Full Listing!</p></a></div>";
                            echo "<div class='icon1'><a onclick='cart(".$row["product_id"].")' ><img class='icon1' src='images/addcart3.png' width='55px' height='65px' alt='alt'/><p class='icondescription1'>Click here to add to cart!</p></a></div>";
                            echo "</td>";
                            
                        }else{
                            echo "<td><div class='icon1'><img class='icon1' src='images/viewlisting.png' width='65px' height='75px' alt='View Full Listing' /><p class='icondescription1'>Please log in to access this feature!</p></div>";
                            echo "<div class='icon1'><img class='icon1' src='images/addcart3.png' width='55px' height='65px' alt='alt'/><p class='icondescription1'>Please log in to access this feature!</p></div>";
                            echo "</td>";
                            
                        }
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
                echo "<a href='viewproducts.php'?page=".($page-1).">Prev</a>";
                    }
                    
            for ($num=1; $num<=$max_pages;$num++){
                if ($num==$page){
                    $pagelink.="<a onClick='gotospecificpage()'class= 'active' href='viewproducts.php'?page=".$num."'>".$num."</a>";
                }else{
                    $pagelink.="<a href='viewproducts.php'?page=".$num."'>".$num."</a>";

                }
                            
            }
            echo $pagelink;
            if ($page <$max_pages){
                echo "<a href='viewproducts.php?page=".($page+1)."'>Next</a>";
            }
                    
             
         
         ?>
        
                <div class="inline">
                    <input id="page" type="number" min= "1" max ="<?php echo $max_pages?>" placeholder="<?php echo $page."/".$max_pages;?>" required>
                    <button onClick="gotospecificpage()">Go</button>
                    
                </div>
        </div>
     </div>
     <script>
      function gotospecificpage()   
{   
        var page = document.getElementById("page").value;   
        page = ((page><?php echo $max_pages; ?>)?<?php echo $max_pages; ?>:((page<1)?1:page));   
        window.location.href = 'viewproducts.php?page='+page;   
}   
      function gotopage()
{
          var page=document.getElementById("page").value;
          window.location.href='viewproducts.php?page='+page;
          
     </script>
     
       
        
</html>
                

                
