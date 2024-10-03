<?php
require_once '../model/Produto.php';
function buscarProdutoPeloNome($produto_nome){
    return buscarProdutosByNomeDB($produto_nome);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao']) && $_POST['acao']=="cadastrarOrcamento-buscarProduto"){
    $produtos = buscarProdutoPeloNome($_POST['produto_nome']);
   // header('Content-Type: application/json; charset=UTF-8');
    $json = json_encode($produtos, JSON_UNESCAPED_UNICODE);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'Erro ao codificar JSON: ' . json_last_error_msg()]);
    } else {
        echo $json;
    }
/*
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($produtos, JSON_UNESCAPED_UNICODE);*/
}
?>