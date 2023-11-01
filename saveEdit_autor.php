<?php

include_once('config_form.php');

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $autor=$_POST['autor'];
    

    $sqlUpdate = "UPDATE autores SET nome='$autor'
    WHERE id= '$id'";

    $result = $conexao->query($sqlUpdate);
}

header('Location: dashboard_autores.php');
?>