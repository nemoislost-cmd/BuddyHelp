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
        <link rel="stylesheet" href="css/project.css"> 
        
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
<body height: 100%;>
    <?php
    include "navbar.php";
    ?>

    <main>
        <h1 style="text-align:center">Register</h1>
        <form action="register_process.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">First Name:</label>
                    <input class="form-control" type="text" id="fname"
                           maxlength="45" name="fname" placeholder="Enter first name">
                </div>
                <div class="form-group col-md-6">
                    <label for="lname">Last Name:</label>
                    <input class="form-control" type="text" id="lname"
                           required name="lname" placeholder="Enter last name">
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="email" id="email"
                       required name="email" placeholder="Enter email">
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="status">Student / Alumni:</label>
                    <select class="form-control" id="status" type="text" required name="status">
                           <option value="Student">Student</option>
                           <option value="Alumni">Alumni</option>
                    </select>
                </div>
                <div class="form-group col-md-8">
                    <label for="student_id">Student ID:</label>
                    <input class="form-control" type="text" id="student_id"
                       required name="student_id" placeholder="Enter student ID">
                </div>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input class="form-control" type="password" id="pwd"
                       required name="pwd" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label for="pwd_confirm">Confirm Password:</label>
                <input class="form-control" type="password" id="pwd_confirm"
                       required name="pwd_confirm" placeholder="Confirm password">
            </div>
            <div class="form-group">
                <label for="fileToUpload">Upload an image of your student card:</label><br>
                <input type="file" name="file" id="file">
            </div>
            <div class="form-group">
                <input class="btn col-12" id="submit" name="submit"
                        type="submit">
            </div>
        </form>
    </main>
    <?php
    include "footer.php";
    ?>
</body>


