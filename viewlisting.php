<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
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
        var_dump($_SESSION['student_id']);
        ?>
        
        <div class="table-responsive-md">
        <table class="table table-borderless">
            <thread>
                <tr>
                    <th scope="col">Product Image</th>
                    <th scope="col">Details</th>
                </tr>