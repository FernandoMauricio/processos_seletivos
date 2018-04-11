<?php

use kartik\builder\Form;

?>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'fundamental_comp')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?> </div>
        </div>

        <div class="row">
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'medio_comp')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?> </div>
        </div>

        <div class="row">
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'tecnico')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?> </div>
            <div class="col-md-4"><?= $form->field($curriculosFormacao, 'tecnico_area')->textInput(['placeholder'=>'Informe o seu curso Técnico...']) ?></div>
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'tecnico_local')->textInput(['placeholder'=>'Informe a Instituição...']) ?></div>
            <div class="col-md-2"><?= $form->field($curriculosFormacao, 'tecnico_anoconclusao')->textInput(['placeholder'=>'Ano de Conclusão...']) ?></div>
        </div>

        <div class="row">
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'superior_comp')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?> </div>
            <div class="col-md-4"><?= $form->field($curriculosFormacao, 'superior_area')->textInput(['placeholder'=>'Informe a sua Graduação...']) ?></div>
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'superior_local')->textInput(['placeholder'=>'Informe a Instituição...']) ?></div>
            <div class="col-md-2"><?= $form->field($curriculosFormacao, 'superior_anoconclusao')->textInput(['placeholder'=>'Ano de Conclusão...']) ?></div>
        </div>

        <div class="row">
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'pos')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?> </div>
            <div class="col-md-4"><?= $form->field($curriculosFormacao, 'pos_area')->textInput(['placeholder'=>'Informe seu curso de Pós-graduação...']) ?></div>
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'pos_local')->textInput(['placeholder'=>'Informe a Instituição...']) ?></div>
            <div class="col-md-2"><?= $form->field($curriculosFormacao, 'pos_anoconclusao')->textInput(['placeholder'=>'Ano de Conclusão...']) ?></div>
        </div>

        <div class="row">
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'mestrado')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?> </div>
            <div class="col-md-4"><?= $form->field($curriculosFormacao, 'mestrado_area')->textInput(['placeholder'=>'Informe seu curso de Mestrado...']) ?></div>
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'mestrado_local')->textInput(['placeholder'=>'Informe a Instituição...']) ?></div>
            <div class="col-md-2"><?= $form->field($curriculosFormacao, 'mestrado_anoconclusao')->textInput(['placeholder'=>'Ano de Conclusão...']) ?></div>
        </div>

        <div class="row">
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'doutorado')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?> </div>
            <div class="col-md-4"><?= $form->field($curriculosFormacao, 'doutorado_area')->textInput(['placeholder'=>'Informe seu curso de Doutorado...']) ?></div>
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'doutorado_local')->textInput(['placeholder'=>'Informe a Instituição...']) ?></div>
            <div class="col-md-2"><?= $form->field($curriculosFormacao, 'doutorado_anoconclusao')->textInput(['placeholder'=>'Ano de Conclusão...']) ?></div>
        </div>

        <div class="row">
            
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'estuda_atualmente')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?> </div>
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'estuda_curso')->textInput(['placeholder'=>'Informe seu Curso...']) ?></div>
            <div class="col-md-3"><?= $form->field($curriculosFormacao, 'estuda_local')->textInput(['placeholder'=>'Informe o local...']) ?></div>
            <div class="col-md-1"><?= $form->field($curriculosFormacao, 'estuda_turno_mat')->checkbox()->label('Turno?') ?></div>
            <div class="col-md-1" style="margin-top: 5px;"><?= $form->field($curriculosFormacao, 'estuda_turno_vesp')->checkbox()->label('') ?></div>
            <div class="col-md-1" style="margin-top: 5px;"><?= $form->field($curriculosFormacao, 'estuda_turno_not')->checkbox()->label('') ?></div>
        </div>
    </div>
        
        
        
        
        