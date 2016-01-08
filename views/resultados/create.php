<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Resultados */

$this->title = 'Create Resultados';
$this->params['breadcrumbs'][] = ['label' => 'Resultados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resultados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
