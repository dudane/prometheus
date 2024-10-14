<?php
// models/usuario.php

require_once '../config/database.php';

    function buscarClienteDB($nome) {
        // Conecta ao banco de dados
        $conn = conectarBanco();
    
        // Prepara a consulta SQL
        //$sql = "SELECT * FROM cliente WHERE nome LIKE '%$nome%';";
        $sql = "SELECT id,
                        nome,
                        cpf_cnpj,
                        telefone,
                        email,
                        endereco
                FROM cliente
                WHERE nome LIKE '%$nome%'
                order by nome
                ;";

       // echo $sql;
       // exit;

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $clientes = [];
            while ($cliente = $result->fetch_assoc()) {
                $clientes[] = $cliente; // Armazena todos os clientes encontrados
            }
            return $clientes; // Retorna os dados dos clientes 
        }
       return false; // Usuário não encontrado ou senha incorreta
        
    }
     // Outros métodos para manipulação de clientes podem ser adicionados aqui
?>
