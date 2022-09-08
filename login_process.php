<?php

$email = $pwd_hashed = $errorMsg = "";
$success = true;
if ($_SERVER["REQUEST_METHOD"] == "POST")   //if form submitted via post
{
    $email = sanitize_input($_POST["email"]); 
    authenticateUser();
}
else 
{
    echo "<h2>Please do not run this page directly.</h2>";
    echo "<p>Login with the link below:</p>";
    echo "<a href='login.php'>Login Page</a>";
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
 * Helper function to authenticate the login.
 */

function authenticateUser() {
    global $fname, $lname, $email, $student_id, $status, $pwd_hashed, $verified, $checkedPwd, $errorMsg, $success;
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
        $stmt = $conn->prepare("SELECT * FROM buddy_help_members WHERE email=?");
// Bind & execute the query statement:
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
// Email field is unique, so only one row
            $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $lname = $row["lname"];
            $email = $row["email"];
            $student_id = $row["student_id"];
            $status = $row["status"];
            $pwd_hashed = $row["password"];
            $verified = $row["verified"];
            /*$_SESSION["fname"] = $row["fname"];
            $_SESSION["lname"] = $row["lname"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["pwd"] = $row["password"];
            $fname = $_SESSION["fname"];
            $lname = $_SESSION["lname"];
            $email = $_SESSION["email"];
            $pwd_hashed = $_SESSION["pwd"];*/
            //$checkPwd = password_verify($_POST["pwd"], $pwd_hashed);
// Check if the password matches:
            if (password_verify($_POST["pwd"], $pwd_hashed)) {
                if ($verified === 0) {
                    $errorMsg = "Your student card is not valid!";
                    $success = false;
                }
                else if ($verified === NULL) {
                    $errorMsg = "Your account has not yet been verified.";
                    $success = false;
                }
                else if ($verified === 1) {
                    $success = true;
                    //header("location: ../index.php");
                }
                //$success = true;
            }
            else if (!password_verify($_POST["pwd"], $pwd_hashed)) {
                $errorMsg = "Email not found or password doesn't match...";
                $success = false;
            }
        } else {
            $errorMsg = "Email not found or password doesn't match...";
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<html>
    <head>
        <title>Login Status</title>
        <?php
        include "head.inc.php";
        ?>
    </head>
    <body class="bg-dark">
        <?php
        include "navbar.php";
        ?>
        <header class="jumbotron text-center">
            <h1 class="display-4">Login Status</h1>
        </header>
        
        <main class="container p-3 bg-dark text-white">
            <hr>
            <?php
            if ($success == true)
            {
                /*echo "<h2>Login Successful!</h2>";
                echo "<h3>Welcome back, " . $fname . " " . $lname . ".</h3>";
                echo "<a href='index.php' class='btn btn-success'>Return to Home</a>";
                echo "<p>$verified </p>";
                //echo var_dump($success) . "<br>";
                //echo var_dump($checkedPwd); */
                session_start();
                $_SESSION["student_id"] = $student_id;
                $_SESSION["email"] = $email;
                $_SESSION["status"] = $status;
                $_SESSION["fname"] = $fname;
                $_SESSION["lname"] = $lname;
                $_SESSION["pwd"] = $pwd_hashed;
                $_SESSION["loggedin"]=1;
                $_SESSION['products']=array();
                header("location: ../SitBuddyHelp/index.php");
                exit(); 
            }
            else
            {
                echo "<h1>:(</h1>";
                echo "<h2>Sorry</h2>";
                echo "<p>" . $errorMsg . "</p>";
                //echo var_dump($verified) . "<br>";
                echo "<a href='login.php' class='btn btn-danger'>Return to Login</a>";
            }
            ?>
        </main>
        <br>
        <?php
        include "footer.php";
        ?>
    </body>
</html>
