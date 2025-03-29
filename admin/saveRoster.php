<?php
    // Session start & Connect the MySql

      session_start();
      include('inc/creds.php');
try
      {
          $DBcon = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass); 
          $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e)
      {
          echo "ERROR : ".$e->getMessage();
      }
 // Initialize Variables
         $id="";
         $unit="";
         $menuId = "";
         $eventId = "";
         $scoutsAtt = "";
         $eventId = "";
         $grubmaster = "";
         $days ="";
         $SPL="";
         $ASPL="";
         $fireMarshal="";
         $Qmaster ="";
         $dutyId = '';
          $day ='';
          $meal ='';
          $headCook ='';
          $asstCook ='';
          $leadKP ='';
          $kp ='';
          $trash ='';
          $water='';
          $menuItem='';

         // POST Add new data
         if (isset($_POST['save'])) {
             $unit = $_POST['unit'];
            $eventId = $_POST['eventId'];
            $menuId = $_POST['menuId'];
            $grubmaster = $_POST['grubmaster'];
             $days =$_POST['total_days'];
             $SPL=$_POST['SPL'];
             $ASPL=$_POST['ASPL'];
             $fireMarshal=$_POST['fireMarshal'];
             $Qmaster =$_POST['Qmaster'];
             $scoutsAtt = $_POST['scoutsAtt'];
             mysqli_query($db, "INSERT INTO `qbranch_duty` (`unit`,`eventId`,`menuId`,`days`,`grubmaster`,`SPL`,`ASPL`,`fireMarshal`,`scoutsAtt`,`Qmaster`) VALUES ('$unit','$eventId','$menuId','$days','$grubmaster','$SPL','$ASPL','$fireMarshal','$scoutsAtt','$Qmaster')");
           
          
           
           header("location: /planner/".$unit."/edit/".$eventId);
                    
         } else if (isset($_POST['update'])) {  
            $id= $_POST['dutyId'];
            $unit = $_POST['unit'];
            $eventId = $_POST['eventId'];
            $menuId = $_POST['menuId'];
            $grubmaster = $_POST['grubmaster'];
             $days =$_POST['total_days'];
             $SPL=$_POST['SPL'];
             $ASPL=$_POST['ASPL'];
             $fireMarshal=$_POST['fireMarshal'];
             $Qmaster =$_POST['Qmaster'];
             $scoutsAtt = $_POST['scoutsAtt'];
                  mysqli_query($db, "update`qbranch_duty` SET scoutsAtt = '$scoutsAtt', menuId = '$menuId',unit = '$unit', eventId = '$eventId', grubmaster = '$grubmaster', SPL = '$SPL', ASPL = '$ASPL', Qmaster ='$Qmaster', fireMarshal ='$fireMarshal', days = '$days' where id = '".$id."' ");
              
           //okay, this is a bit much
           
           if(isset($_POST['headCook_b'])){
               if(isset($_POST['rowId_b'])){
                     $id = $_POST['rowId_b'];
                 } else {
                    
                        $stmtI = $DBcon->prepare("select * from qbranch_rosterdetail where dutyId = '".$_POST['dutyId']."' AND day= '0' and meal = 'Breakfast'");
                            $stmtI->execute();
                           
                            if($stmtI->rowCount() > 0)
                            {
                             while($rowI=$stmtI->FETCH(PDO::FETCH_ASSOC))
                             {$id = $rowI['id'];
                         }} else {
                     
                     $id = 0;
                 }
                 }
             $dutyId = $_POST['dutyId'];
             $day = '0';
             $meal = 'Breakfast';
             $headCook = $_POST['headCook_b'];
             $asstCook = $_POST['asstCook_b'];
             $leadKP = $_POST['leadKp_b'];
             $kp = $_POST['kp_b'];
             $trash = $_POST['trash_b'];
             $water= $_POST['water_b'];
             $menuItem= '';
             
            if($id == 0){
                   mysqli_query($db, "INSERT INTO `qbranch_rosterdetail` (`dutyId`,`day`,`meal`,`headCook`,`asstCook`,`leadKP`,`kp`,`water`,`trash`,`menuItem`) VALUES ( '$dutyId','$day','$meal','$headCook ','$asstCook','$leadKP','$kp','$trash','$water','$menuItem')");
               } else {
                  mysqli_query($db, "update `qbranch_rosterdetail` SET dutyId = '$dutyId', day = '$day',meal = '$meal', headCook = '$headCook', asstCook = '$asstCook', leadKP = '$leadKP', kp = '$kp', trash ='$trash', water ='$water', menuItem = '$menuItem' where id = '".$id."' "); 
               }            
           }
           if(isset($_POST['headCook_l'])){
               if(isset($_POST['rowId_l'])){
                     $id = $_POST['rowId_l'];
                 } else {
                     $id = 0;
                 }
                $dutyId = $_POST['dutyId'];
                $day = '0';
                $meal = 'Lunch';
                $headCook = $_POST['headCook_l'];
                $asstCook = $_POST['asstCook_l'];
                $leadKP = $_POST['leadKp_l'];
                $kp = $_POST['kp_l'];
                $trash = $_POST['trash_l'];
                $water= $_POST['water_l'];
                $menuItem= '';
                
             if($id == 0){
                    mysqli_query($db, "INSERT INTO `qbranch_rosterdetail` (`dutyId`,`day`,`meal`,`headCook`,`asstCook`,`leadKP`,`kp`,`water`,`trash`,`menuItem`) VALUES ( '$dutyId','$day','$meal','$headCook ','$asstCook','$leadKP','$kp','$trash','$water','$menuItem')");
                } else {
                   mysqli_query($db, "update `qbranch_rosterdetail` SET dutyId = '$dutyId', day = '$day',meal = '$meal', headCook = '$headCook', asstCook = '$asstCook', leadKP = '$leadKP', kp = '$kp', trash ='$trash', water ='$water', menuItem = '$menuItem' where id = '".$id."' "); 
                }             
              }
              if(isset($_POST['headCook_d'])){
                  if(isset($_POST['rowId_d'])){
                        $id = $_POST['rowId_d'];
                    } else {
                        $id = 0;
                    }
                   $dutyId = $_POST['dutyId'];
                   $day = '0';
                   $meal = 'Dinner';
                   $headCook = $_POST['headCook_d'];
                   $asstCook = $_POST['asstCook_d'];
                   $leadKP = $_POST['leadKp_d'];
                   $kp = $_POST['kp_d'];
                   $trash = $_POST['trash_d'];
                   $water= $_POST['water_d'];
                   $menuItem= '';
                   
                 if($id == 0){
                        mysqli_query($db, "INSERT INTO `qbranch_rosterdetail` (`dutyId`,`day`,`meal`,`headCook`,`asstCook`,`leadKP`,`kp`,`water`,`trash`,`menuItem`) VALUES ( '$dutyId','$day','$meal','$headCook ','$asstCook','$leadKP','$kp','$trash','$water','$menuItem')");
                    } else {
                       mysqli_query($db, "update `qbranch_rosterdetail` SET dutyId = '$dutyId', day = '$day',meal = '$meal', headCook = '$headCook', asstCook = '$asstCook', leadKP = '$leadKP', kp = '$kp', trash ='$trash', water ='$water', menuItem = '$menuItem' where id = '".$id."' "); 
                    }            
                 }
              if ($_POST['total_days'] > 0){
                  $i = 1;
                  while ($i <= $_POST['total_days']) {
                  if(isset($_POST['headCook_b'.$i])){
                      if(isset($_POST['rowId_b'.$i])){
                          $id = $_POST['rowId_b'.$i];
                      } else {
                          
                              $stmtI = $DBcon->prepare("select * from qbranch_rosterdetail where dutyId = '".$_POST['dutyId']."' AND day= '".$i."' and meal = 'Breakfast'");
                                  $stmtI->execute();
                                 
                                  if($stmtI->rowCount() > 0)
                                  {
                                   while($rowI=$stmtI->FETCH(PDO::FETCH_ASSOC))
                                   {$id = $rowI['id'];
                               }} else {
                           
                           $id = 0;
                       }
                       }
                       $dutyId = $_POST['dutyId'];
                       $day = $i;
                       $meal = 'Breakfast';
                       $headCook = $_POST['headCook_b'.$i];
                       $asstCook = $_POST['asstCook_b'.$i];
                       $leadKP = $_POST['leadKp_b'.$i];
                       $kp = $_POST['kp_b'.$i];
                       $trash = $_POST['trash_b'.$i];
                       $water= $_POST['water_b'.$i];
                       $menuItem= '';
                       
                       if($id == 0){
                       mysqli_query($db, "INSERT INTO `qbranch_rosterdetail` (`dutyId`,`day`,`meal`,`headCook`,`asstCook`,`leadKP`,`kp`,`water`,`trash`,`menuItem`) VALUES ( '$dutyId','$day','$meal','$headCook ','$asstCook','$leadKP','$kp','$trash','$water','$menuItem')");
                   } else {
                      mysqli_query($db, "update `qbranch_rosterdetail` SET dutyId = '$dutyId', day = '$day',meal = '$meal', headCook = '$headCook', asstCook = '$asstCook', leadKP = '$leadKP', kp = '$kp', trash ='$trash', water ='$water', menuItem = '$menuItem' where id = '".$id."' "); 
                   }
                                   
                     }
                     if(isset($_POST['headCook_l'.$i])){
                         if(isset($_POST['rowId_l'.$i])){
                               $id = $_POST['rowId_l'.$i];
                           } else {
                                 
                                     $stmtI = $DBcon->prepare("select * from qbranch_rosterdetail where dutyId = '".$_POST['dutyId']."' AND day= '".$i."' and meal = 'Lunch'");
                                         $stmtI->execute();
                                        
                                         if($stmtI->rowCount() > 0)
                                         {
                                          while($rowI=$stmtI->FETCH(PDO::FETCH_ASSOC))
                                          {$id = $rowI['id'];
                                      }} else {
                                  
                                  $id = 0;
                              }
                              }
                          $dutyId = $_POST['dutyId'];
                          $day = $i;
                          $meal = 'Lunch';
                          $headCook = $_POST['headCook_l'.$i];
                          $asstCook = $_POST['asstCook_l'.$i];
                          $leadKP = $_POST['leadKp_l'.$i];
                          $kp = $_POST['kp_l'.$i];
                          $trash = $_POST['trash_l'.$i];
                          $water= $_POST['water_l'.$i];
                          $menuItem= '';
                          
                        if($id == 0){
                               mysqli_query($db, "INSERT INTO `qbranch_rosterdetail` (`dutyId`,`day`,`meal`,`headCook`,`asstCook`,`leadKP`,`kp`,`water`,`trash`,`menuItem`) VALUES ( '$dutyId','$day','$meal','$headCook ','$asstCook','$leadKP','$kp','$trash','$water','$menuItem')");
                           } else {
                              mysqli_query($db, "update `qbranch_rosterdetail` SET dutyId = '$dutyId', day = '$day',meal = '$meal', headCook = '$headCook', asstCook = '$asstCook', leadKP = '$leadKP', kp = '$kp', trash ='$trash', water ='$water', menuItem = '$menuItem' where id = '".$id."' "); 
                           }             
                        }
                        if(isset($_POST['headCook_d'.$i])){
                            if(isset($_POST['rowId_d'.$i])){
                                  $id = $_POST['rowId_d'.$i];
                              }  else {
                                    
                                        $stmtI = $DBcon->prepare("select * from qbranch_rosterdetail where dutyId = '".$_POST['dutyId']."' AND day= '".$i."' and meal = 'Dinner'");
                                            $stmtI->execute();
                                           
                                            if($stmtI->rowCount() > 0)
                                            {
                                             while($rowI=$stmtI->FETCH(PDO::FETCH_ASSOC))
                                             {$id = $rowI['id'];
                                         }} else {
                                     
                                     $id = 0;
                                 }
                                 }
                             $dutyId = $_POST['dutyId'];
                             $day = $i;
                             $meal = 'Dinner';
                             $headCook = $_POST['headCook_d'.$i];
                             $asstCook = $_POST['asstCook_d'.$i];
                             $leadKP = $_POST['leadKp_d'.$i];
                             $kp = $_POST['kp_d'.$i];
                             $trash = $_POST['trash_d'.$i];
                             $water= $_POST['water_d'.$i];
                             $menuItem= '';
                             
                          if($id == 0){
                                 mysqli_query($db, "INSERT INTO `qbranch_rosterdetail` (`dutyId`,`day`,`meal`,`headCook`,`asstCook`,`leadKP`,`kp`,`water`,`trash`,`menuItem`) VALUES ( '$dutyId','$day','$meal','$headCook ','$asstCook','$leadKP','$kp','$trash','$water','$menuItem')");
                             } else {
                                mysqli_query($db, "update `qbranch_rosterdetail` SET dutyId = '$dutyId', day = '$day',meal = '$meal', headCook = '$headCook', asstCook = '$asstCook', leadKP = '$leadKP', kp = '$kp', trash ='$trash', water ='$water', menuItem = '$menuItem' where id = '".$id."' "); 
                             }             
                           }
                           $i++;
                             }
                  
              }
               
                header("location: /planner/".$unit);
         } else {
             print('i have no idea');
         }
?>