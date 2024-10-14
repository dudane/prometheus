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

$sql = "SELECT 
    o.id AS orcamento_id,
    o.data_criacao,
    o.total,
    c.nome AS cliente_nome,
    e.modelo AS equipamento_modelo,
    s_orcamento.descricao AS status_orcamento,
    u.nome AS usuario_criacao,

    op.produto_id,
    p.nome AS produto_nome,
    op.quantidade AS quantidade_produto,
    op.preco AS preco_produto,

    os.servico_id,
    sv.descricao AS servico_nome,
    -- sv.quantidade AS quantidade_servico,
    os.preco AS preco_servico

FROM 
    orcamento o

-- Join para trazer o cliente e equipamento
LEFT JOIN cliente c ON o.cliente_id = c.id
LEFT JOIN equipamento e ON o.equipamento_id = e.id
LEFT JOIN status_orcamento s_orcamento ON o.status_id = s_orcamento.id

-- Join para trazer o usuário que criou o orçamento
LEFT JOIN usuario u ON o.usuario_id = u.id

-- Join para trazer produtos e serviços relacionados ao orçamento
LEFT JOIN orcamento_produto op ON o.id = op.orcamento_id
LEFT JOIN produto p ON op.produto_id = p.id

LEFT JOIN orcamento_servico os ON o.id = os.orcamento_id
LEFT JOIN servico sv ON os.servico_id = sv.id

ORDER BY o.id;
";

?>
