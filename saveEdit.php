<?php

include_once('config_form.php');

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $autor=$_POST['autor'];
    $numero_pro=$_POST['numero_pro'];
    $data_auto=$_POST['data_auto'];
    $data_aud=$_POST['data_aud'];
    $hora=$_POST['hora'];
    $cidade=$_POST['cidade'];
    $data_env=$_POST['data_env'];


    $sqlUpdate = "UPDATE juridico SET autorId='$autor',numero_pro='$numero_pro',data_auto='$data_auto',data_aud='$data_aud',hora='$hora',cidade='$cidade',data_env='$data_env'
    WHERE id= '$id'";

    $result = $conexao->query($sqlUpdate);
}

header('Location: dashboard.php');
?>