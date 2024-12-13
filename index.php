<!DOCTYPE html class="dark">
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./css/style.css">
   <title>crud</title>
</head>

<body>
   <?php
   include("./components/packages_table.php");
   include("./components/add_form.php");
   // connecter avec mysql
   $dsn = 'mysql:host=localhost;dbname=package_manager';
   $user = 'root';
   $password = '';
   $options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
   );
   $db = new PDO($dsn, $user, $password);
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST["name"];
      $description = $_POST["description"];
      $author = $_POST["author"];
      $email = $_POST["email"];
      $bio = $_POST["bio"];

      try {
         $query = "INSERT INTO authors (name, email, bio) VALUES (:author, :email, :bio);";
         $stmt = $db->prepare($query);
         $stmt->execute([
            ':author' => $author,
            ':email' => $email,
            ':bio' => $bio
         ]);

         $author_id = $db->lastInsertId();
         $query = "INSERT INTO packages (name, description, author_id) VALUES (:name, :description, :author_id)";
         $stmt = $db->prepare($query);
         $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':author_id' => $author_id
         ]);
      } catch (PDOException $e) {
         echo "Erreur lors de l'ajout : " . $e->getMessage();
      }
   };

   try {
      $query = "SELECT 
                  p.id,
                  p.name,
                  p.description,
                  a.name AS author,
                  GROUP_CONCAT(DISTINCT v.version_number ORDER BY v.version_number) AS versions FROM packages p
                  LEFT JOIN authors a ON p.author_id = a.id
                  LEFT JOIN versions v ON p.id = v.package_id
                  GROUP BY p.id, p.name, p.description, a.name";

      $stmt = $db->prepare($query);
      $stmt->execute();
      $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
   } catch (\Throwable $th) {
      echo '' . $th->getMessage() . '';
   }
   // afficher les packages
   echo packages_table($packages);
   // ajouter le formulaire
   echo add_form();
   ?>
   <script src="./main.js"></script>
</body>

</html>