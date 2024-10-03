<?php
// Inicia a sessão
session_start();
// Inclui o modelo de usuário
require_once '../model/Cliente.php';
/*
// Função para receber e validar os dados do formulário
function receberDadosFormulario() {
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $busca = trim($_POST['busca']);
        return $busca;
    }
    return null; // Retorna null se o formulário não foi enviado
}
*/
// Função para processar o login
function buscarClientes($nome) {
    /*
    if (strlen($nome) < 3){
        $_SESSION['erro'] = "A busca deve ter no mínimo 3 caracteres.";
        header("Location: ../view/index.php");
        exit();
    }*/
   // $nome = utf8_encode($nome);
    $clientes = buscarClienteDB($nome);
    if ($clientes) {
        // O usuário foi encontrado e a senha está correta
        $_SESSION['clientes'] = $clientes; 
        header("Location: ../view/buscarClientes.php");
        exit();
    } else {
        // Usuário ou senha incorretos - armazena na sessão
        // $_SESSION['erro'] = "E-mail ou senha incorretos.";
        // Redireciona de volta para a página de login
        header("Location: ../view/buscarClientes.php");
        exit();
    }
}

function buscarClienteOrcamento($nome) {
    //echo "<script>alert('entrou aqui 9:  ".$_POST['acao']."');</script>";
    //exit;
    // Exemplo: Obter clientes a partir de um modelo fictício Cliente
    $clientes = buscarClienteDB($nome);

    if (!empty($clientes)) {
        echo "<div class='card shadow mb-4'>";
        echo "<div class='card-header py-3'>";
        //echo "<h6 class='m-0 font-weight-bold text-primary'>Clientes</h6>";
        echo "</div>";
        echo "<div class='card-body'>";
        echo "<div class='table-responsive' >";



        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nome</th>";
        echo "<th>CPF</th>";
        echo "<th>Telefone</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($clientes as $cliente) {
            echo "<tr>";
            echo "<td><input type='radio' name='cliente_selecionado' value='" . $cliente['id'] . "'> " . $cliente['nome'] . "</td>";
            echo "<td>" . $cliente['cpf_cnpj'] . "</td>";
            echo "<td>" . $cliente['telefone'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<p>Nenhum cliente encontrado.</p>";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao']) && $_POST['acao']=="buscarClientes-buscarClientes"){
    buscarClientes($_POST['busca']);
}elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao']) && $_POST['acao'] == 'cadastrarOrcamento-buscarClienteOrcamento') {
    $nome = trim($_POST['nome']);
    buscarClienteOrcamento($nome);
}
?>
