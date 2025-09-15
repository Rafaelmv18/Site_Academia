<?php
session_start();
$autoload = function($class){
	include('classes/'.$class.'.php');
};
spl_autoload_register($autoload);

define('INCLUDE_PATH','https://localhost/Site_Academia/');

// $sql = MySql::conectar()->query("SELECT * FROM tb_usuario");
// $usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
// print_r($usuarios);

$cpf_limpo = preg_replace('/[^\d]/', '', $_SESSION['cpf']);
$digitos_visiveis = substr($cpf_limpo, 3, 3);
$cpf_mascarado = '***.' . $digitos_visiveis . '.***-**';


function verificaPermissao($permissao){
    if(!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] < $permissao){
        // Bloqueia usuário
        header("Location: inicio"); // redireciona para o início ou outra página
        exit();
    }
}

?>