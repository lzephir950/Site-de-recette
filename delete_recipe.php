<?php 

require_once(__DIR__ . '/config/mysql.php');

$getData=$_GET;

$stmt=$pdo->prepare('DELETE FROM recipes WHERE recipe_id=:id');
$stmt->execute([
    'id'=>$getData['recipe_id'],
]);

header('Location: home.php');
exit;

?>

