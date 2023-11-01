<?php
session_start();
$erro = "";

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $email = mysqli_real_escape_string($conexao, $email);
    $senha = mysqli_real_escape_string($conexao, $senha);

    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) < 1) {
        $erro = "Credenciais inválidas. Verifique seu email e senha.";
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <title>Login</title>
</head>

<body>
    <div class="main-login">
        <div class="left-login">
            <img src="img/team.svg" class="left-login-img" alt="team">
        </div>
        <div class="right-login">
            <div class="card-login">
                <h1>LOGIN</h1>

                <?php if (!empty($erro)) { ?>
                    <p class="error-message"><?php echo $erro; ?></p>
                <?php } ?>

                <?php if (isset($_SESSION['success_message'])) : ?>
                    <p class="success-message"><?php echo $_SESSION['success_message']; ?></p>
                    <?php unset($_SESSION['success_message']); // Limpa a variável de sessão 
                    ?>
                <?php endif; ?>

                <form action="index.php" method="POST">
                    <div class="textfield">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Email">
                    </div>

                    <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha" >
                        <i class="bi bi-eye-fill" id="btn-senha" onclick="mostrarSenha()"></i>
                    </div>

                    <input class="btn-login" type="submit" name="submit" value="Login">

                </form>

                <form action="cadastro.php">
                    <input class="btn-cadastro" type="submit" value="Cadastrar">
                </form>


            </div>
        </div>
    </div>

    <script src="main.js"></script>
</body>

</html>