<?php
session_start();
$autoload = function($class){
	include('classes/'.$class.'.php');
};
spl_autoload_register($autoload);

define('INCLUDE_PATH','localhost/Site_Academia/');

function verificaPermissao($permissao){
    if(!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] < $permissao){
        // Bloqueia usuário
        header("Location: inicio"); // redireciona para o início ou outra página
        exit();
    }
}

define('DB_HOST', 'aws-1-sa-east-1.supabase.com');
define('DB_NAME', 'postgres'); 
define('DB_USER', 'postgres.ijjrjomdbsdbqkpolonh');
define('DB_PASS', '@siteacademia1');

?>