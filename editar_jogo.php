<?php
include "db/database.php";

$idItem = $_GET['id'];

$sql_items = "SELECT items.*, categoria.nome as categoria_nome FROM items 
              LEFT JOIN categoria ON items.id = categoria.iditems
              WHERE items.id = $idItem";
$resultado = $conn->query($sql_items);
$items = $resultado->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['salvar'])) {
    if ($_POST['name'] != null) {

        $uploadDir = "uploads/";
        $nomeArquivo = uniqid() . "_" . $_FILES["imagem"]["name"];
        $caminhoArquivo = $uploadDir . $nomeArquivo;

        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoArquivo)) {
            // Atualizar informações na tabela 'items'
            $sql_update_items = "UPDATE items SET name = '{$_POST['name']}', image_url = '$caminhoArquivo' WHERE id = $idItem";
            $resultado_update_items = $conn->query($sql_update_items);

            if ($resultado_update_items) {
                // Atualizar categoria na tabela 'categoria'
                $novaCategoria = $_POST['categoria'];
                $sql_update_categoria = "UPDATE categoria SET nome = '$novaCategoria' WHERE iditems = $idItem";
                $resultado_update_categoria = $conn->query($sql_update_categoria);

                if ($resultado_update_categoria) {
                    header("location: index.php");
                } else {
                    echo "Erro ao atualizar categoria: " . $conn->error;
                }
            } else {
                echo "Erro ao atualizar informações do Jogo: " . $conn->error;
            }
        }
    } else {
        echo "<script> alert('Preencha todos os campos!') </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Video-Game-Controller-Icon-D-Edit.svg/1200px-Video-Game-Controller-Icon-D-Edit.svg.png" type="image/x-icon">
    <title>Rate the Game - Editar Jogo</title>
    <!DOCTYPE html>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data">
        <header>
            <div class="top">
                <a href="index.php"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Video-Game-Controller-Icon-D-Edit.svg/1200px-Video-Game-Controller-Icon-D-Edit.svg.png" alt="" width="90" height="90"></a>
                <h1>Edição de Livros</h1>
            </div>
        </header>
        <?php foreach($items as $item) : ?>
        <label for="name">Nome:</label>
        <input type="text" name="name" placeholder = "<?php echo $item['name']; ?>"><br>
        <label for="imagem">Imagem do Livro:</label>
        <input type="file" name="imagem" accept="image/*" required><br>
        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" placeholder="<?php echo $item['categoria_nome']; ?>"><br>

        <input type="submit" name="salvar" value="Salvar Edições">
        <a href="index.php"><input type="button" value="Voltar" name="voltar"></a>
        <?php endforeach;?>
    </form>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.top{
    background-color:deepskyblue; 
    color: black;
    text-align: center;
    padding: 20px 0;
    border-radius: 6px;
}

.top {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.top a img {
    margin-right: 10px;
}

h1 {
    font-size: 24px;
    margin: 0;
}

form {
    max-width: 90%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"],
input[type="button"] {
    background-color: deepskyblue;
    color: #333;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    font-weight: bold;
}

input[type="submit"]:hover,
input[type="button"]:hover {
    background-color: deepskyblue; 
}

@media (min-width: 768px) {
    h1 {
        font-size: 28px;
    }

    form {
        min-width: 600px;
    }
}

</style>
</body>
</html>