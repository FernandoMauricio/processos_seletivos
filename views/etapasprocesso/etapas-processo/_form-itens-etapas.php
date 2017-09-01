<?php
use kartik\select2\Select2;
?>

<div class="panel panel-default">
                <table class="table"> 
                    <thead> 
                        <tr>    
                            <th>Nome Completo</th>
                            <th>Análise de Perfil</th>
                            <th>Avaliação Comportamental</th>
                            <th>Entrevista</th>
                            <th>Pontuação Total</th>
                            <th>Classificação</th>
                            <th>Local de Contratação</th>
                        </tr> 
                    </thead>
                    <tbody> 
                        <?php foreach ($itens as $i => $etapa): ?>
                        <tr class="default<?= "$i" ?>"> 

                            <td style="width: 300px;"><?= yii\helpers\Html::a($etapa->curriculos->nome, ['curriculos/curriculos-admin/imprimir', 'id' => $etapa->curriculos->id], ['class' => 'profile-link', 'target' => '_blank', 'style' => 'text-transform: uppercase']) ?></td>

                            <td style="width: 80px;"><?= $form->field($etapa, "[{$i}]itens_analisarperfil")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($etapa, "[{$i}]itens_comportamental")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($etapa, "[{$i}]itens_entrevista")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($etapa, "[{$i}]itens_pontuacaototal")->textInput(['readonly' => true])->label(false); ?></td>

                            <td style="width: 200px;">
                            <?php 
                                echo $form->field($etapa, "[{$i}]itens_classificacao")->widget(Select2::classname(), [
                                    'options' => ['placeholder' => 'Selecione a Classificação...'],
                                    'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    'data' =>
                                      [
                                        'Desclassificado(a) por nota na entrevista individual' => 'Desclassificado(a) por nota na entrevista individual',
                                        'Desclassificado(a) por nota na avaliação comportamental' => 'Desclassificado(a) por nota na avaliação comportamental',
                                        '1º colocado(a)' => '1º colocado(a)', 
                                        '2º colocado(a)' => '2º colocado(a)', 
                                        '3º colocado(a)' => '3º colocado(a)', 
                                        '4º colocado(a)' => '4º colocado(a)', 
                                        '5º colocado(a)' => '5º colocado(a)', 
                                        '6º colocado(a)' => '6º colocado(a)', 
                                        '7º colocado(a)' => '7º colocado(a)', 
                                        '8º colocado(a)' => '8º colocado(a)', 
                                        '9º colocado(a)' => '9º colocado(a)', 
                                      ],
                                    ])->label(false);
                            ?>
                            </td>
                            <td style="width: 200px;">
                            <?php 
                                echo $form->field($etapa, "[{$i}]itens_localcontratacao")->widget(Select2::classname(), [
                                    'options' => ['placeholder' => 'Local de Contratação...'],
                                    'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    'data' =>
                                      [
                                        'BANCO DE DADOS' => 'BANCO DE DADOS',
                                        'DESISTENTE' => 'DESISTENTE',
                                        'DRG' => 'DRG',
                                        'SPD' => 'SPD',
                                        'GCO' => 'GCO',
                                        'GMA' => 'GMA',
                                        'GGP' => 'GGP',
                                        'DAD' => 'DAD',
                                        'DPM' => 'DPM',
                                        'GPE' => 'GPE',
                                        'DEP' => 'DEP',
                                        'GMT' => 'GMT',
                                        'GDE' => 'GDE',
                                        'GMK' => 'GMK',
                                        'ACI' => 'ACI',
                                        'GNPE' => 'GNPE',
                                        'GPO' => 'GPO',
                                        'CTH' => 'CTH',
                                        'CIN' => 'CIN',
                                        'GTI' => 'GTI',
                                        'CEP - PF' => 'CEP - PF',
                                        'CEP - JT' => 'CEP - JT',
                                        'CEP - LB' => 'CEP - LB',
                                        'CEP - MPR' => 'CEP - MPR',
                                        'CEP - MBI' => 'CEP - MBI',
                                        'CEP - PJP' => 'CEP - PJP',
                                        'CEP - LSR' => 'CEP - LSR',
                                        'FATESE' => 'FATESE',
                                        'GTC/DPM' => 'GTC/DPM',
                                        'EDC' => 'EDC',
                                        'SEDOC' => 'SEDOC',
                                        'DIF' => 'DIF',
                                        'SECAD' => 'SECAD',
                                        'BALSA ESCOLA' => 'BALSA ESCOLA',
                                        'ENGENHARIA E OBRAS' => 'ENGENHARIA E OBRAS',
                                        'CARRETA DE INF.' => 'CARRETA DE INF.',
                                        'CARRETA DE TUR. E HOSP.' => 'CARRETA DE TUR. E HOSP.',
                                        'CARRETA DE BEL.' => 'CARRETA DE BEL.',
                                      ],
                                    ])->label(false);
                            ?>
                            </td>

                        </tr> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  jQuery('#etapasitens-<?=$i?>-itens_analisarperfil, #etapasitens-<?=$i?>-itens_comportamental, #etapasitens-<?=$i?>-itens_entrevista').keyup(function(){   
   var total = 0; 
   var total = parseFloat($('#etapasitens-<?=$i?>-itens_analisarperfil').val(), 0);
   $('#etapasitens-<?=$i?>-itens_pontuacaototal').val(total);
   var valor2 = parseFloat($('#etapasitens-<?=$i?>-itens_comportamental').val(), 0);
   if (valor2 == 0){
       $('#etapasitens-<?=$i?>-itens_pontuacaototal').val(total);
   }
   else {
       total += valor2;
       $('#etapasitens-<?=$i?>-itens_pontuacaototal').val(total);
   }
   var valor3 = parseFloat($('#etapasitens-<?=$i?>-itens_entrevista').val(), 0);
   if (valor3 == 0){
       $('#etapasitens-<?=$i?>-itens_pontuacaototal').val(total);
   }
   else{
       total += valor3;
       $('#etapasitens-<?=$i?>-itens_pontuacaototal').val(total);
   }
  });
});
</script>
                <?php endforeach; ?>
            </tbody>
    </table>
</div>