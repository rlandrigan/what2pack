<?php
    // Session start & Connect the MySql

      session_start();
  include('inc/creds.php');

 // Initialize Variables
         $name = "";
         $labelId = "";
         $description = "";
         $notes = "";
         $unit ="";
         $label="";
         $type="";
         $container="";

         // POST Add new data
         if (isset($_POST['Save'])) {
             $name = $_POST['name'];
             $labelId = $_POST['labelId'];
             $description = $_POST['description'];
             $notes = $_POST['notes'];
             $type = $_POST['type'];
             $container = $_POST['container'];
             $unit = $_POST['unit'];
             $label = $_POST['status'];
             mysqli_query($db, "INSERT INTO `qbranch_inventory` (`name`, `labelId`,`description`, `notes`, `type`, `container`, `unit`, `status`) VALUES ('$name','$labelId','$description','$notes','$type','$container','$unit','$label')");
           
             header("location: ../item/".$labelId);
         } else {
             print('i have no idea');
         }
?>