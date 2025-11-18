<?php 


require_once(__DIR__ . '/config/mysql.php');

$postData=$_POST;

// SI LE FORMULAIRE EST BIEN SOUMIS
if(isset($postData['formRegister'])){
    $valid=true;

    $firstName=htmlentities($postData['first_name']);
    $name=htmlentities($postData['name']);
    $email=htmlentities(strtolower($postData['email']));
    $password=htmlentities(trim($postData['password']));
    $confPass=htmlentities(trim($postData['confpass']));

    $tableau=[$firstName, $name, $email, $password, $confPass];

}


// Verification du champ nom
if(empty($firstName)){
    $valid=false;
    $firstNameError="Champ vide";
}

// Verification du champ prénom
if(empty($name)){
    $valid=false;
    $nameError="Champ vide";
}

if(isset($postData['email'])){
  // Verification du champ email
  if(empty($email)){
    $valid=false;
    $emailError="Champ vide";

  } //Puis vérification du mail valide 
  elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $valid=false;
    $invalidEmail="Votre email est invalide";
  }else{
      // J'appelle les email dans ma table users
      $verif=$pdo->prepare('SELECT email FROM users WHERE email = ?');
      $verif->execute([$email]);
      $verif=$verif->fetch();

      // Vérification si'email est existant ou non
      if($verif){
        $valid=false;
        $verifError="L'email existe déjà";
      
      }
    }
  }


  if(isset($postData['password'])){
    // Vérification champ mot de passe
    if(empty($password)){
      $valid=false;
      $passwordError="Champ vide";
    }else{
      // Vérification de sa taille
      
      $nbMinString=8;
      $nbMaxString=20;
      $passwordLength=strlen($password);

      if($passwordLength < $nbMinString){ 
        $valid=false;
        $nbMinStringError="Mot de passe trop court";
         $valid=false;
      }elseif($passwordLength > $nbMaxString){ 

        $nbMaxStringError="Mot de passe trop long";
      }

    }
  }


  

if(isset($postData['confpass'])){
  if(empty($confPass)){
    $valid=false;
    $confPassError="Champ vide";
  }else{

    if($confPass !== $password){
      $valid=false;
      $confPassVerifError="Le mot de passe ne correspond pas";
    }
  }
}



if($valid){
  
  // $password=password_hash($password, PASSWORD_ARGON2ID);

  $stmt=$pdo->prepare('INSERT INTO users(first_name, name, email, password, confpass) VALUES (?,?,?,?,?)');
  $stmt->execute($tableau);

  header('Location: index.php');
  exit;
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
        <form action="register.php" method="post">
          <div class="mb-3">
            <?php if(isset($firstNameError)) : ?>
                <p style="color:red;"><?php echo $firstNameError; ?></p>
            <?php endif; ?>
            <label for="first_name" class="form-label">Nom</label>
            <input type="first_name" class="form-control" id="first_name" aria-describedby="emailHelp" name="first_name">
          </div>
          <div class="mb-3">
            <?php if(isset($nameError)) : ?>
                <p style="color:red;"><?php echo $nameError; ?></p>
            <?php endif; ?>
            <label for="name" class="form-label">Prénom</label>
            <input type="name" class="form-control" id="name" name="name">
          </div>
          <div class="mb-3">
            <?php if(isset($emailError)) : ?>
                <p style="color:red;"><?php echo $emailError; ?></p>
            <?php endif; ?>
            <?php if(isset($invalidEmail)) : ?>
              <p style="color:red;"><?php echo $invalidEmail; ?></p>
            <?php endif; ?>
            <?php if(isset($verifError)) : ?>
              <p style="color:red;"><?php echo $verifError; ?></p>
            <?php endif; ?>
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"  placeholder="john.doe@gmail.com">
          </div>
          <div class="mb-3">
            <?php if(isset($passwordError)) : ?>
                <p style="color:red;"><?php echo $passwordError; ?></p>
            <?php endif; ?>
            <?php if(isset($nbMinStringError)) : ?>
              <p style="color:red;"><?php echo $nbMinStringError; ?></p>
            <?php endif; ?>
            <?php if(isset($nbMaxStringError)) : ?>
              <p style="color:red;"><?php echo $nbMaxStringError; ?></p>
            <?php endif; ?>
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
            <div id="passwordHelpBlock" class="form-text">
            Votre mot de passe doit contenir 8 à 20 caractères sans espaces ni caractères spéciaux.
            </div>
          </div>
          <div class="mb-3">
            <?php if(isset($confPassVerifError)) : ?>
              <p style="color:red;"><?php echo $confPassVerifError; ?></p>
            <?php endif; ?>
            <?php if (isset($confPassError)) : ?>
              <p style="color:red;"><?php echo $confPassError; ?></p>
            <?php endif; ?>
            <label for="confpass" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="confpass" name="confpass">
          </div>
          <button type="submit" class="btn btn-primary" name="formRegister">S'enregistrer</></button>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>