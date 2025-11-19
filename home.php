<?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/function.php');

$stmt=$pdo->prepare('SELECT title, recipe, email, recipe_id FROM recipes LIMIT 0,3');
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
    <?php if(isset($_SESSION['MESSAGE_SUCCESS'])) : ?>
      <p><?php alert($_SESSION['MESSAGE_SUCCESS']);?></p>
      <?php unset($_SESSION['MESSAGE_SUCCESS']); ?>
    <?php endif;?>
    <?php foreach($recipe as $r):?>
      <h1 style="color:orange";><?php echo $r['title'];?></h1>
      <p><?php echo $r['recipe'];?></p>
      <i><?php echo $r['email'];?></i><br>
      <button type="button" class="btn btn-warning"><a href="update_recipe.php?recipe_id=<?php echo $r['recipe_id'];?>"style="text-decoration:none; color:white">Modifier</a></button>
      <button type="button" class="btn btn-danger"><a href="delete_recipe.php?recipe_id=<?php echo $r['recipe_id'];?>"style="text-decoration:none; color:white">Supprimer</a></button>
      <button type="button" class="btn btn-info"><a href="read_recipe.php?recipe_id=<?php echo $r['recipe_id'];?>"style="text-decoration:none; color:white">Voir</a></button><br><br>
    <?php endforeach;?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>