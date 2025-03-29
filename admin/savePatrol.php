<?php
    // Session start & Connect the MySql

      session_start();
   include('inc/creds.php');

 // Initialize Variables
         $id="";
         $patrolId = "";
         $unit = "";
         $event = "";
         $grubmaster = "";
         $costPerBudget ="";
         $CostPerReal="";
         $expenses="";
         $patrolName="";
         $purchasedItems ="";

         // POST Add new data
         if (isset($_POST['save'])) {
            $patrolId = $_POST['patrolId'];
            $unit = $_POST['unit'];
            $event = $_POST['event'];
            $grubmaster = $_POST['grubmaster'];
            $costPerBudget =$_POST['costPerBudget'];
            $purchasedItems =$_POST['purchasedItems'];
             mysqli_query($db, "INSERT INTO `qbranch_menu` (`patrolId`,`unit`, `event`, `grubmaster`, `costPerBudget`, `purchasedItems`) VALUES ('$patrolId','$unit','$event','$grubmaster','$costPerBudget', '$purchasedItems')");
           
           $patrolID = $event;
           
           header("location: /planner/".$unit."/edit/".$patrolID);
                    
         } else if (isset($_POST['update'])) {  
             $id = $_POST['id'];
             $patrolId = $_POST['patrolId'];
                 $unit = $_POST['unit'];
                 $event = $_POST['event'];
                 $grubmaster = $_POST['grubmaster'];
                 $expenses= $_POST['expenses'];
                 $costPerBudget =$_POST['costPerBudget'];
                 $menulist =$_POST['menulist'];
                 $patrolName=$_POST['patrolName'];
                 $purchasedItems=$_POST['purchasedItems'];
                  mysqli_query($db, "update`qbranch_menu` SET patrol = '$patrolName', patrolId = '$patrolId',unit = '$unit', event = '$event', grubmaster = '$grubmaster', expenses = '$expenses',costPerBudget = '$costPerBudget', menulist ='$menulist', purchasedItems ='$purchasedItems' where id = '".$id."' ");
                
                $patrolID = $event;
                
                header("location: /planner/".$unit."/roster/".$id);
         } else {
             print('i have no idea');
         }
?>