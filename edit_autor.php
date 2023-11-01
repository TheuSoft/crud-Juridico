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

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM autores WHERE id=$id";

    $result = $conexao->query($sqlSelect);

    if($result->num_rows >0)
    {
        while($user_data = mysqli_fetch_assoc($result))
        {
        $autor= $user_data['nome'];

        }
        
    }
    else{
        header ('Location: dashboard_autores.php');
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
    <?php include_once('navLateral.html');?>
    <div class="container">
        <div class="main-cadastro">
            <form action="saveEdit_autor.php" method="POST">
                <h1>FORMULARIO JURIDICO</h1>
                <br>
                <div class="input-box">
                    <label for="autor" class="label-input">AUTOR</label>
                    <input type="text" name="autor" id="autor" class="inputUser" value="<?php echo $autor ?>" placeholder="NOME COMPLETO" required>
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