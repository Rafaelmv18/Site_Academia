<?php
class PgSql {
    public static function conectar() {
        try {
            $dsn = 'pgsql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';sslmode=require';
            
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => false // evita conexões mantidas abertas
            ]);

            return $pdo;
        } catch (PDOException $e) {
            die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
        }
    }
}
