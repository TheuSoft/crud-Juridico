<?php
session_start();
include_once('config_form.php');

if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: index.php');
} else {
    $logado = $_SESSION['email'];
}
if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM autores WHERE id LIKE '%$data%' or nome LIKE '%$data%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM autores ORDER BY id";
}
$result = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>DASHBOARD</title>
</head>

<body>
    <?php
    $pagina_atual = basename($_SERVER['PHP_SELF']); // Página atual

    // Agora você pode incluir o menu.html com o código HTML real do menu
    include_once('navLateral.html');
    ?>
    <div class="container">
        <div class="box-search">
            <input type="search" class="inputUser" placeholder="Pesquisar" id="pesquisar">
            <button onclick="searchData()" class="custom-button">
                <i class="bi bi-search"></i>
            </button>
        </div>
        <div class="main-cadastro">
            <a href="formulario_autor.php" class="btn-autor">Adicionar autor</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">AUTOR</th>
                        <th scope="col">EDITAR</th>
                        <th scope="col">EXCLUIR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $user_data['id'] . "</td>";
                        echo "<td>" . $user_data['nome'] . "</td>";
                        echo "<td>
        <a class='btn btn-primary' href='edit_autor.php?id={$user_data['id']}'>
            <i class='bi bi-pencil-fill'></i>
        </a>
    </td>";
                        echo "<td>
        <a class='btn btn-danger' href='delete_autor.php?id={$user_data['id']}'onclick='return confirmDelete();'>
        <i class='bi bi-trash'></i></i>
        </a>
    </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    <script>
        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                searchData();
            }
        });

        function searchData() {
            window.location = 'dashboard_autores.php?search=' + search.value;
        }
    </script>

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