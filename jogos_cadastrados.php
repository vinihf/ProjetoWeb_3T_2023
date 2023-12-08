<?php
include_once "db/database.php";
if($_SESSION['tipo'] == 'user'){
    header('Location: index.php');
} else {

    $sql = "SELECT * FROM items";
    $resultado = $conn->query($sql);
    $items = $resultado->fetch_all(MYSQLI_ASSOC);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Video-Game-Controller-Icon-D-Edit.svg/1200px-Video-Game-Controller-Icon-D-Edit.svg.png" type="image/x-icon">
    <title>Rate The Game</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>
        <h1>Rate The Game</h1>
        <a href="logout.php"><input type="button" value="Logout" name="logout"></a>
    </header>
<body>
<?php foreach($items as $item) : ?>
    <div class="box-container">
    <div class="box">
    <a href="editar_jogo.php?id=<?php echo $item['id']; ?>">
        <img src="<?php echo $item['image_url']; ?>" alt="">
        
    </a>
    <div class="ps">
    <p><?php echo $item['name']; ?></p>
    <a href="deletar_jogo.php?id=<?php echo $item['id']; ?>">Deletar</a>
    </div>
    </div>
    </div>
<?php endforeach; ?>
</body>
<style>
    .box{
        display: flex;
        flex-direction: column;
    }]
    .ps{
        display: flex;
        width: 100%;
    }
</style>
</html>
