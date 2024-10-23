<?php
// Inicia a sessão
session_start();

// Inclui o modelo de usuário
require_once '../model/usuario.php';
require_once '../model/Empresa.php';


// Função para receber e validar os dados do formulário
function receberDadosFormulario() {
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);
        $id_empresa = trim($_POST['id_empresa']);
        return [$email, $senha, $id_empresa];
    }
    return [null, null]; // Retorna null se o formulário não foi enviado
}

function coletarInformacoesEmpresa($id_empresa){
    // Busca os dados da empresa no banco de dados
    $empresa = buscarEmpresaDB($id_empresa);
    if ($empresa) {
        // Armazena os dados da empresa na sessão
        $_SESSION['empresa'] = $empresa;
        return true; // Dados armazenados com sucesso
    }
    return false; // Falha ao buscar ou armazenar os dados
}

// Função para processar o login
function processarLogin($email, $senha, $id_empresa) {
    
    if (strlen($senha) < 3) {
        $_SESSION['erro'] = "A senha deve ter no mínimo 3 caracteres.";
        header("Location: ../view/login.php");
        exit();
    }
    $usuario = verificarLogin($email, $senha);
    if ($usuario) {
        // O usuário foi encontrado e a senha está correta
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        coletarInformacoesEmpresa($id_empresa);
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
list($email, $senha, $id_empresa) = receberDadosFormulario();

// Processando o login
//$mensagemErro = processarLogin($email, $senha);
processarLogin($email, $senha, $id_empresa);

// Exibindo mensagem de erro se houver
if ($mensagemErro) {
    echo $mensagemErro . " <a href='../view/login.php'>Tente novamente</a>.";
}
?>
