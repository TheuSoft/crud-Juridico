<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: index.php'); // Redireciona para a página de login se o usuário não estiver autenticado.
    exit;
}

include_once('config.php');
$logado = $_SESSION['email'];

// Processar o formulário de atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['new_name'];
    $newPassword = $_POST['new_password'];

    // Validação e sanitização de dados (faça as verificações necessárias aqui)

    // Atualize as informações do usuário no banco de dados
    $updateQuery = "UPDATE usuarios SET nome = '$newName', senha = '$newPassword' WHERE email = '$logado'";
    $result = mysqli_query($conexao, $updateQuery);

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
    <link rel="stylesheet" href="css/conta.css">
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
            <h1>Gerenciar Minha Conta</h1>
            <p>Bem-vindo, <?php echo $logado; ?>!</p>

            <form method="post" action="conta.php">
                <label for="new_name">Novo Nome:</label>
                <input type="text" name="new_name" onfocus="limparMensagem()" required><br>

                <label for="new_password">Nova Senha:</label>
                <input type="password" name="new_password" required><br>

                <input type="submit" name="submit" value="Atualizar">
            </form>

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