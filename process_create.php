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
        
        
<?php
include "navbar.php";


$modulec = $modulen = $year_u= $typeofn = $inventory_num = $description = $price = $imageExt = $image= $errorMsg="";
$allowed=array('png','jpg','jpeg');
$allowed_document=array('pdf','PDF');
$success= true;
$errorMessageArr=array();
$year1=array('1001','1002','1003','1004','1005','1006','1007','1008','1009','1010');
$year2=array('2901','2902');
$year3=array();
$year4=array();
// validate module code
if (strlen($_POST["modulecode"]) != 4 )
{
    $errorMsg=" ";
    $errorMsg ="Invalid Module Code Entered! Try again!.<br>";
    $success=false;
    $errorMessageArr[]=$errorMsg;
    
}

// validate year
if (strlen($_POST["yearupdated"]) != 4 )
{
    $errorMsg=" ";
    $errorMsg .="Invalid Year Entered! Try again!.<br>";
    $success=false;
    $errorMessageArr[]=$errorMsg;
    
}


// validate inventory num if physical notes
if (($_POST["exampleRadios"]) == 'Physical'){
    if (is_numeric($_POST['price'])){
    if ($_POST['physicalcopies'] < 0 ) {
        $errorMsg=" ";
        $errorMsg="Invalid Value for Physical Copies.Try again!";
        $success=false;
        $errorMessageArr[]=$errorMsg;
    }
}else{
    $errorMsg=" ";
    $errorMsg="Invalid Characters detected in Physical Copies. Try again!";
    $success=false;
    $errorMessageArr[]=$errorMsg;
}
    

 

    
    
} 


if (is_numeric($_POST['price'])){
    if ($_POST['price'] < 0 ) {
        $errorMsg=" ";
        $errorMsg="Invalid Value for Price.Try again!";
        $success=false;
        $errorMessageArr[]=$errorMsg;
    }
}else{
    $errorMsg=" ";
    $errorMsg="Invalid Characters detected in Price!";
    $success=false;
    $errorMessageArr[]=$errorMsg;
}
// validate file extension
if(isset($_POST["submit"])){ 
    if(!empty($_FILES["image"]["name"][0])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"][0]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        
         
        // Allow certain file formats 
        $allowTypes1 = array('jpg','png','jpeg','JPG','PNG','JPEG'); 
        if(in_array($fileType, $allowTypes1)){ 
            $image = $_FILES['image']['tmp_name'][0]; 
            var_dump($image);
            echo "<br>";
            $imgContent = (file_get_contents($image)); 
        
        }else{
                $errorMsg=" ";
                $errorMsg="Sorry, only JPG, JPEG & PNG files are allowed to uploaded. Try Again!";
                $success=false;
                $errorMessageArr[]=$errorMsg;
            
        }
            
        }
}
if(isset($_POST["submit"]) and ($_POST["exampleRadios"]) == 'Digital' ){ 
    if(!empty($_FILES["image"]["name"][1])) { 
        // Get file info 
        $fileName1 = basename($_FILES["image"]["name"][1]); 
        $fileType1 = pathinfo($fileName1, PATHINFO_EXTENSION);
        
         
        // Allow certain file formats 
        $allowTypes2 = array('pdf','PDF'); 
        if(in_array($fileType1, $allowTypes2)){ 
            $tmpName=$_FILES['image']['tmp_name'][1];
            $documentcontent= file_get_contents($tmpName);
        
        }else{
                $errorMsg=" ";
                $errorMsg="Sorry, please attach a valid PDF file. Try Again!";
                $success=false;
                $errorMessageArr[]=$errorMsg;
            
        }
            
        }
    else
    {
            $errorMsg=" ";
            $errorMsg="Sorry, Notes Type is Digital but no file has been attached. Try Again!";
            $success=false;
            $errorMessageArr[]=$errorMsg;
        
        
            
        }
}
            
if ($success == true){
    $modulelec=$_POST["modulecode"];
    if (in_array($modulelec, $year1)){
        $module_year='1';
        
    }
    $modulelen=$_POST["modulename"];
    $year_u=$_POST["yearupdated"];
    $type_n=$_POST["exampleRadios"];
    $student_id=$_SESSION["student_id"];
    if ($type_n =='Physical'){
        $type_n='P';
        $inventory_num=(int)($_POST["physicalcopies"]);
    }else{
        $type_n='D';
        $inventory_num= -1;
        
    }
    $description=$_POST["description"];
    $price=(float)($_POST["price"]);
    insertintodb();
    echo "<h5>Product created successfully.</h5>";
    returntoprofilepage();
    include "footer.php";
    
    //insertintodb();
    
}
else
{
    foreach($errorMessageArr as $msg)
    {
    echo "<h4>". $msg . "</h4>";
        
    }
    returntoproductpage();
    include "footer.php";
    
}
function returntoprofilepage(){
     echo "<button type='submit' class='returntoprofilepage'><a href='profile.php' style='text-decoration:none;color:black' >Click here to return to Profile page!</a></button><br>";
    
}
function returntoproductpage(){
        echo "<button type='submit' class='returnproductpage'><a href='createproduct.php' style='text-decoration:none;color:black' >Click here to return to Create New Product Listing Page!</a></button><br>";
}

function insertintodb()
{
    global $modulelec,$modulelen,$year_u,$type_n,$inventory_num,$description,$price,$image,$imgContent,$documentcontent,$student_id,$module_year;
                        
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
      {        // Prepare the statement: 
               $stmt = $conn->prepare("INSERT INTO product (module_code,module_name,updated_year,notestype,inventory_num,description,price,sample_image,seller_id,document,moduleyear) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");  
               // Bind & execute the query statement:        
               $stmt->bind_param("ssssisdbsbs",$modulelec,$modulelen,$year_u,$type_n,$inventory_num,$description,$price,$imgContent,$student_id,$documentcontent,$module_year); 
               $stmt->send_long_data(7, $imgContent);
               $stmt->send_long_data(9, $documentcontent);
               if (!$stmt->execute())        
               {            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;  
                            echo $errorMsg;
                            $success = false;        
               
               }        
               $stmt->close();      
      }
      $conn->close();
               
}
    

?>





