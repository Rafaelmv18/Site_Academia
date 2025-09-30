<?php

class PgSql {
    private static $pdo;

    public static function conectar() {
        if (self::$pdo == null) {
            try {
                // Monta a string de conexão (DSN) usando as constantes
                // A PARTE CRUCIAL ESTÁ AQUI: sslmode=require
                $dsn = 'pgsql:host=' . DB_HOST . ';port=6543;dbname=' . DB_NAME . ';sslmode=require';
                
                self::$pdo = new PDO($dsn, DB_USER, DB_PASS);

                // Ativa os erros como exceção (boa prática)
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                // Mostra um erro claro se a conexão falhar
                die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

?>