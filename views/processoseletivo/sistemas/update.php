<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\Sistemas */

$this->title = 'Atualizar Sistema: ' . ' ' . $model->idsistema;
$this->params['breadcrumbs'][] = ['label' => 'Sistemas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idsistema, 'url' => ['view', 'id' => $model->idsistema]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="sistemas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
