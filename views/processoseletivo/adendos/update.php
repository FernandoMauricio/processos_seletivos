<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\Adendos */

$session = Yii::$app->session;
$processo_id = $session['sess_processo'];

$this->title = 'Atualizar Adendo';
$this->params['breadcrumbs'][] = ['label' => 'Processos Seletivos', 'url' => ['processoseletivo/processo-seletivo/index']];
$this->params['breadcrumbs'][] = ['label' => $processo_id, 'url' => ['processoseletivo/processo-seletivo/view', 'id' => $processo_id]];
$this->params['breadcrumbs'][] = ['label' => 'Adendos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adendos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
