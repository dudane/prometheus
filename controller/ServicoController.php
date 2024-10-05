<?php
require_once '../model/Servico.php';
function buscarServicoPelaDescricao($servico_descricao){
    return buscarServicosByDescricaoDB($servico_descricao);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao']) && $_POST['acao']=="cadastrarOrcamento-buscarServico"){
    $produtos = buscarServicoPelaDescricao($_POST['servico_descricao']);
    $json = json_encode($produtos, JSON_UNESCAPED_UNICODE);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'Erro ao codificar JSON: ' . json_last_error_msg()]);
    } else {
        echo $json;
    }
}
?>