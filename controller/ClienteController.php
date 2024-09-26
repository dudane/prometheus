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
    /*if (strlen($nome) < 3) {
        $_SESSION['erro'] = "A senha deve ter no mínimo 3 caracteres.";
        header("Location: ../view/index.php");
        exit();
    }*/
  //  echo "<script>alert('chegou aqui 1".$nome."');</script>";//$nome;
    $clientes = buscarClienteDB($nome);
    if ($clientes) {
        // O usuário foi encontrado e a senha está correta
        $_SESSION['clientes'] = $clientes; 
        // header("Location: " . $_SERVER['PHP_SELF']);
        header("Location: ../view/index.php");
        exit();
    } else {
        /*
        // Usuário ou senha incorretos - armazena na sessão
        $_SESSION['erro'] = "E-mail ou senha incorretos.";
        
        // Redireciona de volta para a página de login
        */
        
        header("Location: ../view/index.php");
        exit();
    }
}



// Recebendo os dados do formulário
//list($nome) = receberDadosFormulario();

// Processando o login
//$mensagemErro = processarLogin($email, $senha);
buscarClientes($_POST['busca']);

// Exibindo mensagem de erro se houver
/*if ($mensagemErro) {
    echo $mensagemErro . " <a href='../views/login.php'>Tente novamente</a>.";
}*/
?>
