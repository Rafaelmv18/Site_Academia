<?php

class MySql{
	private static $pdo;
	public static function conectar(){
		if(self::$pdo == null){
			try{
			self::$pdo = new PDO('mysql:host=localhost;dbname=academia;charset=utf8mb4','root','');
			// self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch (Exception $e) {
                die('Erro ao conectar: ' . $e->getMessage());
            }
		}
		return self::$pdo;
	}
}

?>