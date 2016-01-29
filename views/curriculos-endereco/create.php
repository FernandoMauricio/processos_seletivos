<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CurriculosEndereco */

$this->title = 'Create Curriculos Endereco';
$this->params['breadcrumbs'][] = ['label' => 'Curriculos Enderecos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-endereco-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
