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
        ?>
        <form action ="process_create.php" method="post" enctype="multipart/form-data">
            <br>
        <div class="container">
            <p>Create New Product Listing</p>
            <div class="form-group">
                <label for ="modulecode">Enter Module Code </label>
                <input type ="text" class="form-control" id="modulecode" placeholder="1001" required name="modulecode">       
            </div>
            
            <div class="form-group">
                <label for ="modulename">Enter Module Name </label>
                <input type ="text" class="form-control" id="modulename" placeholder="Introduction to ICT" required name="modulename">       
            </div>
            
            <div class="form-group">
                <label for ="modulename">Year of Last Updation</label>
                <input type ="text" class="form-control" id="yearupdated" placeholder="2020" required name="yearupdated">       
            </div>
            <div class ="form-group">
            <label for ="typeofnotes">Type of Notes</label>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Physical" checked>
                 <label class="form-check-label" for="exampleRadios1">
                    Physical
                 </label>
             </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Digital">
                <label class="form-check-label" for="exampleRadios2">
                  Digital
               </label>
              </div>
              <div class="form-group col-md-6">
                  <label for="inventory">If Physical, number of copies for sale?</label>
                  <input type="text" class="form-control" id="physicalcopies" placeholder="3" name="physicalcopies">
             </div>
            </div>
            
            <div class="form-group">
                <label for ="description">Enter Short Description</label>
                <input type ="text" class="form-control" id="description" required name="description"> 
            </div>
            <div class="form-group">
                <label for ="price">Price of Notes(SGD)</label>
                <p>S$<input type ="text" class="form-control" id="price" required name="price"></P> 
            </div>
            <div class="form-group">
               <label for="sampleimage">Sample Image/Screenshot of Notes</label>
               <br>
                <input type="file" class="form-control-file" id="sampleimage" required name="image[]">
            </div>
            <br>
            
            <div class="form-group">
               <label for="digitalnotes">If Digital Notes, attach the full PDF document </label>
               <br>
                <input type="file" class="form-control-file" id="digitalnotes"  name="image[]">
                <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
            </div>
            <br>
            
            
            
            
            
            
         <button type="submit" name="submit" class="btn btn-primary">Submit</button>           
        </div>
            <br>

        </form>
        
        <?php
        include "footer.php";
        ?>
    </body>

        
        
       
