<?php

require_once(__DIR__ . '/config/mysql.php');

$getData=$_GET;

$stmt=$pdo->prepare('SELECT title, recipe FROM recipes WHERE recipe_id=:id');
$stmt->execute([
    'id'=>$getData['recipe_id'],
]);
$recipe=$stmt->fetch();

$sql=$pdo->prepare('SELECT u.email, r.title, c.comment  
FROM comments c
INNER JOIN users u ON c.user_id=u.user_id
INNER JOIN recipes r ON c.recipe_id=r.recipe_id
WHERE r.recipe_id=:id
');
$sql->execute([
  'id'=>$getData['recipe_id'],
]);
$comment=$sql->fetchAll();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

</head>
  <body>
    <?php require_once(__DIR__ . '/header.php');?>
    <div class="card" style="width: 20rem; margin:auto; margin-top:130px;">
      <div class="card-body">
        <h1><?php echo $recipe['title'];?></h1>
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Titre : <?php echo $recipe['title'];?></li>
                <li class="list-group-item">Description : <?php echo $recipe['recipe'];?></li>
                <li class="list-group-item">Date : </li>
            </ul>
        </div>
      </div>
    </div><br>

    <div class="card">
      <h5 class="card-header">Votre avis compte !</h5>
      <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Utilisateur</th>
            <th scope="col">commentaire</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($comment as $c):?>
          <tr>
            <th scope="row">1</th>
            <td><?php echo $c['email'];?></td>
            <td><?php echo $c['comment'];?></td>
            <td><button type="button" class="btn btn-outline-warning">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
            </svg></i></button><button type="button" class="btn btn-outline-danger" style="margin-left:10px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
            </svg></button></td>
        
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <button type="button" class="btn btn-primary"><a href="create_comment.php?recipe_id=<?php echo $getData['recipe_id'];?>" style="color:white; text-decoration:none;">Ajouter un commentaire</a></button>

      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

