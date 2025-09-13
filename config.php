<?php
$autoload = function($class){
	include('classes/'.$class.'.php');
};
spl_autoload_register($autoload);

$sql = MySql::conectar()->query("SELECT * FROM usuario");
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
print_r($usuarios);
?>