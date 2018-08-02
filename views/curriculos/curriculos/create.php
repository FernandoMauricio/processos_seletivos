<?php

    echo $this->render('_form', [
        'model' => $model,
        'cargos' => $cargos,
        'curriculosEndereco' => $curriculosEndereco,
        'curriculosFormacao' => $curriculosFormacao,
        'modelsComplementos' => (empty($modelsComplementos)) ? [new CurriculosComplementos] : $modelsComplementos,
        'modelsEmpregos' => (empty($modelsEmpregos)) ? [new CurriculosEmpregos] : $modelsEmpregos
    ])
?>

