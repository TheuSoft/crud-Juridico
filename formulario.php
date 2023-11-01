<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: index.php');
} else {
    $logado = $_SESSION['email'];
}
?>

<?php

include_once('config_form.php');
$sql = "SELECT id,nome FROM autores ORDER BY id";
$listaAutores = mysqli_query($conexao,$sql);
if (mysqli_num_rows($listaAutores)==0){
    header ('Location: formulario_autor.php');
}

if (isset($_POST['submit'])) {
    // print_r($_POST['autor']);
    // print_r($_POST['numero_pro']);
    // print_r($_POST['data_auto']);
    // print_r($_POST['data_aud']);
    // print_r($_POST['hora']);
    // print_r($_POST['cidade']);
    // print_r($_POST['data_env']);
    include_once('config_form.php');

    $autor = $_POST['autor'];
    $numero_pro = $_POST['numero_pro'];
    $data_auto = $_POST['data_auto'];
    $data_aud = $_POST['data_aud'];
    $hora = $_POST['hora'];
    $cidade = $_POST['cidade'];
    $data_env = $_POST['data_env'];

    $result = mysqli_query($conexao, "INSERT INTO juridico(autorId,numero_pro,data_auto,data_aud,hora,cidade,data_env)
     VALUES ('$autor','$numero_pro','$data_auto','$data_aud','$hora','$cidade','$data_env')");

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
            <form action="formulario.php" method="POST" id="meuForm">
            <div id="mensagem-envio" style="display: <?php echo isset($mensagem) ? 'block' : 'none'; ?>;">
                <?php echo $mensagem; ?>
            </div>
                <h1>FORMULARIO JURIDICO</h1>
                <br><br>
                <div class="input-box">
                    <label for="autor" class="label-input">AUTOR:</label>
                    <select name="autor" id="itens" onchange="limparMensagem()">
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
                    <label for="numero_pro" class="label-input">NÚMERO DO PROCESSO:</label>
                    <input type="text" name="numero_pro" id="numero_pro" class="inputUser" oninput="formatarCampo(this)" placeholder="0000000-00.0000.0.00.0000" required>

                </div>
                <br>
                <div class="input-box">
                    <label for="data_auto" class="label-input">DATA DA AUTUAÇÃO:</label>
                    <input type="text" name="data_auto" id="data_auto" class="inputUser" oninput="formatarData(this)" placeholder="dd/mm/aaaa" required>

                </div>
                <br>
                <div class="input-box">
                    <label for="data_aud" class="label-input">DATA DA AUDIÊNCIA:</label>
                    <input type="text" name="data_aud" id="data_aud" class="inputUser" oninput="formatarData(this)" placeholder="dd/mm/aaaa" required>

                </div>
                <br>
                <div class="input-box">
                    <label for="hora" class="label-input">HORA:</label>
                    <input type="text" name="hora" id="hora" class="inputUser" placeholder="00:00" required>

                </div>
                <br>
                <div class="input-box">
                    <label for="cidade" class="label-input">CIDADE:</label>
                    <input type="text" name="cidade" id="cidade" class="inputUser" placeholder="CIDADE - UF" required>

                </div>
                <br>
                <div class="input-box">
                    <label for="data_env" class="label-input">DATA DE ENVIO POR E-MAIL:</label>
                    <input type="text" name="data_env" id="data_env" class="inputUser" oninput="formatarData(this)" placeholder="dd/mm/aaaa">
                </div>
                <br>
                <input type="submit" name="submit" id="submit">

            </form>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>