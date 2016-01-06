<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurriculosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Curriculos Cadastrados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],

            'cv_id',
            'cv_numeroEdital:ntext',
            'cv_cargo:ntext',
            'cv_nome:ntext',
            'cv_datanascimento',
            // [
            //     'attribute' => 'cv_datanascimento',
            //     'format' => ['date', 'php:d/m/Y'],
            // ],
            // 'cv_email:ntext',
            // 'cv_telefone',
            // 'cv_resumocv:ntext',
            'cv_data',
            // [
            //     'attribute' => 'cv_data',
            //     'format' => ['date', 'php:d/m/Y'],
            // ],
            // 'cv_email2:ntext',
            // 'cv_telefone2',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        
        ];

?>

    <?php echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'fontAwesome' => true,
    'dropdownOptions' => [
        'label' => 'Exportar para',
        'class' => 'btn btn-default'
    ],
    'exportConfig' => [
    ExportMenu::FORMAT_EXCEL => false,
    ExportMenu::FORMAT_EXCEL_X  => false,
    ExportMenu::FORMAT_PDF => false
]
]) . "<hr>\n".
 GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]);

 ?>

</div>
