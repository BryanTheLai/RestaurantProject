<?php
/*--------------------BEGINNING OF THE CONNECTION PROCESS------------------*/
//define constants for db_host, db_user, db_pass, and db_database
//adjust the values below to match your database settings
// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', ''); //may need to set DB_PASS as 'root'
// define('DB_DATABASE', 'restaurantdb'); //make sure to set your database
// //connect to database host
// $link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
// //make sure connection is good or die
// if ($link->connect_errno) 
// {
//   die("Failed to connect to MySQL: (" . $link->connect_errno . ") " . $link->connect_error);
// }

require_once 'config.php';


//SELECT - used when expecting single OR multiple results
//returns an array that contains one or more associative arrays
function fetch_all($query, $params = array()) {
  $data = array();
  global $link;

  // Prepare the statement
  $statement = $link->prepare($query);

  if (!$statement) {
    die("Error in preparing statement: " . $link->error);
  }

  // Bind the parameters if there are any
  if (!empty($params)) {
    $types = str_repeat('s', count($params)); // Assuming all parameters are strings
    $statement->bind_param($types, ...$params);
  }

  // Execute the query
  $result = $statement->execute();

  // Check if execution succeeded
  if (!$result) {
    die("Error in executing statement: " . $statement->error);
  }

  // Get the result set
  $result = $statement->get_result();

  // Fetch all rows as an associative array
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }

  // Close the statement
  $statement->close();

  return $data;
}

//SELECT - used when expecting a single result
//returns an associative array
function fetch_record($query, $params = array())
{
  global $link;

  $statement = $link->prepare($query);

  if(!$statement) {
    die("Error in preparing statement: " . $link->error);
  }

  if (!empty($params)) {
    $types = str_repeat('s', count($params)); // Assuming all parameters are strings
    $statement->bind_param($types, ...$params);
  }

  // Execute the query
  $result = $statement->execute();

  // Check if execution succeeded
  if (!$result) {
    die("Error in executing statement: " . $statement->error);
  }
  
  // Get the result
  $result = $statement->get_result();

  // Fetch the record as an associative array
  $record = $result->fetch_assoc();

  return $record;
}

//used to run INSERT/DELETE/UPDATE, queries that don't return a value
//returns a value, the id of the most recently inserted record in your database
function run_mysql_query($query, $params = array())
{
  global $link;

  $statement = $link->prepare($query);

  if(!$statement) {
    die("Error in preparing statement: " . $link->error);
  }

  if (!empty($params)) {
    $types = str_repeat('s', count($params)); // Assuming all parameters are strings
    $statement->bind_param($types, ...$params);
  }

  // Execute the query
  $result = $statement->execute();

  // Check if execution succeeded
  if (!$result) {
    die("Error in executing statement: " . $statement->error);
  }

    // Get the last inserted ID
    $last_insert_id = $link->insert_id;

    return $last_insert_id;
}

//returns an escaped string. EG, the string "That's crazy!" will be returned as "That\'s crazy!"
//also helps secure your database against SQL injection
function escape_this_string($string)
{
  global $link;
  return $link->real_escape_string($string);
}
?>