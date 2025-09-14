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
?>