<?php
// Garante que a sessão seja iniciada

// Requer os arquivos de configuração e o autoloader do Composer
require '../config.php';
require '../vendor/autoload.php';

// Usa as classes do Dompdf
use Dompdf\Dompdf;
use Dompdf\Options;

// 1. VERIFICAÇÃO DE SEGURANÇA: Garante que apenas administradores possam gerar relatórios
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 1) {
    die("Acesso negado.");
}

// 2. PEGA O TIPO DE RELATÓRIO DA URL
$tipoRelatorio = $_GET['relatorio'] ?? '';

// 3. BUSCA OS DADOS NO BANCO COM BASE NO TIPO DE RELATÓRIO
// (Usando as funções que já criamos para a página de relatórios)
switch ($tipoRelatorio) {
    case 'frequencia':
        $titulo = 'Relatório de Frequência de Alunos';
        $dados = Painel::getRelatorioFrequencia(); // Assume que esta função existe
        $cabecalho = ['Aluno', 'Total de Presenças'];
        $colunas = ['nome', 'total_frequencia'];
        break;

    case 'ocupacao':
        $titulo = 'Relatório de Ocupação das Modalidades';
        $dados = Painel::getRelatorioOcupacao(); // Assume que esta função existe
        $cabecalho = ['Modalidade', 'Total de Agendamentos'];
        $colunas = ['modalidade', 'total_agendamentos'];
        break;

    default:
        die("Tipo de relatório inválido.");
}

// 4. MONTA O HTML QUE SERÁ CONVERTIDO EM PDF
// Usamos output buffering (ob_start, ob_get_clean) para montar o HTML de forma limpa
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        h1 { text-align: center; margin-bottom: 20px; color: #f39c12; }
        table { width: 100%; border-collapse: collapse; }
        thead { background-color: #f39c12; color: #fff; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        tbody tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #777; }
    </style>
</head>
<body>
    <h1><?php echo $titulo; ?></h1>
    <p>Gerado em: <?php echo date('d/m/Y H:i:s'); ?></p>
    
    <table>
        <thead>
            <tr>
                <?php foreach ($cabecalho as $th): ?>
                    <th><?php echo $th; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($dados)): ?>
                <tr>
                    <td colspan="<?php echo count($cabecalho); ?>" style="text-align:center;">Nenhum dado encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($dados as $linha): ?>
                    <tr>
                        <?php foreach ($colunas as $coluna): ?>
                            <td><?php echo htmlspecialchars($linha[$coluna]); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        SPIKE GYM - Relatório Interno
    </div>
</body>
</html>
<?php
// Pega o HTML do buffer e limpa
$html = ob_get_clean();

// 5. CONFIGURA E RENDERIZA O PDF COM DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', true); // Permite carregar imagens externas se necessário

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html); // Carrega o HTML
$dompdf->setPaper('A4', 'portrait'); // Define o tamanho do papel (A4) e orientação (retrato)
$dompdf->render(); // Renderiza o HTML como PDF

// 6. ENVIA O PDF PARA O NAVEGADOR
// O nome do arquivo será "relatorio_frequencia.pdf" ou "relatorio_ocupacao.pdf"
$dompdf->stream("relatorio_" . $tipoRelatorio . ".pdf", ["Attachment" => false]);
// "Attachment" => false: Tenta abrir o PDF no navegador.
// "Attachment" => true: Força o download do arquivo.

?>