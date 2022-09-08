<?php

$fname = $lname = $email = $status = $student_id = $pwd_hashed = $errorMsg = $fileNameNew = $profileimage = $result = "";
$success = true;
if ($_SERVER["REQUEST_METHOD"] == "POST")   //if form submitted via post
//if(isset($_POST["submit"]))
{
    
    //first name
    if (!empty($_POST["fname"])) 
    {
        $fname = sanitize_input($_POST["fname"]);
    } 
    //last name
    if (empty($_POST["lname"])) 
    {
        $errorMsg .= "Last name is required.<br>";
        $success = false;
    } 
    else
    {
        $lname = sanitize_input($_POST["lname"]);
    }
    //display name
    if (!empty($_POST["username"])) 
    {
        $username = sanitize_input($_POST["username"]);
    } 
    //email
    if (empty($_POST["email"])) 
    {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } 
    else 
    {
        $email = sanitize_input($_POST["email"]);
    // Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $errorMsg .= "Invalid email format.<br>";
            $success = false;
        }
    }
    //status - student / alumni
    if (empty($_POST["status"])) 
    {
        $errorMsg .= "Status is required.<br>";
        $success = false;
    }
    else
    {
        $status = sanitize_input($_POST["status"]);
    }
    //student ID
    if (empty($_POST["student_id"])) 
    {
        $errorMsg .= "Student_ID is required.<br>";
        $success = false;
    } 
    else
    {
        $student_id = sanitize_input($_POST["student_id"]);
    }
    /*//password
    if (empty($_POST["pwd"]) || empty($_POST["pwd_confirm"]))
    {
        $errorMsg .= "Password is required.<br>";
        $success = false;
    }
    else
    {
        //make sure pw matched
        if ($_POST["pwd"] != $_POST["pwd_confirm"])
        {
            $errorMsg .= "Passwords do not match.<br>";
            $success = false;
        }
        else
        {
            //hash pw
            $pwd_hashed = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        } 
    }*/
    /*
    //upload image checks
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
     */

    /*
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);    // get 2 data - filename and extension
    $fileActualExt = strtolower(end($fileExt));    //make extension lowercase

    $allowed = array('jpg', 'jpeg', 'png');   //allow 3 types of img file

    if(in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 500000) {      // if file size < 500000kb = 500mb
                //$fileNameNew = uniqid('', true). "." . $fileActualExt;    //unique number - its current time in ms
                $profileNameNew = $student_id. ".profile" . $fileActualExt;
                $fileDestination = "uploads/" . $profileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                
                // Create database connection.
                $config = parse_ini_file('../../private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'],
                        $config['password'], $config['dbname']);
                // Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
                    // Prepare the statement:
                    $id = $_SESSION['student_id'];
                    $sql = "UPDATE buddy_help_members SET profile_img_upload=1 WHERE student_id='$id';";
                    // Bind & execute the query statement:
                    $result = mysqli_query($conn, $sql);
                    $success = true;
                }
                $conn->close(); 
            }       
        }    
    }
                //convert to base64
                //$image_base64 = base64_encode(file_get_contents("uploads/" . $profileNameNew));
                //$image = 'data:image/'.$fileActualExt.';base64,'.$image_base64;
                /* $profileimage_content = (file_get_contents("uploads/" . $profileNameNew));
                //$errorMsg .= "$fileTmpName" . " " . "$fileDestination" . " " . "$image";
            } else {
                //echo "Your file is too large.";
                $errorMsg .= "Your file is too large.<br>";
                $success = false;
            }
        } else {
            //echo "There was an error uploading your file.";
            $errorMsg .= "There was an error uploading your file.<br>";
            $success = false;
        }
    } else {
        //echo "Only JPG, JPEG or PNG files are allowed.<br>";
        $errorMsg .= "Only JPG, JPEG or PNG files are allowed.<br>";
        $success = false;
    }  */

        /*$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $success = true;
        } else {
            $errorMsg .= "File is not an image.<br>";
            $success = false;
        }
    }
*/
}
else 
{
    echo "<h2>Please do not run this page directly.</h2>";
    echo "<p>Register with the link below:</p>";
    echo "<a href='register.php'>Register Page</a>";
    exit();
}
        
//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/*
 * Helper function to write the member data to the DB
 */

function saveProfileToDB() {
    global $student_id, $profileNameNew, $errorMsg, $success, $result, $profileimage, $profileimage_base64;
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);    // get 2 data - filename and extension
    $fileActualExt = strtolower(end($fileExt));    //make extension lowercase

    $allowed = array('jpg', 'jpeg', 'png');   //allow 3 types of img file

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 500000) {      // if file size < 500000kb = 500mb
                //$fileNameNew = uniqid('', true). "." . $fileActualExt;    //unique number - its current time in ms
                
                $profileNameNew = $student_id . "_profile." . $fileActualExt;
                $fileDestination = "uploads/" . $profileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $profileimage_base64 = base64_encode(file_get_contents("uploads/" . $profileNameNew));
                $profileimage = 'data:image/'.$fileActualExt.';base64,'.$profileimage_base64;
                // Create database connection.
                $config = parse_ini_file('../../private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'],
                        $config['password'], $config['dbname']);
                // Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
                    // Prepare the statement:
                    $id = $_SESSION['student_id'];
                    $sql = "UPDATE buddy_help_members SET profile_img_upload=1, profile_base64='$profileimage_base64' WHERE student_id='$id';";
                    // Bind & execute the query statement:
                    mysqli_query($conn, $sql);
                    $success = true;
                }
                $conn->close();
            }
        }
    }
}

function updateDB() {
    global $username, $email, $errorMsg, $success, $sql;
    // Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement:
        /*$id = $_SESSION['student_id'];
        $sql = "UPDATE buddy_help_members SET username='$username', email='$email' WHERE student_id='$id';";
        // Bind & execute the query statement:
        $query_run = mysqli_query($conn, $sql);
        $success = true;*/
        
        /*$stmt = $conn->prepare("UPDATE buddy_help_members SET (username, email) VALUES (?, ?)");
        // Bind & execute the query statement:
        $stmt->bind_param("ss", $username, $email);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close(); */
        $id = $_SESSION["student_id"];
        $sql = "UPDATE buddy_help_members SET username='$username', email='$email' WHERE student_id='$id';";
        mysqli_query($conn, $sql);
        $success = true; 
    }
    $conn->close();
}
?>


<html>
    <head>
        <title>Registration Status</title>
        <?php
        include "head.inc.php";
        ?>
    </head>
    <body class="bg-dark">
        <?php
        include "navbar.php";
        ?>
        <header class="jumbotron text-center">
            <h1 class="display-4">Registration Status</h1>
        </header>
        
        <main class="container p-3 bg-dark text-white">
            <hr>
            <?php
                    updateDB();
                    saveProfileToDB();
            if ($success)
            {
                /*echo "<h2>Registration completed!</h2>";
                echo "<h3>Welcome aboard, " . $fname . " " . $lname . ".</h3>";
                echo "<a href='login.php' class='btn btn-success'>Login</a>";
                //echo "<p>" . $errorMsg . "</p>";*/
                //echo "<h3>Welcome aboard, " . $fname . " " . $lname . ".</h3>";
                //echo var_dump($id)."<br>";
                //echo var_dump($sql)."<br>";
                //echo var_dump($profileimage_base64);
                //echo "<img src='$profileimage'>";
                echo "<script type='text/javascript'> alert('Data updated. Please login again.') </script>";
                echo "<script>document.location = '../ICT1004_Project/login.php'</script>";
            }
            else
            { 
                echo "<h1>:(</h1>";
                echo "<h2>Sorry</h2>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<script type='text/javascript'> alert('Data not updated') </script>";
                echo "<a href='register.php' class='btn btn-danger'>Register</a>";
                echo var_dump($success). "<br>";
                echo var_dump($id). "<br>";
            } 
            ?>
        </main>
        <br>
        <?php
        include "footer.php";
        ?>
    </body>
</html>