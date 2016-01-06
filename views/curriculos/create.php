<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */

$this->title = 'Create Curriculos';
$this->params['breadcrumbs'][] = ['label' => 'Curriculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
