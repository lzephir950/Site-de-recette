<?php 

require_once(__DIR__ . '/config/mysql.php');

$getData=$_GET;

$stmt=$pdo->prepare('SELECT title, recipe FROM recipes WHERE recipe_id=:id');
$stmt->execute([
    'id'=>$getData['recipe_id'],
]);
$recipe=$stmt->fetch();

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
        <h1>Modifier la recette <?php echo $recipe['title'];?></h1>
        <form action="post_update_recipe.php" method="post">
            <div class="mb-3">
            <input type="hidden" class="form-control" name="recipe_id" value="<?php echo $getData['recipe_id'];?>">
          </div>         
          <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $recipe['title'];?>">
          </div>
          <div class="mb-3">
            <label for="recipe" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="recipe" rows="3"><?php echo $recipe['recipe']; ?></textarea>
          </div>
          </div>
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>


