<?php

require_once '../config/database.php';

function buscarEquipamentoByIdDB($idEquipamento){
// Conecta ao banco de dados
    $conn = conectarBanco();

    // Prepara a consulta SQL
    $sql = "SELECT e.id, e.marca, e.modelo, 
                   e.ano_fabricacao, e.identificacao, e.numero_serie, 
                   e.cor, e.uso_horas_km, te.descricao AS tipo_equipamento
                FROM equipamento e
                JOIN tipo_equipamento te ON e.tipo_equipamento_id = te.id
                WHERE e.cliente_id = $idEquipamento;";

    //secho $sql;

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $equipamentos = [];
        while ($equipamento = $result->fetch_assoc()) {
            $equipamentos[] = $equipamento; // Armazena todos os equipamentos encontrados
        }
        return $equipamentos; // Retorna os dados dos equipamentos
    }
    return false; // Usuário não encontrado ou senha incorreta

}

// Outros métodos para manipulação de clientes podem ser adicionados aqui
?>