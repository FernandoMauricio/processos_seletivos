<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\PedidoCusto */

$this->title = $model->custo_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem Pedidos de Custo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-custo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->custo_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->custo_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Pedido de Custo</h3>
  </div>

  <div class="panel-body">
    <div class="row">

      <?php
        $attributes = [
            [
              'group'=>true,
              'label'=>'SEÇÃO 1: Informações',
              'rowOptions'=>['class'=>'info']
            ],

            [
              'columns' => [
                        [
                        'attribute' => 'custo_id',
                        'displayOnly'=>true,
                        ],

                        [
                        'attribute' => 'custo_assunto',
                        'displayOnly'=>true,
                        ],
                    ],
            ],

            [
              'columns' => [
                        [
                        'attribute' => 'custo_recursos',
                        'displayOnly'=>true,
                        ],

                        [
                        'attribute' => 'custo_valortotal',
                        'displayOnly'=>true,
                        ],

                        [
                        'attribute' => 'custo_responsavel',
                        'displayOnly'=>true,
                        ],

                        [
                        'attribute' => 'custo_data',
                        'labelColOptions'=>['style'=>'width:0%'],
                        'displayOnly'=>true,
                        ],
                    ],
            ],
        ];

    echo DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'attributes'=> $attributes,
    ]);
?>

    <?php
    // echo DetailView::widget([
    //     'model' => $model,
    //     'attributes' => [
    //         'custo_id',
    //         'custo_assunto',
    //         'custo_recursos',
    //         'custo_valortotal',
    //         'custo_data',
    //         'custo_aprovadorggp',
    //         'custo_situacaoggp',
    //         'custo_dataaprovacaoggp',
    //         'custo_aprovadordad',
    //         'custo_situacaodad',
    //         'custo_dataaprovacaodad',
    //         'custo_responsavel',
    //     ],
    // ]) 
    ?>


                        <!--    ENDEREÇO  -->

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 2: Itens do Pedido</th></tr>
      <tr>
        <th>Solicitação</th>
        <th>Unidade</th>
        <th>Cargo</th>
        <th>QTD</th>
        <th>Tipo Contrato</th>
        <th>Área</th>
        <th>CH. Semanal</th>
        <th>Salário</th>
        <th>Encargos</th>
        <th>Total</th>
        <th>Justificativa</th>
        <th>Data Prevista Início</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <?php foreach ($modelsItens as $i => $modelItens): ?>
          <td><?= $modelItens->contratacao_id; ?></td>
          <td><?= $modelItens->itemcusto_unidade; ?></td>
          <td><?= $modelItens->itemcusto_cargo; ?></td>
          <td><?= $modelItens->itemcusto_quantidade; ?></td>
          <td><?= $modelItens->itemcusto_tipocontrato; ?></td>
          <td><?= $modelItens->itemcusto_area; ?></td>
          <td><?= $modelItens->itemcusto_chsemanal; ?></td>
          <td style="width: 100px;"><?= 'R$ ' . number_format($modelItens->itemcusto_salario, 2, ',', '.'); ?></td>
          <td style="width: 100px;"><?= 'R$ ' . number_format($modelItens->itemcusto_encargos, 2, ',', '.'); ?></td>
          <td style="width: 100px;"><?= 'R$ ' . number_format($modelItens->itemcusto_total, 2, ',', '.'); ?></td>
          <td><?= $modelItens->itemcusto_justificativa; ?></td>
          <td><?= $modelItens->itemcusto_dataingresso; ?></td>
    </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>
</div></div></div>
