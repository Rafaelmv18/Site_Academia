<?php
require_once 'config.php'; 
$modalidades = Painel::selectAll('modalidade', 'nome', 'ASC');

// --- Agrupar modalidades pelo nome ---
$agrupadas = [];
foreach ($modalidades as $mod) {
    $nome = $mod['nome'];
    if (!isset($agrupadas[$nome])) {
        $agrupadas[$nome] = [
            'nome' => $nome,
            'imagem' => $mod['imagem'],
            'descricao' => $mod['descricao'],
            'horarios' => []
        ];
    }
    // Decodifica os horários e adiciona ao array
    $horarios = json_decode($mod['horarios'], true);
    if (is_array($horarios)) {
        $agrupadas[$nome]['horarios'] = array_merge($agrupadas[$nome]['horarios'], $horarios);
    }
}
?>

<section class="modalidades">
    <div class="container">
        <div class="intro">
            <h1>Transforme Seu Corpo</h1>
            <p>Descubra nossas atividades e comece sua jornada fitness hoje mesmo</p>
        </div>

        <?php foreach ($agrupadas as $modalidade){ ?>
            <?php $slug = strtolower(str_replace(' ', '-', $modalidade['nome'])); ?>
            
            <div class="card" id="modalidade-<?php echo $slug; ?>">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="<?php echo $modalidade['imagem'] ?>" 
                             alt="<?php echo $modalidade['nome'] ?>" class="card-image-modalidade">
                        <div class="card-title"><?php echo $modalidade['nome']?></div>
                    </div>
                    <div class="card-back">
                        <div class="card-description">
                            <h3><?php echo $modalidade['nome']?></h3>

                            <?php 
                            if (!empty($modalidade['horarios'])) {
                                echo "<ul class='horarios'>";
                                foreach ($modalidade['horarios'] as $h) {
                                    echo "<li><i class='fa-regular fa-clock'></i> {$h['dia']}: {$h['inicio']} às {$h['fim']}</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<p><i class='fa-regular fa-clock'></i> Horário a definir</p>";
                            }
                            ?>

                            <ul>
                                <?php 
                                $beneficios = explode("\n", $modalidade['descricao']); 
                                foreach ($beneficios as $b) {
                                    echo "<li><i class='fa-solid fa-check'></i> " . trim($b) . "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
