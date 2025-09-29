<?php
include('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $sql = PgSql::conectar()->prepare("SELECT * FROM usuario WHERE cpf = ? AND senha = ?");
    $sql->execute(array($cpf, $senha));
    if ($sql->rowCount() == 1) {
        $info = $sql->fetch();
        $_SESSION['usuario_id'] = $info['usuario_id'];
        $_SESSION['nome'] = $info['nome'];
        $_SESSION['cpf'] = $info['cpf'];
        $_SESSION['email'] = $info['email'];
        $_SESSION['status'] = $info['status'];
        $_SESSION['tipo_usuario'] = $info['tipo_usuario'];
        $_SESSION['cargo'] = $info['cargo'];
        $_SESSION['nascimento'] = $info['data_nascimento'];

        header("Location: painel.php");
        exit;
    } else {
        $_SESSION['erro_login'] = "E-mail ou senha inválidos!";
        header("Location: login.php");
        exit;
    }
}

?>