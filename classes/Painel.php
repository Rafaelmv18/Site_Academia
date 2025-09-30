<!-- ?php 

class Painel{
	public static function selectQuery($table, $query = '', $by, $order){
		$con = PgSql::conectar();
		$sql = $con->prepare("SELECT * FROM $table $query ORDER BY $by $order");
		$sql->execute();
		$result = $sql->fetchAll(PDO::FETCH_ASSOC);
		$con = null;
		return $result;
	}

	public static function select($table, $query = '', $arr = []){
		$con = PgSql::conectar();
		if($query != false){
			$sql = $con->prepare("SELECT * FROM $table WHERE $query");
			$sql->execute($arr);
		} else {
			$sql = $con->prepare("SELECT * FROM $table");
			$sql->execute();
		}
		$result = $sql->fetch(PDO::FETCH_ASSOC);
		$con = null;
		return $result;
	}

	public static function selectAll($table, $by, $order){
		$con = PgSql::conectar();
		$busca = $con->prepare("SELECT * FROM $table ORDER BY $by $order");
		$busca->execute();
		$result = $busca->fetchAll(PDO::FETCH_ASSOC);
		$con = null;
		return $result;
	}
	public static function alert($tipo,$mensagem){
		if($tipo == 'sucesso'){
			echo '
				<div class="alert alert-success" role="alert" style="z-index: 99; top: 1vh; position: fixed; left: 75vw;">
					<i class="bi bi-check-circle me-1" style="margin-right: 5px;"></i>'
					.$mensagem.
					'
					<span class="progress"></span>
				</div>';
		}else if($tipo == 'atencao'){
			echo '
				<div class="noprint alert alert-warning" role="alert" style="z-index: 99; top: 1vh; position: fixed; left: 75vw;">
					<i class="bi bi-exclamation-triangle me-1" style="margin-right: 5px;"></i>'
					.$mensagem.
					'
					<span class="progress"></span>
				</div>';
		}else if($tipo == 'erro'){
			echo '
				<div class="alert alert-danger" role="alert" style="z-index: 99; top: 1vh; position: fixed; left: 75vw;">
					<i class="bi bi-exclamation-octagon me-1" style="margin-right: 5px;"></i>'
					.$mensagem.
					'
					<span class="progress"></span>
				</div>';
		}
	}


    /**
     * Método para redirecionar o usuário para uma URL específica.
     * @param string $url A URL de destino para o redirecionamento.
     */
    public static function redirect($url) {
        // A função header() do PHP envia um cabeçalho HTTP para o navegador.
        // 'Location:' é o cabeçalho que instrui o navegador a ir para outra página.
        header('Location: ' . $url);

        // A função die() (ou exit()) é MUITO IMPORTANTE aqui.
        // Ela garante que a execução do script PHP seja interrompida imediatamente
        // após o envio do cabeçalho de redirecionamento.
        die();
    }

	public static function getRelatorioFrequencia() {
        $con = null; // Inicializa $con como null
        try {
            $con = PgSql::conectar();
            // SQL para contar as entradas de cada aluno
            $sql = "
                SELECT 
                    u.nome, 
                    COUNT(e.entrada_id) AS total_frequencia
                FROM 
                    Usuario u
                JOIN 
                    Aluno a ON u.usuario_id = a.aluno_id -- Garante que estamos pegando apenas usuários que são alunos
                LEFT JOIN 
                    Entrada e ON a.aluno_id = e.aluno_id -- LEFT JOIN para incluir alunos com 0 presenças
                WHERE
                    u.tipo_usuario = 0 -- Filtra explicitamente por alunos na tabela Usuario
                GROUP BY 
                    u.nome
                ORDER BY 
                    total_frequencia DESC
            ";

            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Em um sistema real, aqui você faria o log do erro.
            // Para depuração, podemos mostrar a mensagem:
            // die("Erro ao gerar relatório de frequência: " . $e->getMessage());
            return []; // Retorna um array vazio em caso de erro
        } finally {
            if ($con) { $con = null; } // Garante que a conexão seja fechada, ocorra erro ou não
        }
    }


    public static function getRelatorioOcupacao() {
        $con = null; // Inicializa $con como null
        try {
            $con = PgSql::conectar();
            // SQL para contar os agendamentos de cada modalidade
            $sql = "
                SELECT 
                    m.nome AS modalidade, 
                    COUNT(ag.agendamento_id) AS total_agendamentos
                FROM 
                    Modalidade m
                LEFT JOIN 
                    Agendamento ag ON m.modalidade_id = ag.modalidade_id -- LEFT JOIN para incluir modalidades com 0 agendamentos
                GROUP BY 
                    m.nome
                ORDER BY 
                    total_agendamentos DESC
            ";

            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // die("Erro ao gerar relatório de ocupação: " . $e->getMessage());
            return []; // Retorna um array vazio em caso de erro
        } finally {
            if ($con) { $con = null; } // Garante que a conexão seja fechada, ocorra erro ou não
        }
    }
}
?> -->