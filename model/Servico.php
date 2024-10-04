<?php
require_once '../config/database.php';
/**
 * @param $descricao
 * @return array|false
 */
function buscarServicosByDescricaoDB($descricao)
{
// Conecta ao banco de dados
    $conn = conectarBanco();
    // Prepara a consulta SQL
    $sql = "SELECT  id, 
                    descricao, 
                    preco 
            FROM servico 
             WHERE descricao LIKE '%$descricao%'";
    //var_dump($sql);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $servicos = [];
        while ($servico = $result->fetch_assoc()) {
            $servicos[] = $servico; // Armazena todos os servicos encontrados
        }
        return $servicos; // Retorna os dados dos servicos
    }
    return false; // servico não encontrado
}
// Outros métodos para manipulação de clientes podem ser adicionados aqui
?>