<?php

session_start();

if (isset($_POST['submit'])) {
    // print_r($_POST['nome']);
    // print_r('<br>');
    // print_r($_POST['senha']);
    // print_r('<br>');
    // print_r($_POST['email']);
    // print_r('<br>');
    // print_r($_POST['telefone']);
    // print_r('<br>');
    // print_r($_POST['genero']);
    // print_r('<br>');
    // print_r($_POST['data_nascimento']);

    include_once('config.php');


    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $genero = $_POST['genero'];
    $data_nascimento = $_POST['data_nascimento'];

    $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,email,senha,telefone,sexo,data_nasc) VALUES ('$nome','$email','$senha','$telefone','$genero','$data_nascimento')");


    if ($result) {

        $_SESSION['success_message'] = "Cadastro com sucesso";


        header("Location: index.php");
        exit;
    }
}


?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Cadastro</title>
</head>

<body>
    <a href="index.php" id="voltar">Voltar</a>
    <div class="main-cadastro">
        <form action="cadastro.php" method="POST">
            <fieldset>
                <legend><b>Cadastro</legend></b>
                <br>
                <div class="input-box">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="label-input">Nome Completo</label>
                </div>
                <br><br>
                <div class="input-box">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="nome" class="label-input">Email</label>
                </div>
                <br><br>
                <div class="input-box" style="display:flex; flex-direction: row;">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="nome" class="label-input">Senha</label>
                    <i class="bi bi-eye-fill" id="btn-senha" onclick="mostrarSenha()"></i>
                    </input>
                </div>
                <br><br>
                <div class="input-box">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="label-input">Telefone</label>

                </div>
                <br>
                <p>Sexo:</p>
                <input type="radio" id="feminino" name="genero" value="feminino" required>
                <label for="feminino">Femino</label>
                <br>
                <input type="radio" id="masculino" name="genero" value="masculino" required>
                <label for="masculino">Masculino</label>
                <br>
                <input type="radio" id="outro" name="genero" value="outro" required>
                <label for="outro">Outro</label>
                <br><br>
                <label for="nome"><b>Data de Nascimento</b></label><br>
                <input type="date" name="data_nascimento" id="data_nascimento" required>

                <br><br>
                <input type="submit" name="submit" id="submit">

            </fieldset>
        </form>
    </div>
    <script src="main.js"></script>
</body>

</html>