<?php


require_once '../config/database.php';

function buscarProdutosByNomeDB($nome)
{
// Conecta ao banco de dados
    $conn = conectarBanco();

    // Prepara a consulta SQL
    $sql = "SELECT  id,
                    nome,
                    modelo_tipo,
                    marca,
                    preco_compra,
                    preco_venda,
                    quantidade_estoque
                FROM produto
                WHERE nome LIKE '%$nome%';";

    //echo $sql;

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $produtos = [];
        while ($produto = $result->fetch_assoc()) {
            $produtos[] = $produto; // Armazena todos os produtos encontrados
        }
       // header('Content-Type: application/json; charset=UTF-8');
       // echo json_encode($produtos, JSON_UNESCAPED_UNICODE);
        /*$produtos = array_map(function($produto) {
            return array_map('mb_convert_encoding', $produto);
        }, $produtos);*/
        return $produtos; // Retorna os dados dos produtos
    }
    return false; // produto não encontrado

}

// Outros métodos para manipulação de clientes podem ser adicionados aqui

?>