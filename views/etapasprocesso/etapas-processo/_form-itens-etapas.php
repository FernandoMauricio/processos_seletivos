<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Json;
use yii\helpers\Url;

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
                        <?php foreach ($modelsEtapasItens as $i => $modelEtapasItens): ?>
                    <tbody> 
                        <tr class="default"> 

                            <td style="width: 160px;"><?= $form->field($modelEtapasItens, "[{$i}]inscricao")->textInput(['value' => $modelEtapasItens->curriculos->numeroInscricao, 'readonly'=> true])->label(false); ?></td>

                            <td><?= $form->field($modelEtapasItens, "[{$i}]nome")->textInput(['value' => $modelEtapasItens->curriculos->nome, 'readonly'=> true])->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($modelEtapasItens, "[{$i}]itens_analisarperfil")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($modelEtapasItens, "[{$i}]itens_comportamental")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($modelEtapasItens, "[{$i}]itens_entrevista")->textInput()->label(false); ?></td>

                            <td style="width: 80px;"><?= $form->field($modelEtapasItens, "[{$i}]itens_pontuacaototal")->textInput(['readonly' => true])->label(false); ?></td>

                            <td style="width: 300px;"><?= $form->field($modelEtapasItens, "[{$i}]itens_classificacao")->textInput()->label(false); ?></td>

                        </tr> 

                        <?php endforeach; ?>
            </tbody>
                </table>
</div>