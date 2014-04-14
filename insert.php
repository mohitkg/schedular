<?php
   // connect to mongodb
   $m = new MongoClient();
   echo "Connection to database successfully";
   // select a database
   $db = $m->bookMyevent;
   echo "Database mydb selected";
   $collection = $db->users;
   echo "Collection selected succsessfully";
   $document = array( 
      "email" => "07sahilsolanki@gmail.com", 
      "password" => md5("solanki"), 
      "occup" => "student"
      
   );
   $collection->insert($document);
   echo "Document inserted successfully";
?>
