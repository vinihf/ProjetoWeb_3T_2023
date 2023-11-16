<?php
include "db/database.php";
if(!isset($_SESSION['id'])){
    header('location:login.php');
} elseif ($_SESSION['tipo'] != 'maneger') {
        header('location:index.php');
}
$sql = "SELECT * FROM items WHERE id = {$_GET['id']}";

$resultado = $conn->query($sql);

$items = $resultado->fetch_all(MYSQLI_ASSOC);
if(isset($_POST['sim'])){
    $sql_dl = "DELETE from categoria WHERE iditems = {$_GET['id']}";
    $resultado = $conn->query($sql_dl);
    $sql_dlts = "DELETE FROM ratings WHERE item_id = {$_GET['id']}";
    $resultado = $conn->query($sql_dlts);
    $sql_dlt = "DELETE FROM items WHERE id = {$_GET['id']}";
    $resultado = $conn->query($sql_dlt);
    header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Video-Game-Controller-Icon-D-Edit.svg/1200px-Video-Game-Controller-Icon-D-Edit.svg.png" type="image/x-icon">
    <title>Rate the Game - deletar</title>
    <link rel="stylesheet" href="LoginStyle.css">
</head>
<body>
    <form action="" method="post">
    <div class="box">
        <?php foreach($items as $item) : ?>
        <h3>Você tem Certeza de Deletar permanentemente <?php echo $item['name'];?></h3>
        <?php endforeach; ?>
    </div>
    <button name='sim'>Sim</button>
    <a href="index.php"><input type="button" value="não"></a>
    </form>
</body>
</html>
