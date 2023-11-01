<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: index.php');
} else {
    $logado = $_SESSION['email'];
}
?>

<?php
if (isset($_POST['submit'])) {

    include_once('config_form.php');

    $autor = $_POST['autor'];


    $result = mysqli_query($conexao, "INSERT INTO autores(nome) VALUES ('$autor')");

    if ($result) {
        $mensagem = "Enviado com sucesso!";
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

    <script>
        function limparMensagem() {
            var mensagem = document.getElementById('mensagem-envio');
            mensagem.style.opacity = 0;
            setTimeout(function () {
                mensagem.style.display = 'none';
            }, 1000); // Tempo da transição em milissegundos (0.5 segundos)
        }
    </script>
</head>

<body>
<?php
    $pagina_atual = basename($_SERVER['PHP_SELF']); // Página atual

    // Agora você pode incluir o menu.html com o código HTML real do menu
    include_once('navLateral.html');
    ?>
    <div class="container">
        <div class="main-cadastro">
        <div id="mensagem-envio" style="display: <?php echo isset($mensagem) ? 'block' : 'none'; ?>;">
                <?php echo $mensagem; ?>
            </div>
            <form action="formulario_autor.php" method="POST" id="meuForm">
                <h1>FORMULARIO AUTORES</h1>
                <br><br>
                <div class="input-box">
                    <label for="autor" class="label-input">NOME DO AUTOR:</label>
                    <input type="text" name="autor" id="autor" class="inputUser" placeholder="NOME COMPLETO" required pattern=".{5,}"  onfocus="limparMensagem()">
                </div>
                <input type="submit" name="submit" id="submit" >
            </form>
        </div>
    </div>
    
    <script src="main.js"></script>
</body>

</html>