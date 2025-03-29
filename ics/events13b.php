<?php
// Database connection settings
include('inc/creds.php');
try {
		$pdo = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass); 
		 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die("Database connection failed: " . $e->getMessage());
}

// Fetch events from the database
$query = "SELECT * FROM qbranch_event WHERE unit = '3' ORDER BY dateStart ASC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Start ICS output
//header('Content-Type: text/calendar; charset=utf-8');
//header('Content-Disposition: inline; filename="calendar.ics"');

echo "BEGIN:VCALENDAR\r\n";
echo "VERSION:2.0\r\n";
echo "PRODID:-//YourCompany//Event Feed//EN\r\n";
echo "CALSCALE:GREGORIAN\r\n";
echo "METHOD:PUBLISH\r\n";

foreach ($events as $event) {
	$start = date("Ymd\THis", strtotime($event['dateStart'].' 17:30:00'));
	$end = date("Ymd\THis", strtotime($event['dateEnd'].' 12:00:00'));
	$uid = uniqid() . "@where2pack.com";

	echo "BEGIN:VEVENT\r\n";
	echo "UID:$uid\r\n";
	echo "DTSTAMP:" . gmdate("Ymd\THis\Z") . "\r\n";
	echo "DTSTART:$start\r\n";
	echo "DTEND:$end\r\n";
	echo "SUMMARY:" . addslashes($event['name']) . "\r\n";
	echo "URL:" . addslashes("https://what2pack.org/planner/3#".$event['id']). "\r\n";
	echo "DESCRIPTION:" . addslashes($event['description']) . "\r\n";
	echo "LOCATION:" . addslashes("https://where2camp.com/review/?from=list&camp=".$event['locationId']) . "\r\n";
	echo "END:VEVENT\r\n";
}

echo "END:VCALENDAR\r\n";
?>