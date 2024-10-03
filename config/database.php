<?php
// config/database.php

$servername = "localhost"; // Nome do servidor
$username = "root"; // Nome do usuário
$password = ""; // Senha do usuário
$dbname = "AutoMaster"; // Nome do banco de dados

// Função para conectar ao banco de dados
function conectarBanco() {
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Definindo o charset para UTF-8
    if (!$conn->set_charset("utf8")) {
        die("Erro ao definir o charset UTF-8: " . $conn->error);
    }

    return $conn;
}
?>
