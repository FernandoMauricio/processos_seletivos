<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Curriculos;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

$session = Yii::$app->session;
$id = $_GET['id'];

//RESGATANDO AS INFORMAÇÕES DO CURRICULO

$sql_curriculos = "SELECT * FROM info_curriculo WHERE cv_id = ".$id."";
  $curriculos = Curriculos::findBySql($sql_curriculos)->all(); 
  foreach ($curriculos as $curriculo) {
     
     $cv_id = $curriculo["cv_id"];
     $cv_numeroEdital = $curriculo["cv_numeroEdital"];
     $cv_cargo = $curriculo["cv_cargo"];
     $cv_nome = $curriculo["cv_nome"];
     $cv_datanascimento = $curriculo["cv_datanascimento"];
     $cv_email = $curriculo["cv_email"];
     $cv_telefone = $curriculo["cv_telefone"];
     $cv_resumocv = $curriculo["cv_resumocv"];
     $cv_data = $curriculo["cv_data"];
     $cv_email2 = $curriculo["cv_email2"];
     $cv_telefone2 = $curriculo["cv_telefone2"];
   }


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table width="100%" border="1">
  <tr>
    <th width="19%" scope="col">ID: <?php echo $cv_id; ?></th>
    <th width="39%" scope="col">Nº Edital: <?php echo $cv_numeroEdital; ?></th>
    <th width="42%" scope="col">Data Cadastro: <?php echo date('d/m/Y', strtotime($cv_data)); ?></th>
  </tr>
  <tr>
    <td colspan="3"><strong>Cargo:</strong> <?php echo $cv_cargo; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Nome:</strong> <?php echo $cv_nome; ?></td>
    <td><strong>Data Nascimento:</strong> <?php echo date('d/m/Y', strtotime($cv_datanascimento)); ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Email:</strong> <?php echo $cv_email; ?></td>
    <td><strong>Email(Alternativo):</strong> <?php echo $cv_email2; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Telefone:</strong> <?php echo $cv_telefone; ?></td>
    <td><strong>Telefone(Alternativo):</strong> <?php echo $cv_telefone2; ?></td>
  </tr>
  <tr>
    <td colspan="3"><h3>Resumo do Currículo</h3><br>
    <p><?php echo $cv_resumocv; ?></p></td>
  </tr>
</table>


</body>
</html>







<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<met4a http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table width="100%" border="1" bordercolor="#ddd">
  <tr>
    <th height="92" id="titulo" bgcolor="#ddd"><div align="center"> RESUMO DO CURRÍCULO</div></th>
  </tr>
  <tr>
    <td height="759" id="linhas"><p></p></td>
  </tr>
</table>
</body>
</html> -->