<?php
require_once '../model/Usuario.php';

class AuthController {
    private $usuarioModelo;

    public function __construct($db) {
        $this->usuarioModelo = new Usuario($db);
    }

    public function login($email, $senha) {
        $usuario = $this->usuarioModelo->validarUsuario($email, $senha);
        if ($usuario) {
            // Iniciar sessão e redirecionar para o dashboard
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            header("Location: ../visao/dashboard.php");
            exit();
        } else {
            return "Credenciais inválidas.";
        }
    }

    public function redefinirSenha($email, $novaSenha) {
        $this->usuarioModelo->redefinirSenha($email, $novaSenha);
        return "Senha alterada com sucesso.";
    }
}
?>
