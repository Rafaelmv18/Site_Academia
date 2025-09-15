<?php
include('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_usuario` WHERE email = ? AND senha = ?");
    $sql->execute(array($email, $senha));
    if ($sql->rowCount() == 1) {
        $info = $sql->fetch();
        $_SESSION['usuario_id'] = $info['usuario_id'];
        $_SESSION['nome'] = $info['nome'];
        $_SESSION['cpf'] = $info['cpf'];
        $_SESSION['email'] = $info['email'];
        $_SESSION['status'] = $info['status'];
        $_SESSION['tipo_usuario'] = $info['tipo_usuario'];
        header("Location: painel.php");
    } else {
        echo 'erro';
    }
}

?>