<!DOCTYPE html>
<head>
        <title>SIT Buddy</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--<!-- Bootstrap CSS -->
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/project.css"> 

        <!--Google Icons-->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <!--jQuery-->
        <script defer
                src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous">
        </script>

        <!--Bootstrap JS-->
        <script defer
                src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
                integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
                crossorigin="anonymous">
        </script>

        <!-- Custom JS -->

        <script defer src="Js/Popup.js"></script>
</head>
<body>
    <?php
    include "navbar.php";
    ?>

    <main class="container bg-dark text-white">
        <h1 style="text-align:center">Profile</h1>
        <?php
        // Create database connection.
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],
                $config['password'], $config['dbname']);
        /*Check whether have users in db. If have users, loop one after another, to 
         see whether each users have uploaded a profile img. Img upload status will be 
        shown in profileimg table. Will show default img or uploaded img based on status.*/
        $sql = "SELECT * FROM buddy_help_members";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $img_student_id = $row['student_id'];
                //$sqlimg = "SELECT * FROM profileimg WHERE student_id='$img_student_id";
                //$resultImg = mysqli_query($conn, $sqlImg);
                //while ($rowImg = mysqli_fetch_assoc($resultImg)) {
                if ($_SESSION["student_id"] == $img_student_id) {             
                    //echo "<div class='form-row'>";
                        echo "<div>";
                            if ($row['profile_img_upload'] == 1) {
                                $profileimg_base64 = $row['profile_base64'];
                                $profileimg = 'data:image/'.$fileActualExt.';base64,'.$profileimg_base64;
                                //echo "<img src='images/profile".$img_student_id.".jpg'>";
                                echo "<img src='$profileimg' alt='profileimg' height='180px' width='180px'>";
                                //echo var_dump($profileimg);
                            } else {
                                echo "<img src='images/profiledefault.jpg'>";
                            }
                        echo "</div>";
                    //echo "</div>";
                }
            }
        } else {
            echo "No users at the moment.";
        }
        
        if (isset($_SESSION["student_id"])) {
                //echo "<p>Welcome " . $_SESSION["fname"] . " " . $_SESSION["lname"] ."!</p>";
            }
        ?>
                
        <form action="profile_update.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">First Name:</label>
                    <input class="form-control" type="text" id="fname"
                           maxlength="45" name="fname" placeholder="Enter first name"
                           value="<?php
                               echo $_SESSION['fname'];
                           ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="lname">Last Name:</label>
                    <input class="form-control" type="text" id="lname"
                           required name="lname" placeholder="Enter last name"
                           value="<?php
                               echo $_SESSION['lname'];
                           ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="username">Display Name:</label>
                <input class="form-control" type="text" id="username"
                       name="username" placeholder="Username"
                       value="<?php
                               echo $_SESSION['username'];
                              ?>">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="email" id="email"
                       required name="email" placeholder="Enter email"
                       value="<?php
                               echo $_SESSION['email'];
                              ?>">
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="status">Student / Alumni:</label>
                    <input class="form-control" id="status" type="text" required name="status"
                            value="<?php
                               echo $_SESSION['status'];
                            ?>" readonly>
                    </select>
                </div>
                <div class="form-group col-md-8">
                    <label for="student_id">Student ID:</label>
                    <input class="form-control" type="text" id="student_id"
                           required name="student_id" placeholder="Enter student ID"
                          value="<?php
                               echo $_SESSION['student_id'];
                           ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input class="form-control" type="password" id="pwd"
                       name="pwd" placeholder="Enter password">
            </div>
            
            <div class='form-group'>
                        <label for='fileToUpload'>Upload your profile picture:</label><br>
                        <input type='file' name='file' id='file'>
                    </div> 
                    <div class='form-group'> 
                        <button class='btn btn-success col-12' id='update' name='update'
                                type='submit'>Update</button>
                    </div><br>
            <?php
            /*if (isset($_SESSION["student_id"])) {
                echo "<div class='form-group'>
                        <label for='fileToUpload'>Upload your profile picture:</label><br>
                        <input type='file' name='file' id='file'>
                    </div>
                    <div class='form-group'>
                        <button class='btn btn-success col-12' id='update' name='update'
                                type='submit'>Update</button>
                    </div><br>";
            }*/
        ?>
        </form>

    </main>
    <div>
        <h1>Listing:</h1>
        <a href="createproduct.php">
        <button class='btn btn-secondary' id='newProduct' name='newProduct'
                                type='submit' >+ NEW PRODUCT
        </button>
        </a>
        <button class='btn btn-secondary' id='newService' name='newProduct'
                                type='submit'>+ NEW SERVICE</button>
        <h1>Purchases:</h1>
    </div>

    <?php
    include "footer.php";
    ?>
</body>