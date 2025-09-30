<?php 
Class Pagamento {
    public static function cadastrarPagamento($aluno_id, $valor, $forma_pagamento, $data_pagamento, $status) {
        $con = PgSql::conectar();
        $sql = $con->prepare("INSERT INTO pagamento (aluno_id, valor, forma_pagamento, data_pagamento, status) VALUES (?, ?, ?, ?, ?)");
        $sql->execute(array($aluno_id, $valor, $forma_pagamento, $data_pagamento, $status));
        $con = null;
    }
}
?>