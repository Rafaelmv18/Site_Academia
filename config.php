<?php
// 1. INICIA A SESSÃO
session_start();

// 2. DEFINE CONSTANTES DA APLICAÇÃO
define('BASE_URL', 'http://localhost/Site_Academia/'); // Melhor nome que INCLUDE_PATH

// ===================================================
//  MUDANÇA PRINCIPAL: CONSTANTES PARA A API DO SUPABASE
// ===================================================
// Encontre estes valores no seu painel do Supabase em Settings -> API
define('SUPABASE_URL', 'https://ijjrjomdbsdbqkpolonh.supabase.co'); // Sua URL do Projeto
define('SUPABASE_KEY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImlqanJqb21kYnNkYnFrcG9sb25oIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTgyNDkyNDIsImV4cCI6MjA3MzgyNTI0Mn0.eaE4ZSOBkXNqzMB4uJvjrJvwzopDjFR15wmVe0wQYpk'); // Sua chave "service_role" (secreta)

// 3. AUTOLOADER DE CLASSES
// Carrega automaticamente arquivos da pasta /classes/ como SupabaseAPI.php, Painel.php, etc.
$autoload = function($class){
    // Garante que o caminho do arquivo está correto
    $file = __DIR__ . '/classes/' . $class . '.php';
    if (file_exists($file)) {
        include($file);
    }
};
spl_autoload_register($autoload);

// 4. CRIA UMA INSTÂNCIA GLOBAL DO CLIENTE DA API
// Para que você possa usar a variável $supabase em qualquer lugar do seu código.
$supabase = new PgSql(SUPABASE_URL, SUPABASE_KEY);

// 5. FUNÇÕES GLOBAIS DE AJUDA (continua igual)
function verificaPermissao($permissao){
    // Assumindo que 1=Admin e 0=Normal, um Admin (1) tem permissão maior que um usuário (0).
    // A lógica deve ser >= (maior ou igual a).
    if(!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] < $permissao){
        header("Location: " . BASE_URL . "painel.php?section=inicio");
        exit();
    }
}

// O CÓDIGO ANTIGO DE CONEXÃO DIRETA (CLASSE PgSql) FOI REMOVIDO.
?>