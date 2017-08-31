<?php
use kartik\select2\Select2;
?>

<div class="panel panel-default">
                <table class="table"> 
                    <thead> 
                        <tr>    
                            <th>Inscrição</th>
                            <th>Nome Completo</th>
                            <th>Análise de Perfil</th>
                            <th>Avaliação Comportamental</th>
                            <th>Entrevista</th>
                            <th>Pontuação Total</th>
                            <th>Classificação</th>
                        </tr> 
                    </thead>
                    <tbody> 
                        <?php foreach ($itens as $i => $etapa): ?>
                        <tr class="default<?= "$i" ?>"> 

                            <td><?= yii\helpers\Html::a($etapa->curriculos->numeroInscricao, ['curriculos/curriculos-admin/imprimir', 'id' => $etapa->curriculos->id], ['class' => 'profile-link', 'target' => '_blank']) ?></td>

                            <td><?= $form->field($etapa, "[{$i}]nome")->textInput(['value' => $etapa->curriculos->nome, 'readonly'=> true])->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($etapa, "[{$i}]itens_analisarperfil")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($etapa, "[{$i}]itens_comportamental")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($etapa, "[{$i}]itens_entrevista")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($etapa, "[{$i}]itens_pontuacaototal")->textInput(['readonly' => true])->label(false); ?></td>

                            <td style="width: 300px;">
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