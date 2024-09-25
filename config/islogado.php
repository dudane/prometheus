<?php
// Verifica se o usuário está logado
$valor='';
if (isset($_SESSION['usuario_id'])) {
    $valor = true;
}
if (!$valor){
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit(); // Certifique-se de que o script pare de executar aqui
}
?>