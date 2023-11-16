<?php
include "db/database.php";

if(!isset($_SESSION['id'])){
    header('location:login.php');
}

// Variável para armazenar a ordem atual
$ordenacao = isset($_GET['ordenacao']) ? $_GET['ordenacao'] : 'desc';

$sql = "SELECT items.*, categoria.nome AS categoria_nome FROM items LEFT JOIN categoria ON items.id = categoria.iditems";
$resultado = $conn->query($sql);
$items = $resultado->fetch_all(MYSQLI_ASSOC);

$sql_f = "SELECT *,i.id AS id_item,c.nome as categoria_nome  FROM items i LEFT JOIN ratings r ON i.id = r.item_id  left join categoria c on c.iditems = i.id AND r.user_id = {$_SESSION['id']} WHERE r.item_id IS  NULL";
$resultado = $conn->query($sql_f);
$items2 = $resultado->fetch_all(MYSQLI_ASSOC);

$jsonItems = json_encode($items);

//Jogo com mais likes
$sql_rankinglk = "SELECT r.item_id, COUNT(r.rating) AS dislike_count FROM ratings r WHERE r.rating = 'like' GROUP BY item_id ORDER BY dislike_count $ordenacao LIMIT 1;";
$resultado = $conn->query($sql_rankinglk);
$items4 = $resultado->fetch_all(MYSQLI_ASSOC);

//Jogo com mais dislikes
$sql_rankingdlk = "SELECT r.item_id, COUNT(r.rating) AS dislike_count FROM ratings r WHERE r.rating = 'dislike' GROUP BY item_id ORDER BY dislike_count $ordenacao LIMIT 1";
$resultado = $conn->query($sql_rankingdlk);
$items3 = $resultado->fetch_all(MYSQLI_ASSOC);

//Jogos com mais likes
$sql_likes = "SELECT r.item_id, COUNT(r.rating) AS dislike_count FROM ratings r WHERE r.rating = 'liiike' GROUP BY item_id ORDER BY dislike_count $ordenacao";
$resultado = $conn->query($sql_likes);
$items_like = $resultado->fetch_all(MYSQLI_ASSOC);

//Jogo com mais dislikes
$sql_dislikes = "SELECT r.item_id, COUNT(r.rating) AS dislike_count FROM ratings r WHERE r.rating = 'dislike' GROUP BY item_id ORDER BY dislike_count $ordenacao";
$resultado = $conn->query($sql_dislikes);
$items_dislike = $resultado->fetch_all(MYSQLI_ASSOC);
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
    
    <label for="ordenacao">Ordem:</label>
    <select id="ordenacao" name="ordenacao" onchange="atualizarOrdenacao()">
        <option value="desc" <?php echo ($ordenacao == 'desc') ? 'selected' : ''; ?>>Decrescente</option>
        <option value="asc" <?php echo ($ordenacao == 'asc') ? 'selected' : ''; ?>>Crescente</option>
    </select>

    <?php if($_SESSION['tipo'] == "user" or $_SESSION['tipo'] == "manager") : ?>
    
        <?php if($items2 == null) : ?>

            <div class="box">
                <h3>Melhor Jogo no Ranking</h3>
                <?php foreach($items as $item) : ?>
                <?php if($item["id"] == $items4[0]["item_id"]) : ?>
                <img src="<?php echo $item['image_url']; ?>" alt="">
                <h4><?php echo $item['name'] ?></h4>    
                <?php endif; ?>
                <?php endforeach; ?>
                <h3>Pior Jogo no Ranking</h3>
                <?php foreach($items as $item) : ?>
                <?php if($item["id"] && isset($items3[0]["item_id"])) : ?>
                <img src="<?php echo $item['image_url']; ?>" alt="">
                <h4><?php echo $item['name'] ?></h4>
                <?php elseif($items3) : ?>
                <p>Não há jogos com likes</p>
                <?php else : ?>
                <p>Não há jogos com deslikes</p> 
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        
        <?php endif; ?>

         <?php foreach($items as $item) : ?>
        <div class="box">
        <img src="<?php echo $item['image_url']; ?>" alt="" width="250px">
        <p><?php echo $item['name']; ?></p>
        <p> Categoria: <?php echo $item['categoria_nome']; ?></p>
        <?php if ($_SESSION['tipo'] == "user" ) : ?>
            <!-- Botões de avaliação para usuários -->
            <a href="processar_rating.php?id=<?php echo $item['id_item']; ?>&&tipo=1"><input type="button" value="✅"></a>
            <a href="processar_rating.php?id=<?php echo $item['id_item']; ?>&&tipo=2"><input type="button" value="❌"></a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

    <?php endif;?>

    <?php if($_SESSION['tipo'] == 'manager') :?>
        <?php foreach($items as $item1) : ?>
            <a href="editar_jogo.php?id=<?php echo $item1['id'];?>"><img src="<?php echo $item1['image_url'] ?>" alt="">
            <p><?php echo $item1['name']; ?></p>
            </a>
        <?php endforeach;?>
        <a class="a" href="cadastrar_jogo.php">Cadastrar Jogo</a>
    <?php endif;?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    
    function atualizarOrdenacao() {
    const ordenacao = document.getElementById("ordenacao").value;
            window.location.href = "index.php?ordenacao=" + ordenacao;
        }

$(document).ready(function() {
    let currentIndex = 0;
    const items = <?php echo $jsonItems; ?>;

    // Esconda todas as caixas, exceto a primeira
    $(".box").hide();
    $(".box").eq(currentIndex).show();

    // Adicione um ouvinte de evento de clique aos botões
    $(".box button").click(function() {
        
        $(".box").eq(currentIndex).hide();

        // Incrementa o índice atual
        currentIndex++;

        // Se o próximo índice for maior ou igual ao número de itens, volte ao primeiro item
        if (currentIndex >= items.length) {
            currentIndex = 0;
        }

        // Mostre a próxima caixa
        $(".box").eq(currentIndex).show();

        // Atualize a imagem e o texto da caixa atual
        showItem(currentIndex);
    });

    // Função para mostrar um item com base no índice
    function showItem(index) {
        const item = items[index];
        if (item) {
            const box = $(".box").eq(index);
            box.find("img").attr("src", item.image_url);
            box.find("p").text(item.name);
        }
    }
});
</script>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

header {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
}

.box {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 20px auto;
    padding: 20px;
    text-align: center;
    max-width: 300px;
}
.box img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 10px;
}

.box p {
    margin-bottom: 10px;
}

input[type="button"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}

select, label {
    margin: 10px;
}

select {
    padding: 5px;
}

a {
    text-decoration: none;
    color: #333;
}

a:hover {
    color: #4CAF50;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
}

</style>
</body>
</html>
