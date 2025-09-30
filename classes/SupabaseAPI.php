<?php
// Arquivo: classes/SupabaseAPI.php

class SupabaseAPI { // << NOME DA CLASSE CORRIGIDO
    private $projectUrl;
    private $apiKey;

    public function __construct($projectUrl, $apiKey) {
        $this->projectUrl = $projectUrl;
        $this->apiKey = $apiKey;
    }

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
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        switch (strtoupper($method)) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                if (!empty($data)) { curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); }
                break;
            case 'PATCH':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
                if (!empty($data)) { curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); }
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            return ['error' => true, 'message' => "Erro de cURL: " . $error_msg];
        }
        curl_close($ch);
        if ($httpcode < 200 || $httpcode >= 300) {
            return ['error' => true, 'message' => $response, 'code' => $httpcode];
        }
        return json_decode($response, true);
    }
    
    public function select($table, $query = 'select=*') {
        return $this->executeCurl('GET', $table, [], $query);
    }
    
    public function selectAll($table, $by, $order = 'asc') {
        $query = "select=*&order={$by}.{$order}";
        return $this->select($table, $query);
    }
    
    public function insert($table, $data) {
        return $this->executeCurl('POST', $table, $data);
    }
    
    public function update($table, $data, $query) {
        return $this->executeCurl('PATCH', $table, $data, $query);
    }
    
    public function delete($table, $query) {
        return $this->executeCurl('DELETE', $table, [], $query);
    }
}
?>