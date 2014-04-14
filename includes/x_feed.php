<?php
// Configuration
$dbhost = 'localhost';
$dbname = 'scheduler';

// Connect to test database
$m = new Mongo("mongodb://$dbhost");
$db = $m->$dbname;

// Get the users collection
$regular = $db->regular;

date_default_timezone_set('Asia/Calcutta');
$sch = $regular->findOne();
$dateToday = getdate();
$dayToday = $dateToday['wday'];

//var_dump($sch);
$eventSource = array();
foreach ($sch as $key => $value) {
	if($key != '_id')
	{
	/*var_dump($value);
	echo '<br>';*/
	foreach ($value as $course => $slot) {
		//$start = $slot.explode('-')[0];
		//$end = $slot.explode('-')[1];
		/*var_dump($key);
		echo '--';
		var_dump($course);
		echo '-----';
		echo $slot;
		echo '<br>';*/
		
		$slot = intval($slot);
		//echo $slot."<br>";
		$eventDate = date("d")-( $dayToday-date('N', strtotime($key)) );
		//echo $eventDate."<br>";
		$startDate = mktime($slot, 0, 0, date("m")  ,$eventDate , date("Y"));
		$startDate = date("Y-m-d\TH:i:sO",$startDate);
		//echo $startDate."<br>";
		$endDate = mktime($slot+1, 0, 0, date("m")  ,$eventDate , date("Y"));
		$endDate = date("Y-m-d\TH:i:sO",$endDate);
		//echo "startDate: ".$startDate."<br>"."endDate: ".$endDate."<br><br>";
		$eventSource[] = array(
			'title' => $course,
			'start' => $startDate,
			'end' => $endDate,
			'allDay' => false
		);
	}
	}
}
//var_dump($eventSource);
//$eventSource = json_encode($eventSource);
//print_r($eventSource);
echo json_encode($eventSource);
?>