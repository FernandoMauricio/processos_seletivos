<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CurriculosFormacao */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Curriculos Formacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-formacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fundamental_comp',
            'medio_comp',
            'superior_comp',
            'superior_area',
            'pos',
            'pos_area',
            'mestrado',
            'mestrado_area',
            'doutorado',
            'doutorado_area',
            'estuda_atualmente',
            'estuda_curso',
            'estuda_turno_mat',
            'estuda_turno_vesp',
            'estuda_turno_not',
            'curriculos_id',
        ],
    ]) ?>

</div>
