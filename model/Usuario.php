<?php
// models/usuario.php

require_once '../config/database.php';

// Função para verificar o login do usuário
function verificarLogin($email, $senha) {
    // Conecta ao banco de dados
    $conn = conectarBanco();

    // Prepara a consulta SQL
    $sql = "SELECT * FROM usuario WHERE email = '$email' and senha = '$senha'";  
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    // Verifica se o usuário e senha estão corretos
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        return $usuario; // Retorna os dados do usuário       
    }
   return false; // Usuário não encontrado ou senha incorreta
    
}
?>
