<?php
    // Session start & Connect the MySql
session_start();

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/akela/PHPMailer/src/Exception.php';
require '/home/akela/PHPMailer/src/PHPMailer.php';
require '/home/akela/PHPMailer/src/SMTP.php';


include('inc/creds.php');

 // Initialize Variables
         $name = "";
         $unit = "";
         $description = "";
         $locationId = "";
         $locationName ="";
         $budget="";
         $dateStart="";
         $dateEnd="";
         $Hospital="";
         $paymentLink="";
         $youth="";
         $youthDetails = "";

         // POST Add new data
         if (isset($_POST['save'])) {
             $name = addslashes($_POST['name']);
             $unit = $_POST['unit'];
             $description = addslashes($_POST['description']);
             $locationId = $_POST['locationId'];
             $locationName = $_POST['locationName'];
             $budget = $_POST['budget'];
             $dateStart = $_POST['dateStart'];
             $dateEnd = $_POST['dateEnd'];
             $Hospital = $_POST['nearestHostpital'];
             $paymentLink = $_POST['paymentLink'];
             mysqli_query($db, "INSERT INTO `qbranch_event` (`name`, `unit`,`description`, `locationId`, `locationName`, `budget`, `dateStart`, `dateEnd`, `nearestHostpital`,`paymentLink`) VALUES ('$name','$unit','$description','$locationId','$locationName','$budget','$dateStart','$dateEnd','$Hospital','$paymentLink')");
           
           $eventID = mysqli_insert_id($db);
           
           $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
           try {
               //Server settings
               $mail->SMTPDebug = 0;                                 // Enable verbose debug output
               $mail->isSMTP();                                      // Set mailer to use SMTP
               $mail->Host = 'smtp.dreamhost.com';                  // Specify main and backup SMTP servers
               $mail->SMTPAuth = true;                               // Enable SMTP authentication
               $mail->Username = 'skynet@where2camp.com';             // SMTP username
               $mail->Password = 'puppyCute201!';                           // SMTP password
               $mail->SMTPSecure = 'tls';                            
               $mail->Port = 587;                                    // TCP port to connect to
           
               //Recipients
               if($unit == '2'){
               $mail->setFrom('skynet@where2camp.com', 'What2Pack Rogue AI');          //This is the email your form sends From
               $mail->addAddress('ral@eclectek.com', 'Beloved Admin'); // Add a recipient address
               $mail->addAddress('maddie.williams79@gmail.com');               // Name is optional
               $mail->addAddress('troutqueen@gmail.com');               // Name is optional
               $mail->addReplyTo('info@escouts13.org', 'Information');
           } else {
               $mail->setFrom('skynet@where2camp.com', 'What2Pack Rogue AI');          //This is the email your form sends From
                  $mail->addAddress('ral@eclectek.com', 'Beloved Admin'); // Add a recipient address
                  $mail->addAddress('davebsn@gmail.com');               // Name is optional
                  $mail->addAddress('jusgillis@gmail.com');               // Name is optional
                  $mail->addReplyTo('info@escouts13.org', 'Information');
           }
               //$mail->addCC('cc@example.com');
               //$mail->addBCC('bcc@example.com');
           
               //Attachments
               //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
               //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
           
               //Content
               $mail->isHTML(true);                                  // Set email format to HTML
               $mail->Subject = $name.' Campout added to What2Pack.org!';
               $mail->Body    = 'A new campout, '.$name.', starting on '.$dateStart.' at '.$locationName.' has been created at https://what2pack.org/planner/'.$unit.'. Decription is : '.$description;
               //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
           
               $mail->send();
               header("location: /planner/".$unit."/edit/".$eventID);
               echo 'Message has been sent';
           } catch (Exception $e) {
               echo 'Message could not be sent.';
               echo 'Mailer Error: ' . $mail->ErrorInfo;
           }

           
           
           header("location: /planner/".$unit."/edit/".$eventID);
         } else if (isset($_POST['edit'])) {  
             $id = $_POST['id'];
          $name = addslashes($_POST['name']);
           $unit = $_POST['unit'];
           $description = addslashes($_POST['description']);
           $locationId = $_POST['locationId'];
           $locationName = $_POST['locationName'];
           $budget = $_POST['budget'];
           $dateStart = $_POST['dateStart'];
           $dateEnd = $_POST['dateEnd'];
           $Hospital = $_POST['nearestHostpital'];
           $paymentLink = $_POST['paymentLink'];
           $youth = $_POST['youth'];
           $youthDetails = $_POST['camperDetails'];
                   mysqli_query($db, "update`qbranch_event` SET name = '$name', unit = '$unit',description = '$description', locationId = '$locationId', locationName = '$locationName', budget = '$budget', dateStart = '$dateStart', dateEnd ='$dateEnd', youth = '$youth', youthDetails = '$youthDetails', paymentLink = '$paymentLink', nearestHostpital ='$Hospital' where id = '".$id."' ");
                 
           
                 
                 header("location: /planner/".$unit);
          } else {
             print('i have no idea');
         }
?>