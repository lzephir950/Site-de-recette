<?php 

    require_once(__DIR__ . '/config/mysql.php');


    $postData=$_POST;

    $stmt=$pdo->prepare('UPDATE recipes SET title=:title, recipe=:recipe WHERE recipe_id=:id');
    $stmt->execute([
        'id'=>$postData['recipe_id'],
        'title'=>$postData['title'],
        'recipe'=>$postData['recipe'],
    ]);
    


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
    <div class="card" style="width: 20rem; margin:auto; margin-top:130px;">
      <div class="card-body">
        <h1 style="color:green">Modification faite avec succès !</h1>
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Titre : <?php echo $postData['title'];?></li>
                <li class="list-group-item">Description : <?php echo $postData['recipe'];?></li>
                <li class="list-group-item">Date : </li>
            </ul>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>


