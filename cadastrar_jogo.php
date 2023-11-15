<?php
require_once("db/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['name'];

    $sql_verificacao = "SELECT * FROM items WHERE name = '$nome'";
    $stmt_verificacao = $conn->prepare("SELECT * FROM items WHERE name = ?");
    $stmt_verificacao->bind_param("s", $nome);
    $stmt_verificacao->execute();
    $resultado_verificacao = $stmt_verificacao->get_result();

    if ($resultado_verificacao->num_rows > 0) {
        echo '<script>alert("Jogo já registrado!");</script>';
    } else {
        $uploadDir = "uploads/";
        $nomeArquivo = uniqid() . "_" . $_FILES["imagem"]["name"];
        $caminhoArquivo = $uploadDir . $nomeArquivo;

        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoArquivo)) {
            $sql = "INSERT INTO items (name,image_url) VALUES ('$nome','$caminhoArquivo')";
            $stmt = $conn->prepare("INSERT INTO items (name, image_url) VALUES (?, ?)");
            $stmt->bind_param("ss", $nome, $caminhoArquivo);
            $stmt->execute();

            if ($resultado_verificacao) {
                header("location: index.php");
            } else {
                error_log("Erro ao cadastrar Jogo: " . $conn->error);
                echo "Erro ao cadastrar Jogo: " . htmlspecialchars($conn->error);
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate the Game - Registrar Jogo</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Video-Game-Controller-Icon-D-Edit.svg/1200px-Video-Game-Controller-Icon-D-Edit.svg.png" type="image/x-icon">

</head>
<body>
    <form method="post" action="" enctype="multipart/form-data">
        <header>
            <div class="top">
                <a href="index.php"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Video-Game-Controller-Icon-D-Edit.svg/1200px-Video-Game-Controller-Icon-D-Edit.svg.png" alt="" width="90" height="90"></a>
                <h1>Cadastrar Jogos</h1>
            </div>
        </header>
        <label for="titulo">Nome:</label>
        <input type="text" name="name" required><br>
        <label for="imagem">Imagem do Jogo:</label>
        <input type="file" name="imagem" accept="image/*" required><br>
        <input type="submit" value="Cadastrar">
        <a href="index.php"><input type="button" value="Voltar" name="voltar"></a>
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
