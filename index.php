<?php
include "db/database.php";

$sql = "SELECT * FROM items";

$resultado = $conn->query($sql);

$items = $resultado->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Video-Game-Controller-Icon-D-Edit.svg/1200px-Video-Game-Controller-Icon-D-Edit.svg.png" type="image/x-icon">
    <title>Rate The Game</title>
</head>
<body>
    <header>
        <h1>Rate The Game</h1>
        <a href="logout.php"><input type="button" value="Logout" name="logout"></a>
    </header>
    <?php if($_SESSION['tipo'] == "manager") : ?>
    
        <a href="cadastrar_jogo.php">Cadastrar Jogo</a>
        <?php foreach($items as $item) : ?>
            <a href="editar_jogo.php?id=<?php echo $item['id']; ?>"><div class="box">
                <img src="<?php echo $item['image_url']; ?>" alt="" width="250px">
                <p><?php echo $item['name']; ?></p>
            </div>
            </a>
        <?php endforeach;?>
    <?php endif;?>
</body>
</html>