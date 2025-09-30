<?php
// 1. INICIA A SESSÃO
session_start();

// 2. DEFINE CONSTANTES DA APLICAÇÃO
define('BASE_URL', 'http://localhost/Site_Academia/');

// ===================================================
// CONSTANTES PARA A API DO SUPABASE
// ===================================================
// Encontre estes valores no seu painel do Supabase em Settings -> API
define('SUPABASE_URL', 'https://ijjrjomdbsdbqkpolonh.supabase.co');
define('SUPABASE_KEY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImlqanJqb21kYnNkYnFrcG9sb25oIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTgyNDkyNDIsImV4cCI6MjA3MzgyNTI0Mn0.eaE4ZSOBkXNqzMB4uJvjrJvwzopDjFR15wmVe0wQYpk'); // << COLOQUE SUA CHAVE SECRETA AQUI

// 3. AUTOLOADER DE CLASSES
// Carrega automaticamente os arquivos da pasta /classes/ quando uma classe é chamada
$autoload = function($class){
    $file = __DIR__ . '/classes/' . $class . '.php';
    if (file_exists($file)) {
        require_once($file); // Usar require_once é mais seguro
    }
};
spl_autoload_register($autoload);

// 4. CRIA UMA INSTÂNCIA GLOBAL DO CLIENTE DA API
// Esta linha agora cria um objeto da classe correta: SupabaseAPI
$supabase = new SupabaseAPI(SUPABASE_URL, SUPABASE_KEY);

// 5. FUNÇÕES GLOBAIS DE AJUDA
// Adicionamos 'if !function_exists' para evitar o erro 'Cannot redeclare'
if (!function_exists('verificaPermissao')) {
    function verificaPermissao($permissao){
        if(!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] < $permissao){
            header("Location: " . BASE_URL . "painel.php?section=inicio");
            exit();
        }
    }
}
?>