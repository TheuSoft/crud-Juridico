<?php
session_start();
include_once('config_form.php');

if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: index.php');
} else {
    $logado = $_SESSION['email'];
}
if(!empty($_GET['search']))
{
    $data = $_GET['search'];
    $sql = "SELECT j.id,au.nome,j.numero_pro,j.data_auto,j.data_aud,j.hora,j.cidade,j.data_env FROM juridico j 
    join autores au on(au.id = j.autorId)
    wHERE j.id LIKE '%$data%' or au.nome LIKE '%$data%' or j.cidade LIKE '%$data%' 
    ORDER BY id DESC";
    
}
else{
    $sql = "SELECT j.id,au.nome,j.numero_pro,j.data_auto,j.data_aud,j.hora,j.cidade,j.data_env FROM juridico j join autores au on(au.id = j.autorId) ORDER BY id DESC ";
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
            <a href="formulario.php" class="btn-autor">Adicionar um processo</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">AUTOR</th>
                        <th scope="col">NÚMERO DO PROCESSO</th>
                        <th scope="col">DATA DA AUTUAÇÃO</th>
                        <th scope="col">DATA DA AUDIÊNCIA</th>
                        <th scope="col">HORA</th>
                        <th scope="col">CIDADE</th>
                        <th scope="col">DATA DE ENVIO POR E-MAIL</th>
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
    echo "<td>" . $user_data['numero_pro'] . "</td>";
    echo "<td>" . $user_data['data_auto'] . "</td>";
    echo "<td>" . $user_data['data_aud'] . "</td>";
    echo "<td>" . $user_data['hora'] . "</td>";
    echo "<td>" . $user_data['cidade'] . "</td>";
    echo "<td>" . $user_data['data_env'] . "</td>";
    echo "<td>
        <a class='btn btn-primary' href='edit.php?id={$user_data['id']}'>
            <i class='bi bi-pencil-fill'></i>
        </a>
    </td>";
    echo "<td>
        <a class='btn btn-danger' href='delete.php?id={$user_data['id']}'onclick='return confirmDelete();'>
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

        search.addEventListener("keydown", function(event){
            if (event.key==="Enter")
            {
                searchData();
            }
        });

        function searchData()
        {
            window.location = 'dashboard.php?search='+search.value;
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