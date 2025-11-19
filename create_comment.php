<?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');
$getData=$_GET;
$postData=$_POST;

if(isset($postData['formComment'])){
    $valid=true;
    $comment=$postData['comment'];
    $user=$postData['user_id'];
    $recipe=$postData['recipe_id'];

    $tableau=[$comment, $user, $recipe];

    if(empty($comment)){
        $valid=false;
        $_SESSION['ERROR']="champ vide";
    }elseif($valid){
        $stmt=$pdo->prepare('INSERT INTO comments(comment, user_id, recipe_id) VALUES (?,?,?)');
        $stmt->execute($tableau);

        if($recipe){
            header('Location: read_recipe.php?recipe_id=' . $recipe);
            exit;
        }
    }
}

$sql=$pdo->prepare('SELECT title FROM recipes WHERE recipe_id=:id');
$sql->execute([
  'id'=>$getData['recipe_id'],
]);
$recipe=$sql->fetch();


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
        <h1>Donnez votre avis !</h1>
        <h3>Recette : <?php echo $recipe['title']; ?></h3>
        <form action="create_comment.php" method="post">
          <div class="mb-3">
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['ID_USER']; ?>">
            <input type="hidden" id="recipe_id" name="recipe_id" value="<?php echo $getData['recipe_id'];?>">
          </div>         
          <div class="mb-3">
            <label for="" class="form-label"><?php echo $_SESSION['LOGGED_USER'];?></label>
          </div>
          <div class="mb-3">
            <?php if(isset($_SESSION['ERROR'])) : ?>
                <p style="color:red"><?php echo $_SESSION['ERROR']; ?></p>
            <?php endif; ?>
            <label for="comment" class="form-label">Commentaire</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
          </div>
          </div>
          <button type="submit" class="btn btn-primary" name="formComment">Ajouter</button>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>