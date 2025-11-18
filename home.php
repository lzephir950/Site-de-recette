<?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');

$stmt=$pdo->prepare('SELECT title, recipe, email FROM recipes');
$stmt->execute();
$recipe=$stmt->fetchAll();


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <?php require_once(__DIR__ . '/header.php');?><br>
    <h5>Bonjour <?php echo $_SESSION['USER']; ?> et bienvenue  ! </h5>
    <br>
    <?php echo '<script>alert("Welcome to Geeks for Geeks")</script>'; ?>
    <?php foreach($recipe as $r):?>
      <h1 style="color:orange";><?php echo $r['title'];?></h1>
      <p><?php echo $r['recipe'];?></p>
      <i><?php echo $r['email'];?></i><br>
      <button type="button" class="btn btn-warning">Modifier</button>
      <button type="button" class="btn btn-danger">Supprimer</button>
      <button type="button" class="btn btn-info">Voir</button>
    <?php endforeach;?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>