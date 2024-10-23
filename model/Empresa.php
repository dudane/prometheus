<?php
require_once '../config/database.php';

// Função para verificar o login do usuário
function buscarEmpresaDB($id_empresa) {
    // Conecta ao banco de dados
    $conn = conectarBanco();

    // Prepara a consulta SQL
    $sql = "SELECT 
            id, nome, cnpj, cpf, email, 
            telefone, endereco, cidade, 
            estado, cep, logo, inscricao_estadual, inscricao_municipal
            FROM empresa where id=$id_empresa;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    // Verifica se o usuário e senha estão corretos
    if ($result->num_rows > 0) {
        $empresa = $result->fetch_assoc();
        return $empresa; // Retorna os dados do usuário
    }
    return false; // Usuário não encontrado ou senha incorreta

}
?>
