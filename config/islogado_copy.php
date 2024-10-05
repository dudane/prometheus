<?php
// Verifica se o usuário está logado
$islogado='';
if (isset($_SESSION['usuario_id'])) {
    $islogado = true;
}
if (!$islogado){
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit(); // Certifique-se de que o script pare de executar aqui
}
?>