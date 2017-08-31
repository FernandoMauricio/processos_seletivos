
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
                        <?php foreach ($modelsEtapasItens as $i => $modelEtapasItens): ?>
                        <tr class="default<?= "$i" ?>"> 

                            <td><?= yii\helpers\Html::a($modelEtapasItens->curriculos->numeroInscricao, ['curriculos/curriculos-admin/imprimir', 'id' => $modelEtapasItens->curriculos->id], ['class' => 'profile-link', 'target' => '_blank']) ?></td>

                            <td><?= $form->field($modelEtapasItens, "[{$i}]nome")->textInput(['value' => $modelEtapasItens->curriculos->nome, 'readonly'=> true])->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($modelEtapasItens, "[{$i}]itens_analisarperfil")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($modelEtapasItens, "[{$i}]itens_comportamental")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($modelEtapasItens, "[{$i}]itens_entrevista")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($modelEtapasItens, "[{$i}]itens_pontuacaototal")->textInput(['readonly' => true])->label(false); ?></td>

                            <td style="width: 300px;"><?= $form->field($modelEtapasItens, "[{$i}]itens_classificacao")->textInput()->label(false); ?></td>

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