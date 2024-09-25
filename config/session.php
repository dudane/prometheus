<?php
session_start();

// Defina o tempo limite em segundos (ex: 15 minutos)
$timeout_duration = 30; // 15 minutos

// Verifique se a variável de sessão para a última atividade está definida
if (isset($_SESSION['LAST_ACTIVITY'])) {
    // Calcule o tempo decorrido desde a última atividade
    $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];

    // Se o tempo decorrido ultrapassou o tempo limite, encerre a sessão
    if ($elapsed_time > $timeout_duration) {
        session_unset();     // Limpa as variáveis de sessão
        session_destroy();    // Destrói a sessão
        header("Location: login.php"); // Redireciona para a página de login ou outra
        exit();
    }
}

// Atualize a hora da última atividade
$_SESSION['LAST_ACTIVITY'] = time();
?>
