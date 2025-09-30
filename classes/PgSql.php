<?php
// Arquivo: classes/SupabaseAPI.php

class PgSql {
    private $projectUrl;
    private $apiKey;

    public function __construct($projectUrl, $apiKey) {
        $this->projectUrl = $projectUrl;
        $this->apiKey = $apiKey;
    }

    /**
     * Função privada que executa as requisições cURL para a API.
     */
    private function executeCurl($method, $table, $data = [], $query = '') {
        $url = "{$this->projectUrl}/rest/v1/{$table}?{$query}";

        $headers = [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
            'Prefer: return=representation'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Garante que o cURL possa verificar o certificado SSL do Supabase
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        switch (strtoupper($method)) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                if (!empty($data)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            case 'PATCH':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
                if (!empty($data)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
            case 'GET':
                // Nenhuma configuração extra necessária para GET
                break;
        }

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            // Se houver um erro no cURL (ex: não conseguiu conectar)
            $error_msg = curl_error($ch);
            curl_close($ch);
            return ['error' => true, 'message' => "Erro de cURL: " . $error_msg];
        }

        curl_close($ch);

        // Se o código HTTP não for de sucesso (2xx), retorna um erro
        if ($httpcode < 200 || $httpcode >= 300) {
            return ['error' => true, 'message' => $response, 'code' => $httpcode];
        }

        return json_decode($response, true);
    }

    /**
     * Busca dados de uma tabela.
     * Ex: $supabase->select('Usuario', 'usuario_id=eq.1');
     */
    public function select($table, $query = 'select=*') {
        return $this->executeCurl('GET', $table, [], $query);
    }

    public function selectAll($table, $by, $order = 'asc') {
        // Monta a query no formato da API do Supabase: select=*&order=coluna.direcao
        $query = "select=*&order={$by}.{$order}";
        
        // Reutiliza o método 'select' que já faz a chamada GET
        return $this->select($table, $query);
    }

    /**
     * Insere uma nova linha em uma tabela.
     * Ex: $supabase->insert('Usuario', ['nome' => 'João', 'email' => 'joao@email.com']);
     */
    public function insert($table, $data) {
        return $this->executeCurl('POST', $table, $data);
    }

    /**
     * Atualiza linhas em uma tabela com base em uma query.
     * Ex: $supabase->update('Usuario', ['nome' => 'João Silva'], 'usuario_id=eq.1');
     */
    public function update($table, $data, $query) {
        return $this->executeCurl('PATCH', $table, $data, $query);
    }

    /**
     * Deleta linhas de uma tabela com base em uma query.
     * Ex: $supabase->delete('Usuario', 'usuario_id=eq.1');
     */
    public function delete($table, $query) {
        return $this->executeCurl('DELETE', $table, [], $query);
    }
}
?>