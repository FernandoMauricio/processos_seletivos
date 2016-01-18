<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cargos */

$this->title = 'Update Cargos: ' . ' ' . $model->idcargo;
$this->params['breadcrumbs'][] = ['label' => 'Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcargo, 'url' => ['view', 'id' => $model->idcargo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cargos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
