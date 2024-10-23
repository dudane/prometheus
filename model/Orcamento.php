<?php
// Inclui o arquivo de configuração do banco de dados
require_once '../config/database.php';

// Função para inserir os registros com controle de transações
function inserirOrcamentoDB($clienteId, $equipamentoId, $usuarioId, $produtos, $servicos) {
    // Conectar ao banco de dados
    $conn = conectarBanco();
    $orcamentoId = 0;

    try {
        // Iniciar a transação
        $conn->begin_transaction();

        // Inserir o orçamento
        //(status_id Ex.: "Pendente", "Aprovado", "Recusado", "DIRETO-SEM ORCAMENTO PREVIO").
        $stmtOrcamento = $conn->prepare("INSERT INTO orcamento (cliente_id, equipamento_id, status_id, usuario_id, data_criacao) VALUES (?, ?, 1, ?, NOW())");
        $stmtOrcamento->bind_param("iii", $clienteId, $equipamentoId, $usuarioId);
        $stmtOrcamento->execute();

        if ($stmtOrcamento->error) {
            throw new Exception("Erro ao inserir orçamento: " . $stmtOrcamento->error);
        }

        // Obter o ID do orçamento inserido
        $orcamentoId = $stmtOrcamento->insert_id;

        foreach ($produtos as $produto) {
            $produtoId = $produto['id'];
            $preco = $produto['preco'];
            $quantidade = $produto['quantidade']; // Quantidade do produto

            // Inserir o produto no orçamento o número de vezes correspondente à quantidade
            for ($i = 0; $i < $quantidade; $i++) {
                $stmtProduto = $conn->prepare(
                    "INSERT INTO orcamento_produto (orcamento_id, produto_id, preco_cobrado) VALUES (?, ?, ?)"
                );
                $stmtProduto->bind_param("iid", $orcamentoId, $produtoId, $preco);
                $stmtProduto->execute();

                if ($stmtProduto->error) {
                    throw new Exception("Erro ao inserir produto no orçamento: " . $stmtProduto->error);
                }
            }

            // Opcional: Soma total do orçamento (se necessário)
            // $totalOrcamento += $quantidade * $preco;
        }
        /*
        foreach ($servicos as $servico) {
            // Inserir os serviços no orçamento
            $stmtServico = $conn->prepare("INSERT INTO orcamento_servico (orcamento_id, servico_id, preco_cobrado) VALUES (?, ?, ?)");
            $servicoId = $servico['id'];
            $preco = $servico['preco'];
            $stmtServico->bind_param("iid", $orcamentoId, $servicoId, $preco);
            $stmtServico->execute();

            if ($stmtServico->error) {
                throw new Exception("Erro ao inserir serviço no orçamento: " . $stmtServico->error);
            }

            // Somar o total do orçamento
           //$totalOrcamento += $preco;
        }*/
        foreach ($servicos as $servico) {
            $servicoId = $servico['id'];
            $preco = $servico['preco'];
            $quantidade = $servico['quantidade']; // Quantidade do produto

            // Inserir o servico no orçamento o número de vezes correspondente à quantidade
            for ($i = 0; $i < $quantidade; $i++) {
                $stmtServico = $conn->prepare(
                    "INSERT INTO orcamento_servico (orcamento_id, servico_id, preco_cobrado) VALUES (?, ?, ?)"
                );
                $stmtServico->bind_param("iid", $orcamentoId, $servicoId, $preco);
                $stmtServico->execute();

                if ($stmtServico->error) {
                    throw new Exception("Erro ao inserir produto no orçamento: " . $stmtProduto->error);
                }
            }

            // Opcional: Soma total do orçamento (se necessário)
            // $totalOrcamento += $quantidade * $preco;
        }

        /*
        // Atualizar o total no orçamento
        $stmtUpdateTotal = $conn->prepare("UPDATE orcamento SET total = ? WHERE id = ?");
        $stmtUpdateTotal->bind_param("di", $totalOrcamento, $orcamentoId);
        $stmtUpdateTotal->execute();

        if ($stmtUpdateTotal->error) {
            throw new Exception("Erro ao atualizar o total do orçamento: " . $stmtUpdateTotal->error);
        }
        */

        // Se tudo deu certo, fazer commit da transação
        $conn->commit();

        // echo "Orçamento e itens inseridos com sucesso. ID do orçamento: $orcamentoId";
    } catch (Exception $e) {
        // Em caso de erro, fazer rollback
        $conn->rollback();
        //    echo "Falha ao inserir os dados: " . $e->getMessage();
    } finally {
        // Fechar a conexão e os statements
        $stmtOrcamento->close();
        $stmtProduto->close();
        $stmtServico->close();
        //$stmtUpdateTotal->close();
        $conn->close();
        return $orcamentoId;
    }
}

function buscarOrcamentoDB($codigo_orcamento, $nome_cliente, $data_inicio, $data_fim)
{
    // Conecta ao banco de dados
    $conn = conectarBanco();
    // Prepara a consulta SQL
    $sql = "select
                    o.id as codigo_orcamento,
                    o.cliente_id AS codigo_cliente,
                    c.nome AS nome_cliente,
                    e.marca AS equipamento_marca,
                    e.modelo AS equipamento_modelo,
                    e.identificacao AS equipamento_identificacao,
                    DATE_FORMAT(o.data_criacao, '%d-%m-%Y') AS data_criacao,  -- Formata a data
                    o.data_agendamento,
                    o.turno_agendamento,
                    o.status_id,
                    so.descricao AS orcamento_status,
                    IFNULL(p.total_pecas, 0) AS total_pecas,
                    IFNULL(s.total_servicos, 0) AS total_servicos,
                    (IFNULL(p.total_pecas, 0) + IFNULL(s.total_servicos, 0)) AS valor_total
                FROM 
                    orcamento o
                LEFT JOIN (
                    SELECT 
                        orcamento_id, 
                        SUM(preco_cobrado) AS total_pecas
                    FROM 
                        orcamento_produto
                    GROUP BY 
                        orcamento_id
                ) p ON o.id = p.orcamento_id
                LEFT JOIN (
                    SELECT 
                        orcamento_id, 
                        SUM(preco_cobrado) AS total_servicos
                    FROM 
                        orcamento_servico
                    GROUP BY 
                        orcamento_id
                ) s ON o.id = s.orcamento_id
                
                LEFT JOIN 	
                    cliente c on o.cliente_id = c.id
                LEFT JOIN
                    equipamento e on c.id = e.cliente_id 
                LEFT JOIN 
                    status_orcamento so on so.id = o.status_id 
                WHERE 1=1"; // Condição inicial verdadeira para facilitar a adição de filtros

    // Array para armazenar parâmetros dinamicamente
    $params = [];
    $types = ''; // Armazena os tipos dos parâmetros (s: string, i: int)

    // Adiciona os filtros dinamicamente se os parâmetros forem fornecidos
    if ($codigo_orcamento !== '') {
        $sql .= " AND o.id = ?";
        $params[] = $codigo_orcamento;
        $types .= 'i';
    }

    if ($nome_cliente  !== '') {
        $sql .= " AND c.nome LIKE ?";
        $params[] = "%$nome_cliente%";
        $types .= 's';
    }

    if ($data_inicio !== '' && $data_fim !== '') {
        $sql .= " AND o.data_criacao BETWEEN ? AND ?";
        $params[] = "$data_inicio 00:00:00";
        $params[] = "$data_fim 23:59:59";
        $types .= 'ss';
    }

    // Prepara a consulta SQL
    $stmt = $conn->prepare($sql);

    // Verifica se há parâmetros para serem vinculados
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $orcamentos = [];
        while ($orcamento = $result->fetch_assoc()) {
            $orcamentos[] = $orcamento; // Armazena todos os clientes encontrados
        }
        return $orcamentos; // Retorna os dados dos clientes
    }
    return false; // Usuário não encontrado ou senha incorreta

}

function buscarOrcamentoDetalhadoDB($orcamento_id) {
    $conn = conectarBanco();

    // Consulta principal do orçamento
    $sql = "SELECT 
                o.id, 
                o.cliente_id, 
                c.nome,
                c.cpf_cnpj ,
                c.telefone ,
                
                o.equipamento_id,
                e.marca,
                e.modelo,
                e.cor,
                e.identificacao,
                e.ano_fabricacao,
                o.status_id, 
                so.descricao as status_orcamento,
                o.usuario_id, 
                 o.data_agendamento,
                    o.turno_agendamento,
                    o.status_id,
                DATE_FORMAT(o.data_criacao, '%d-%m-%Y') AS data_criacao,
                DATE_FORMAT(o.data_aprovacao, '%d-%m-%Y') AS data_aprovacao,
                DATE_FORMAT(o.data_validade, '%d-%m-%Y') AS data_validade
            FROM orcamento o
            inner join cliente c on (c.id = o.cliente_id)
            inner join equipamento e on (e.id = o.equipamento_id) 
            inner join status_orcamento so on (so.id = o.status_id)
            WHERE o.id = ?;";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orcamento_id);
    $stmt->execute();
    $result = $stmt->get_result();
    //echo "numero de linhas orcamento: ".$result->num_rows;
    if ($result->num_rows === 0) {
        return false; // Nenhum orçamento encontrado
    }

    $orcamento = $result->fetch_assoc();
    // Buscar produtos do orçamento
    $sql_produtos = "SELECT 
                        p.id AS produto_id, 
                        p.nome AS produto_nome, 
                        op.preco_cobrado 
                    FROM orcamento_produto op
                    JOIN produto p ON op.produto_id = p.id
                    WHERE op.orcamento_id = ?;";

    $stmt_produtos = $conn->prepare($sql_produtos);
    $stmt_produtos->bind_param("i", $orcamento_id);
    $stmt_produtos->execute();
    $result_produtos = $stmt_produtos->get_result();

    $produtos = [];
    while ($produto = $result_produtos->fetch_assoc()) {
        $produtos[] = $produto;
    }

    // Buscar serviços do orçamento
    $sql_servicos = "SELECT 
                        s.id AS servico_id, 
                        s.descricao AS servico_nome, 
                        os.preco_cobrado 
                    FROM orcamento_servico os
                    JOIN servico s ON os.servico_id = s.id
                    WHERE os.orcamento_id = ?;";

    $stmt_servicos = $conn->prepare($sql_servicos);
    $stmt_servicos->bind_param("i", $orcamento_id);
    $stmt_servicos->execute();
    $result_servicos = $stmt_servicos->get_result();

    $servicos = [];
    while ($servico = $result_servicos->fetch_assoc()) {
        $servicos[] = $servico;
    }

    // Adiciona os produtos e serviços ao orçamento
    $orcamento['produtos'] = $produtos;
    $orcamento['servicos'] = $servicos;

    return $orcamento; // Retorna o orçamento completo
}

function autorizarOrcamentoDb($id_orcamento, $data_agendamento, $turno_agendamento)
{
    $conn = conectarBanco();
    try {
        // Iniciar a transação
        $conn->begin_transaction();

        $stmtUpdateOrcamento = $conn->prepare(
            "UPDATE orcamento 
             SET status_id=2, data_aprovacao=now(), turno_agendamento=?, data_agendamento=? 
             WHERE id=?;");

        $stmtUpdateOrcamento->bind_param("ssi", $turno_agendamento, $data_agendamento, $id_orcamento);
        //debugQuery($query, [$turno_agendamento, $data_agendamento, $id_orcamento]);
        $stmtUpdateOrcamento->execute();

        // Verifica se a execução foi bem-sucedida e se houve uma linha afetada
        if ($stmtUpdateOrcamento->affected_rows === 0) {
            throw new Exception("Nenhuma linha foi atualizada. Verifique o ID ou os dados.");
        }

        if ($stmtUpdateOrcamento->error) {
            throw new Exception("Erro ao atualizar o orçamento: " . $stmtUpdateOrcamento->error);
        }

        // Se tudo deu certo, fazer commit da transação
        $conn->commit();
        return ['successo' => true, 'mensagem' => 'Orçamento autorizado com sucesso'];

    } catch (Exception $e) {
        // Em caso de erro, fazer rollback
        $conn->rollback();
        return ['successo' => false, 'mensagem' => 'Erro: ' . $e->getMessage()];
    } finally {
        // Fechar a conexão e os statements
        $stmtUpdateOrcamento->close();
        $conn->close();
    }
}

function debugQuery($query, $params) {
    foreach ($params as $param) {
        $query = preg_replace('/\?/', "'$param'", $query, 1);
    }
    echo "Query executada: $query";
}


// Exemplo de uso da função
$clienteId = 1; // ID do cliente
$equipamentoId = 1; // ID do equipamento
$usuarioId = 1; // ID do usuário

// Produtos (id, quantidade, preco)
$produtos = [
    ['id' => 1, 'quantidade' => 2, 'preco' => 50.00],
    ['id' => 3, 'quantidade' => 1, 'preco' => 75.00]
];

// Serviços (id, preco)
$servicos = [
    ['id' => 1, 'preco' => 100.00],
    ['id' => 2, 'preco' => 200.00]
];

// Chamar a função para inserir o orçamento
//inserirOrcamentoDB($clienteId, $equipamentoId, $usuarioId, $produtos, $servicos);

?>
