<?php
include("db/database.php");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_POST["save"])) {
    $newName = $_POST['new_name'];
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $userID = $_SESSION['id'];

    $sql = "UPDATE users SET name = '$newName', password = '$newPassword' WHERE id = $userID";

    if ($conn->query($sql) === TRUE) {
        echo "Nome e senha atualizados com sucesso.";
    } else {
        echo "Erro ao atualizar nome e senha: " . $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Alterar Nome e Senha</title>
</head>
<body>
    <h1>Alterar Nome e Senha</h1>
    <form action="" method="post">
        <label for="new_name">Novo Nome:</label>
        <input type="text" name="new_name" required><br>
        <label for="new_password">Nova Senha:</label>
        <input type="password" name="new_password" required><br>
        <input type="submit" value="Alterar" name='save'>
    </form>
</body>
</html>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            background-color: #0074d9;
            color: #fff;
            padding: 20px;
            margin: 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #0074d9;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056a3;
        }
    </style>