<?php
session_start();
session_destroy(); // Destroi todas as informações da sessão

header("Location: index.php"); // Redireciona para a página de login (index.php) após o logout
exit;
?>