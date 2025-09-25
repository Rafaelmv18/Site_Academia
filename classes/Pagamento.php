<?php 
Class Pagamento {
    public static function cadastrarPagamento($aluno_id, $valor, $forma_pagamento, $data_pagamento, $status) {
        $sql = PgSql::conectar()->prepare("INSERT INTO pagamento (aluno_id, valor, forma_pagamento, data_pagamento, status) VALUES (?, ?, ?, ?, ?)");
        $sql->execute(array($aluno_id, $valor, $forma_pagamento, $data_pagamento, $status));
    }
}
?>
