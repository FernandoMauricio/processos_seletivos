<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CurriculosFormacao */

$this->title = 'Create Curriculos Formacao';
$this->params['breadcrumbs'][] = ['label' => 'Curriculos Formacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-formacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
