<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: index.php');
} else {
    $logado = $_SESSION['email'];
}
?>

<?php
if(!empty($_GET['id']))
{

    include_once('config_form.php');
    $sql = "SELECT id,nome FROM autores ORDER BY id";
    $listaAutores = mysqli_query($conexao,$sql);
    if (mysqli_num_rows($listaAutores)==0){
        header ('Location: formulario_autor.php');
    }
    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM juridico  WHERE id=$id";

    $result = $conexao->query($sqlSelect);

    if($result->num_rows >0)
    {
        while($user_data = mysqli_fetch_assoc($result))
        {
        $numero_pro= $user_data['numero_pro'];
        $data_auto= $user_data['data_auto'];
        $data_aud= $user_data['data_aud'];
        $hora= $user_data['hora'];
        $cidade= $user_data['cidade'];
        $data_env= $user_data['data_env'];
        }
        
    }
    else{
        header ('Location: dashboard.php');
    }

    }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Pagina Inicial</title>
</head>

<body>
    <?php include_once('navLateral.html'); ?>
    <div class="container">
        <div class="main-cadastro">
            <form action="saveEdit.php" method="POST">
                <h1>FORMULARIO JURIDICO</h1>
                <br>
                <div class="input-box">
                    <label for="autor" class="label-input">AUTOR:</label>
                    <select name="autor" id="itens">
                     <option value=" " selected="selected">Escolha um autor:</option>
            <?php   while($elemento = mysqli_fetch_array($listaAutores))
                    {       
                            $iditem = $elemento['id'];
                            $nomeItem = $elemento['nome'];
                        echo '<option value="'.$iditem.'">'.$nomeItem.'</option>';
                    }?>
                    </select>
                </div>
                <br>
                <div class="input-box">
                    <label for="numero_pro" class="label-input">NÚMERO DO PROCESSO</label>
                    <input type="text" name="numero_pro" id="numero_pro" class="inputUser" value="<?php echo $numero_pro ?>" oninput="formatarCampo(this)" placeholder="0000000-00.0000.0.00.0000" required>

                </div>
                <br>
                <div class="input-box">
                    <label for="data_auto" class="label-input">DATA DA AUTUAÇÃO</label>
                    <input type="text" name="data_auto" id="data_auto" class="inputUser" value="<?php echo $data_auto ?>" oninput="formatarData(this)" placeholder="dd/mm/aaaa" required>

                </div>
                <br>
                <div class="input-box">
                    <label for="data_aud" class="label-input">DATA DA AUDIÊNCIA</label>
                    <input type="text" name="data_aud" id="data_aud" class="inputUser" value="<?php echo $data_aud ?>" oninput="formatarData(this)" placeholder="dd/mm/aaaa" required>

                </div>
                <br>
                <div class="input-box">
                    <label for="hora" class="label-input">HORA</label>
                    <input type="text" name="hora" id="hora" class="inputUser" value="<?php echo $hora ?>" placeholder="00:00" required>

                </div>
                <br>
                <div class="input-box">
                    <label for="cidade" class="label-input">CIDADE</label>
                    <input type="text" name="cidade" id="cidade" class="inputUser" value="<?php echo $cidade ?>" placeholder="CIDADE - UF" required>

                </div>
                <br>
                <div class="input-box">
                    <label for="data_env" class="label-input">DATA DE ENVIO POR E-MAIL</label>
                    <input type="text" name="data_env" id="data_env" class="inputUser" value="<?php echo $data_env ?>" oninput="formatarData(this)" placeholder="dd/mm/aaaa">
                </div>
                <br>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="submit" name="update" id="update" >

            </form>
        </div>
    </div>
   
    <script src="main.js"></script>
</body>

</html>