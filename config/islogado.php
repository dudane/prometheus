<?php
//session_start(); // Inicia ou retoma a sessão existente

// Define o tempo limite da sessão (15 minutos)
$tempo_limite = 15 * 60; // 15 minutos em segundos

// Verifica se o timestamp da última atividade está definido
if (isset($_SESSION['ultima_atividade'])) {
    // Calcula o tempo de inatividade
    $tempo_inatividade = time() - $_SESSION['ultima_atividade'];

    // Se o tempo de inatividade for maior que o limite, destruir a sessão e redirecionar
    if ($tempo_inatividade > $tempo_limite) {
        session_unset(); // Remove todas as variáveis da sessão
        session_destroy(); // Destroi a sessão

        // Redireciona para a página de login
        header("Location: login.php");
        exit();
    }
}

// Atualiza o timestamp da última atividade
$_SESSION['ultima_atividade'] = time();

// Verifica se o usuário está logado
$islogado = false;
if (isset($_SESSION['usuario_id'])) {
    $islogado = true;
}

if (!$islogado) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit(); // Certifique-se de que o script pare de executar aqui
}
?>
