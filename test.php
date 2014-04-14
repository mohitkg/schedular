<?php  
// Config  
//$dbhost = 'localhost';  "mongodb://$dbhost"


$dbname = 'test';  
// Connect to test database  
$conn = new MongoClient();  
$db = $conn->$dbname;  
  
// select the collection  
$collection = $db->users; 
  
$query_user = array(
	'_id' => new MongoId('53403a8377799872ac242d39')
);

// pull a cursor query  
/*$result = $collection->update(
	$query_user,
	array( '$set' => array('name' => 'hey') )
);  */

var_dump($collection->findOne());
?>  
