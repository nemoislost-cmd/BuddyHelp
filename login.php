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
        <h1 style="text-align:center">Login</h1>
        <form action="login_process.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="email" id="email"
                       required name="email" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input class="form-control" type="password" id="pwd"
                       required name="pwd" placeholder="Enter your password">
            </div>
            <div class="form-group">
                <button class="btn btn-success col-12" id="submit" name="login"
                        type="submit">Login</button>
            </div>
        </form>
    </main>
    <?php
    include "footer.php";
    ?>
</body>


