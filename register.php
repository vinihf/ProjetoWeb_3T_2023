<?php
require_once("db/database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nome = $_POST["nome"];
$email = $_POST["login"];
$senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

$sql_check_email = "SELECT * FROM users WHERE email = '$email'";
$resultado_check_email = $conn->query($sql_check_email);

if ($resultado_check_email->num_rows > 0) {
    
    echo "<script>alert ('Este e-mail já está registrado. Por favor, escolha outro e-mail.')</script>";
} else {
    $sql_register = "INSERT INTO users (name, email, password) VALUES ('$nome','$email', '$senha')";

    $resultado = $conn->query($sql_register);

    if ($resultado) {
        echo "Registro realizado com sucesso!";
        header("location: login.php");
    } else {
        echo "Erro ao registrar: " . $conn->error;
    }
}

$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Video-Game-Controller-Icon-D-Edit.svg/1200px-Video-Game-Controller-Icon-D-Edit.svg.png" type="image/x-icon">
    <title>Registro</title>
    <link rel="stylesheet" href="LoginStyle.css">
</head>
<body>
</html>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="POST" autocomplete="off">
                    <h2>Register</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" name="nome" required>
                        <label for="">Nome</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="login" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="senha" required>
                        <label for="">Password</label>
                    </div>
                    <button name="bttn">Registro</button>
                    <div class="register">
                        <p>Ja tem conta? Faça <a href="login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<style>
    *{
    margin: 0;
    padding: 0;
    font-family: 'poppins',sans-serif;
    color: white;
}
section{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    width: 100%;
    
    background-color:lightslategray;
    background-position: center;
    background-size: cover;
}
.form-box{
    position: relative;
    width: 400px;
    height: 450px;
    background: transparent;
    border: 2px solid rgba(255,255,255,0.5);
    border-radius: 20px;
    backdrop-filter: blur(15px);
    display: flex;
    justify-content: center;
    align-items: center;

}
h2{
    font-size: 2em;
    color: #fff;
    text-align: center;
}
.inputbox{
    position: relative;
    margin: 30px 0;
    width: 310px;
    border-bottom: 2px solid #fff;
}
.inputbox label{
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    color: #fff;
    font-size: 1em;
    pointer-events: none;
    transition: .5s;
}
input:focus ~ label,
input:valid ~ label{
top: -5px;
}
.inputbox input {
    width: 100%;
    height: 50px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    padding:0 35px 0 5px;
    color: #fff;
}
.inputbox ion-icon{
    position: absolute;
    right: 8px;
    color: #fff;
    font-size: 1.2em;
    top: 20px;
}
.forget{
    margin: -15px 0 15px ;
    font-size: .9em;
    color: #fff;
    display: flex;
    justify-content: space-between;  
}

.forget label input{
    margin-right: 3px;
    
}
.forget label a{
    color: #fff;
    text-decoration: none;
}
.forget label a:hover{
    text-decoration: underline;
}
button{
    width: 100%;
    height: 40px;
    border-radius: 40px;
    background: #fff;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1em;
    font-weight: 600;
    color: black;
}
button:hover{
    opacity: 0.8;
}
button:active{
   opacity: 0.7;
}
p{
    display: flex;
    justify-content:center;
    color: white;
    margin-top: 15px;
    margin-bottom: 15px;
}
a{
    margin-left: 3px;
    text-decoration: none;
    color: blanchedalmond;
    background: 
      linear-gradient(90deg,  white 50%,#000 0) 
      var(--_p,100%)/200% no-repeat;
    -webkit-background-clip: text;
            background-clip: text;
    transition: .4s;
}
a:hover{
    --_p: 0%;
    
}
select{
    background: transparent;
    text-align: center;
    width: 100%;
    height: 100%;
    font-size: medium;
}
option{
    color: black;
    background: transparent;
}
</style>