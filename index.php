<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./css/style.css">
   <title>crud</title>
</head>

<body>

   <?php
   include("./components/component.php");
   $dsn = 'mysql:host=localhost;dbname=package_manager';
   $user = 'root';
   $password = '';
   $options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
   );

   try {
      $db = new PDO($dsn, $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      echo 'connected';
   } catch (\Throwable $th) {
      echo '' . $th->getMessage() . '';
   }
   $template = template();
   echo "<h1>$template</h1>";
   ?>
</body>

</html>