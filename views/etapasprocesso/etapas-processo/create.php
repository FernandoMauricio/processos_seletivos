<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */

$this->title = 'Create Etapas Processo';
$this->params['breadcrumbs'][] = ['label' => 'Etapas Processos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etapas-processo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
