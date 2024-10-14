<?php
require_once '../model/Orcamento.php';
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['acao']== "cadastrarOrcamento-cadastrar") {
    // Recebe os valores do formulário
    session_start();

    $usuarioId = intval($_SESSION['usuario_id']);
    $clienteId = intval($_POST['clienteId']);
    $equipamentoId = intval($_POST['equipamentoId']);

    // Arrays para armazenar os ids e quantidades de produtos e serviços
    //$produtoIds = $_POST['produtoId'];
    $produtoIds = array_map('intval', $_POST['produtoId']);
    $quantidadeProduto = array_map('intval', $_POST['quantidade-produto']);
    $produtosPrecoCobrado = array_map('floatval', $_POST['produtoIdPrecoCobrado']);

    // Inicializa um array para armazenar os produtos
    $produtos = [];

    // Verifica se os arrays têm o mesmo tamanho para evitar inconsistências
    if (count($produtoIds) === count($quantidadeProduto) && count($quantidadeProduto) === count($produtosPrecoCobrado)) {
        // Agrupa os dados em um único array de produtos
        for ($i = 0; $i < count($produtoIds); $i++) {
            $produtos[] = [
                'id' => $produtoIds[$i],
                'quantidade' => $quantidadeProduto[$i],
                'preco' => $produtosPrecoCobrado[$i]
            ];
        }
    } else {
        echo "Erro: Os arrays de produtos têm tamanhos diferentes.";
        exit;
    }

    $servicoIds = array_map('intval', $_POST['servicoId']);
    $quantidadeServico = array_map('intval', $_POST['quantidade-servico']);
    $servicosPrecoCobrado = array_map('floatval', $_POST['servicoIdPrecoCobrado']);

    // Inicializa o array de serviços
    $servicos = [];

    // Verifica se os arrays têm o mesmo tamanho
    if (count($servicoIds) === count($quantidadeServico) && count($quantidadeServico) === count($servicosPrecoCobrado)) {
        // Agrupa os dados em um array de serviços
        for ($i = 0; $i < count($servicoIds); $i++) {
            $servicos[] = [
                'id' => $servicoIds[$i],
                'quantidade' => $quantidadeServico[$i],
                'preco' => $servicosPrecoCobrado[$i]
            ];
        }
    } else {
        echo "Erro: Os arrays de serviços têm tamanhos diferentes.";
        exit;
    }

    $orcamentoId = inserirOrcamentoDB($clienteId, $equipamentoId, $usuarioId, $produtos, $servicos);
    //$orcamentoId = 78;
    //var_dump($orcamentoId);

    header('Content-Type: application/json; charset=utf-8');
    //$json = json_encode(['orcamentoId' => 12], JSON_UNESCAPED_UNICODE);
    $json = json_encode($orcamentoId, JSON_UNESCAPED_UNICODE);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'Erro ao codificar JSON: ' . json_last_error_msg()]);
    } else {
        echo $json;
    }


} else {
    echo "<p>Nenhum dado foi enviado.</p>";
}


?>
