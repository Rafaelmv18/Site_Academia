<?php

class PgSql {
    private static $pdo;

    public static function conectar() {
        if (self::$pdo == null) {
            try {
                // Usa pgsql ao invés de mysql
                self::$pdo = new PDO(
                    'pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME,
                    DB_USER,
                    DB_PASS
                );

                // Ativa os erros como exceção (boa prática)
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (Exception $e) {
                die('Erro ao conectar: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

?>