<?php
require_once '../model/Equipamento.php';
function buscarEquipamentos($id_cliente){
    return buscarEquipamentoByIdDB($id_cliente);
}

//$equipamentos = []; // Inicializa como array vazio

if ($_POST['acao'] == 'buscarEquipamentosPorCliente'){
    $equipamentos = buscarEquipamentos($_POST['cliente_id']);
    //var_dump($equipamentos);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($equipamentos);
}
?>