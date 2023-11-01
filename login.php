<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validar e sanitizar os dados recebidos, por exemplo:
    $email = mysqli_real_escape_string($conexao, $email);
    $senha = mysqli_real_escape_string($conexao, $senha);

    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: index.php');
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: login.php');
    }
} else {

    if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: index.php');
    }

    $logado = $_SESSION['email'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Pagina Inicial</title>
</head>

<body>
    <?php
    $pagina_atual = basename($_SERVER['PHP_SELF']); // Página atual

    // Agora você pode incluir o menu.html com o código HTML real do menu
    include_once('navLateral.html');
    ?>


    <div class="container">
        <div class="bem-vindo">
            <?php if (isset($logado) && !empty($logado)) : ?>
                <h1>Bem-vindo, <?php echo $logado; ?>!</h1>
            <?php endif; ?>
            <!-- Resto do seu conteúdo aqui -->
        </div>
        <div class="main-cadastro">
        <img src="img/bemvindo.svg" class="left-login-img" alt="team">
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var menuItems = document.querySelectorAll('.item-menu');
                menuItems.forEach(function(item) {
                    if (item.querySelector('a').getAttribute('href') === '<?php echo $pagina_atual; ?>') {
                        item.classList.add('ativo');
                    }
                });
            });
        </script>



        <script src="main.js"></script>
</body>

</html>