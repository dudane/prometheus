<?php
// Inicia a sessão
session_start();

// Inclui o modelo de usuário
require_once '../model/usuario.php';

// Função para receber e validar os dados do formulário
function receberDadosFormulario() {
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);
        return [$email, $senha];
    }
    return [null, null]; // Retorna null se o formulário não foi enviado
}

// Função para processar o login
function processarLogin($email, $senha) {
    $usuario = verificarLogin($email, $senha);
    if ($usuario) {
        // O usuário foi encontrado e a senha está correta
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        
        // Redireciona para a página do painel ou dashboard
        header("Location: ../view/index.php");
        exit();
    } else {
        // Usuário ou senha incorretos - armazena na sessão
        $_SESSION['erro'] = "E-mail ou senha incorretos.";
        
        // Redireciona de volta para a página de login
        header("Location: ../view/login.php");
        exit();
    }
}



// Recebendo os dados do formulário
list($email, $senha) = receberDadosFormulario();

// Processando o login
//$mensagemErro = processarLogin($email, $senha);
processarLogin($email, $senha);

// Exibindo mensagem de erro se houver
if ($mensagemErro) {
    echo $mensagemErro . " <a href='../views/login.php'>Tente novamente</a>.";
}
?>
