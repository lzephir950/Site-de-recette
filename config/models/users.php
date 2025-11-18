<?php 

require_once(__DIR__ . '/../../config/mysql.php');

$stmt=$pdo->prepare('SELECT * FROM users WHERE email=:email AND password=:password');
$stmt->execute([
    'email'=>$email,
    'password'=>$password,
]);
$user=$stmt->fetch();

?>