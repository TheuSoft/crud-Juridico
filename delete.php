<?php 
if(!empty($_GET['id']))
{

    include_once('config_form.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM juridico WHERE id=$id";

    $result = $conexao->query($sqlSelect);

    if($result->num_rows >0)
    {
        $sqlDelete = "DELETE FROM juridico WHERE id=$id";
        $resultDelete = $conexao ->query($sqlDelete);
    }

}

header ('Location: dashboard.php ');

?>


