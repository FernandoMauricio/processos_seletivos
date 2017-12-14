<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */

$this->title = 'Atualizar Etapas do Processo: ' . $model->etapa_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Etapas do Processo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->etapa_id];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="etapas-processo-update">

    <h1><?= Html::encode($this->title) ?></h1>

<?php
//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}
?>

    <p>
   		<?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span> Retornar', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-print"></span> Imprimir', ['view', 'id' => $model->etapa_id], ['class' => 'btn btn-info', 'target'=>'_blank']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
        'itens' => $itens,
        'selecionadores' => $selecionadores,
        'unidades' => $unidades,
    ]) ?>

</div>
