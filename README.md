# RestaurantProjectPHP
Mini project for semester 4 at TARUMT

USEFUL LINK
  https://github.com/bradtraversy/php-crash/tree/main
```php
//database.php or config.php
//TO bring header.php to other file
//<?php  include 'header.php'?>
//or use require or require_once

//Connecting Database
define('DB_HOST','localhost');
define('DB_USER','');
define('DB_PASS','');
define('DB_NAME','');

//Create Concetion
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//Check COnnection
if($conn->connect_error){ //if not conencted
  die('Connection Failed'.$conn->connect_error);//kills the conenction OR terminate execution
}

```
<details>
  <summary>database.php or config.php</summary>

  ```php
//database.php or config.php
//TO bring header.php to other file
//<?php  include 'header.php'?>
//or use require or require_once

//Connecting Database
define('DB_HOST','localhost');
define('DB_USER','');
define('DB_PASS','');
define('DB_NAME','');

//Create Concetion
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//Check COnnection
if($conn->connect_error){ //if not conencted
  die('Connection Failed'.$conn->connect_error);//kills the conenction OR terminate execution
}

```

  ### Some Code
  ```js
  function logSomething(something) {
    console.log('Something', something);
  }
  ```
</details>
