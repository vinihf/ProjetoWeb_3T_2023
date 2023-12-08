<?php
include("db/database.php");
if (!isset($_SESSION['id'])) {
    header('location:login.php');
}
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
    <link rel="stylesheet" href="style/style.css">
<head>
    <title>Alterar Nome e Senha</title>
    <div class="logout">
    
    </div>
</head>
<body>
    <h1>Alterar Nome e Senha</h1>
    <form action="" method="post">
        <label for="new_name">Novo Nome:</label>
        <input type="text" name="new_name" value="<?php echo $_SESSION['nome']; ?>" required><br>
        <label for="new_password">Nova Senha:</label>
        <input type="password" name="new_password" required><br>
        <div class="logout">
        <a href="index.php"><button>Voltar</button></a>
        <input class="alterar" type="submit" value="Alterar" name='save'>
        
        </div>
        
    </form>
</body>
</html>
<style>
    .alterar{
        width: 50%;
    }
    .logout{
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        text-align: center;
        height: 50px;
    }
    button{
        background: #0074d9;
        border: none;
        color: white;
        text-align: center;
    }
    a{
       background: #0074d9;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin: 20px 0 0 0;

        
    }
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
            width: 90%;
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
            width: 30%;
            height: 75%;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056a3;
        }
    </style>