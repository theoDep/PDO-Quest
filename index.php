<?php
require_once "_connec.php";

$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST['firstname']))
  {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
    $statement = $pdo->prepare($query);

    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

    $statement->execute();

    header("location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Friends</title>
</head>
<body>
  <form action="" method="post">
    <label for="firstname">Firstname</label>
    <input type="text" name="firstname" id="firstname" placeholder="Rachel">
    <label for="lastname">Lastname</label>
    <input type="text" name="lastname" id="lastname" placeholder="Green">
  <button type="submit">Submit</button>
  </form>
  <ul>
    <?php foreach($friends as $friend):
     ?>
     <li><?php echo $friend['firstname'] . ' ' . $friend['lastname'] ?></li>
     <?php endforeach ?>
  </ul>
</body>
</html>
