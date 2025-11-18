<?php 

session_start();
require_once(__DIR__ . '/config/mysql.php');

$postData=$_POST;

$email=$postData['email'] ?? '';
$password=$postData['password'] ?? '';

require_once(__DIR__ . '/config/models/users.php');


if(isset($postData['email']) && isset($postData['password'])){
  if(filter_var($postData['email'], FILTER_VALIDATE_EMAIL)){
    // $_SESSION['INVALID_EMAIL']="email invalide";
  }
  
  if(empty($postData['email'])){
    $_SESSION['ERROR_FIELD']="champ vide";
    
  }

  if(empty($postData['password'])){
        $_SESSION['ERROR_FIELDS']="champ vide";
        
  }
  
  if($user){
    if($postData['email'] === $user['email'] && $postData['password'] === $user['password']){
          $_SESSION['LOGGED_USER']=$user['email'];
          $_SESSION['ID_USER']=$user['user_id'];
          $_SESSION['USER']=$user['name'];
          header('Location: home.php');
          exit;
    }
    

    }

    if(!isset($_SESSION['LOGGED_USER'])){
      $_SESSION['ERROR_MESSAGE']=sprintf("vos id sont incorrects: (%s\%s)", $postData['email'], $postData['password']);

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
    <div class="card" style="width: 18rem; margin:auto; margin-top:130px;">
      <div class="card-body">
        <form action="index.php" method="post">
          <?php if(!isset($_SESSION['LOGGED_USER'])) : ?>
            <?php if(isset($_SESSION['ERROR_MESSAGE'])) : ?>
              <p><?php echo $_SESSION['ERROR_MESSAGE']; ?></p>
              <?php unset($_SESSION['ERROR_MESSAGE']);?>
            <?php endif; ?>
          <?php endif; ?>
          
          <div class="mb-3">
            <?php if(isset($_SESSION['ERROR_FIELD'])) : ?>
              <p><?php echo $_SESSION['ERROR_FIELD'];?></p>
              <?php unset($_SESSION['ERROR_FIELD']); ?>
            <?php endif; ?>
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="john.doe@gmail.com">
          </div>
          <div class="mb-3">
            <?php if(isset($_SESSION['ERROR_FIELDS'])) : ?>
              <p><?php echo $_SESSION['ERROR_FIELDS'];?></p>
              <?php unset($_SESSION['ERROR_FIELDS']);?>
            <?php endif; ?>
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <button type="submit" class="btn btn-primary">Se connecter</button>
          <button type="button" class="btn btn-primary"><a href="register.php" style="text-decoration:none; color:white;">S'inscrire</a></button>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>