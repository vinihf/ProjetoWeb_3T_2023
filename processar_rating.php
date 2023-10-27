<?php
include ("db/database.php");

if ($_GET['tipo'] == 1) {
    $sql_like = "INSERT INTO ratings (user_id,item_id,rating) VALUES ({$_SESSION['id']},{$_GET['id']},1)";
    $resultado = $conn->query($sql_like);
    header("location: index.php");  
    
}else if($_GET['tipo']== 2){
    $sql_deslike = "INSERT INTO ratings (user_id,item_id,rating) VALUES ({$_SESSION['id']},{$_GET['id']},2)";
    $resultado = $conn->query($sql_deslike);
    header("location: index.php");
    
}
?>