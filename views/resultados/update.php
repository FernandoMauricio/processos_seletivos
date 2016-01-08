<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Resultados */

$this->title = 'Update Resultados: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Resultados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'processo_id' => $model->processo_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resultados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
