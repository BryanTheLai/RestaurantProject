# RestaurantProjectPHP
Mini project for semester 4 at TARUMT

## USEFUL LINK
  > PHP Crash Course by Brad Traversy: https://github.com/bradtraversy/php-crash/tree/main

  > StackEdit - Markdown Editor: https://stackedit.io/app#
<details>
  <summary>database.php or config.php</summary>

  ```php
//database.php or config.php
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

  ### put in page like index.php or home.php
```php
//TO bring header.php to other file
<?php  include 'header.php'?>
//or use require or require_once

//To Query
  $sql = 'SELECT * FROM tableSource';
  $result = mysqli_query($conn,$sql);
  $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

  foreach($data as $item): // in 2:59:45 of the video
    echo $item['name'];
    echo $item['price']; //use div and classes

//Setting to default
$name = $email = $body = ''; //all will be ''

```
</details>
