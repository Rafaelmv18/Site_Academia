<?php
class PgSql {
    public static function conectar() {
        try {
            $dsn = 'pgsql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';sslmode=require';
            
            // 1. Tenta estabelecer a nova conexão PDO
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => false // ESSENCIAL: Evita reaproveitamento problemático
            ]);

            // 2. Estratégia "Keep Alive" (SELECT 1)
            // Roda uma query leve para garantir que o Pooler marque a conexão como ativa.
            // Se esta linha não der erro, a conexão está viva.
            $pdo->query("SELECT 1"); 

            return $pdo;

        } catch (PDOException $e) {
            // Se houver qualquer falha (conexão inicial ou o SELECT 1)
            // O script morre e mostra o erro.
            die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
        }
    }
}