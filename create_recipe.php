<?php 
session_start();
require_once(__DIR__ . '/config/mysql.php');

$postData=$_POST;
if(isset($postData['formRecipe'])){
  $valid=true;

  $title=$postData['title'];
  $recipe=$postData['recipe'];
  $email=$_SESSION['LOGGED_USER'];

  $tableau=[$title, $recipe, $email];


if(isset($postData['title'])){
  if(empty($postData['title'])){
  $valid=false;
  $_SESSION['ERROR_TITLE']="Champ vide";
  }
}

if(isset($postData['recipe'])){
  if(empty($postData['recipe'])){
    $valid=false;
    $_SESSION['ERROR_RECIPE']="Champ vide";
  }
}


if($valid){
  $stmt=$pdo->prepare('INSERT INTO recipes(title, recipe, email) VALUES (?,?,?)');
  $stmt->execute($tableau);
  
  $_SESSION['MESSAGE_SUCCESS']="Recette enregistré avec succès !";
  var_dump($_SESSION['MESSAGE_SUCCESS']);
  header('Location: home.php');
  exit;
}
}
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
    <?php require_once(__DIR__ . '/header.php');?>
    <div class="card" style="width: 18rem; margin:auto; margin-top:130px;">
      <div class="card-body">
        <h1>Ajouter une recette</h1>
        <form action="create_recipe.php" method="post">         
          <div class="mb-3">
            <?php if(isset($_SESSION['ERROR_TITLE'])) : ?>
              <p style="color:red;"><?php echo $_SESSION['ERROR_TITLE']; ?></p>
              <p><?php unset($_SESSION['ERROR_TITLE']);?></p>
            <?php endif; ?>
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title">
          </div>
          <div class="mb-3">
            <?php if(isset($_SESSION['ERROR_RECIPE'])) : ?>
              <p style="color:red;"><?php echo $_SESSION['ERROR_RECIPE']; ?></p>
              <p><?php unset($_SESSION['ERROR_RECIPE']);?></p>
            <?php endif; ?>
            <label for="recipe" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="recipe" rows="3"></textarea>
          </div>
          </div>
          <button type="submit" class="btn btn-primary" name="formRecipe">Ajouter</button>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

