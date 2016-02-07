<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */

$this->title = $model->numeroInscricao;

$this->params['breadcrumbs'][] = ['label' => 'Curriculos', 'url' => ['index']];
$this->params['breadcrumbs'][] =  $this->title;
?>
<div class="curriculos-view">

    <h1>Número de Inscrição: <?= Html::encode($this->title) ?></h1>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Informações do Candidato: <span class="text-uppercase"> <?= $model->nome ?></span></h3>
  </div>
  <div class="panel-body">
  <div class="row">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'edital',
            'numeroInscricao',
            'cargo',
            'nome',
            'cpf',
            'datanascimento',
            'idade',
            [
                'attribute'=>'sexo', 
                'label'=>'Sexo',
                'format'=>'raw',
                'value'=>$model->sexo ? 'Masculino' : 'Feminino',
            ],
            'email:email',
            'emailAlt:email',
            'telefone',
            'telefoneAlt',
            'data',
        ],
    ]) ?>
</div>

            <!--    INFORMÇÕES DO CANDIDATO    -->

  </div>
</div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Endereço</h3>
  </div>
    <div class="panel-body">
          <div class="row">

          <div class="col-md-6"><strong>Endereço:</strong> <?php echo $curriculosEndereco->endereco ?></div>
          <div class="col-md-2"><strong>Número:</strong> <?php echo $curriculosEndereco->numero_end ?></div>
          <div class="col-md-4"><strong>Bairro:</strong> <?php echo $curriculosEndereco->bairro ?></div>
          <div class="col-md-6"><strong>Complemento:</strong> <?php echo $curriculosEndereco->complemento ?></div>
          <div class="col-md-4"><strong>Cidade:</strong> <?php echo $curriculosEndereco->cidade ?></div>
          <div class="col-md-2"><strong>Estado:</strong> <?php echo $curriculosEndereco->estado ?></div>
          <div class="col-md-2"><strong>CEP:</strong> <?php echo $curriculosEndereco->cep ?></div>

         </div>

    </div>
</div>


<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Formação Escolar</h3>
  </div>
  <div class="panel-body">
  <div class="row">

          <div class="col-md-12"><strong>Ensino Fundamental: </strong><?php echo $curriculosFormacao->fundamental_comp ? 'Completo' : 'Incompleto' ?></div>

          <div class="col-md-12"><strong>Ensino Médio: </strong><?php echo $curriculosFormacao->medio_comp ? 'Completo' : 'Incompleto' ?></div>
          
          <div class="col-md-3"><strong>Ensino Superior: </strong><?php echo $curriculosFormacao->superior_comp ? 'Completo' : 'Incompleto' ?></div>

          <div class="col-md-9"><strong>Curso Graduação: </strong><?php echo $curriculosFormacao->superior_area ?></div>

          <div class="col-md-3"><strong>Pós Graduação: </strong><?php echo $curriculosFormacao->pos ? 'Completo' : 'Incompleto' ?></div>
          <div class="col-md-9"><strong>Curso Pós-Graduação: </strong><?php echo $curriculosFormacao->pos_area ?></div>

          <div class="col-md-3"><strong>Mestrado: </strong><?php echo $curriculosFormacao->mestrado ? 'Completo' : 'Incompleto' ?></div>
          <div class="col-md-9"><strong>Curso Mestrado: </strong><?php echo $curriculosFormacao->mestrado_area ?></div>

          <div class="col-md-3"><strong>Doutorado: </strong><?php echo $curriculosFormacao->doutorado ? 'Completo' : 'Incompleto' ?></div>
          <div class="col-md-9"><strong>Curso Doutorado: </strong><?php echo $curriculosFormacao->doutorado_area ?></div>

          <div class="col-md-3"><strong>Estuda Atualmente: </strong><?php echo $curriculosFormacao->doutorado ? 'Sim' : 'Não' ?></div>
          <div class="col-md-4"><strong>Curso: </strong><?php echo $curriculosFormacao->estuda_curso ?></div>
          <div class="col-md-5"><strong>Turno: </strong>
            <?php echo $curriculosFormacao->estuda_turno_mat ? '[X] Matutino' : '[ ] Matutino' ?>
            <?php echo $curriculosFormacao->estuda_turno_vesp ? '[X] Vespertino' : '[ ] Vespertino' ?>
            <?php echo $curriculosFormacao->estuda_turno_not ? '[X] Noturno' : '[ ] Noturno' ?>
          </div>



  </div>
</div>
</div>


<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Cursos Complementares</h3>
  </div>
  <div class="panel-body">
  <div class="row">





  </div>
</div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Empregos Anterioes</h3>
  </div>
  <div class="panel-body">
  <div class="row">





  </div>
</div>
</div>

