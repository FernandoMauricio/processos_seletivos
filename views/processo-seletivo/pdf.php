<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Adendos;
use app\models\Anexos;
use app\models\Edital;
use app\models\Resultados;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

?>


<?php

//RESGATANDO AS INFORMAÇÕES DA ABERTURA DE VAGAS
$id = $model->id;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listagem de Anexos</title>
<style type="text/css">
#titulo {
	font-size: 16px;
	color: #F60;

}
</style>
</head>

<body>
<table width="100%" border="1" bordercolor="#ddd">
  <tr>
    <th height="97" id="titulo" bgcolor="#ddd" scope="col"><div align="center">DOCUMENTOS PARA DOWNLOAD</div></th>
  </tr>
  <tr>
    <td id="titulo"><p><br>LISTA DE EDITAIS</p>
      <p>
        
    <?php

  $query_edital = "SELECT * FROM edital WHERE processo_id = '".$id."' ";
  $edital = Edital::findBySql($query_edital)->all(); 
  foreach ($edital as $editals) {
     
     $Editals = $editals["edital"];

     $arquivoEditals = substr($Editals, strrpos($Editals, '/') + 1);

   ?>
          <?php echo "<div class='row'>";?>
          <?php echo '<a href="../web/uploads/editais/'.$arquivoEditals.'" target="_blank">';?>
          <?php echo "<button type='button' class='btn btn-link'></button>"?><?php echo $arquivoEditals; ?>
          <?php echo "</div></a>";

            }
    ?>

      </p></td>
  </tr>

  <tr>
    <td id="titulo"><p><br>LISTA DE ANEXOS</p>
      <p>
        
    <?php

  $query_anexo = "SELECT * FROM anexos WHERE processo_id = '".$id."' ";
  $anexo = Anexos::findBySql($query_anexo)->all(); 
  foreach ($anexo as $anexos) {
     
     $Anexos = $anexos["anexo"];

     $arquivoAnexos = substr($Anexos, strrpos($Anexos, '/') + 1);

   ?>
          <?php echo "<div class='row'>";?>
          <?php echo '<a href="../web/uploads/anexos/'.$arquivoAnexos.'" target="_blank">';?>
          <?php echo "<button type='button' class='btn btn-link'></button>"?><?php echo $arquivoAnexos; ?>
          <?php echo "</div></a>";

            }
    ?>

      </p></td>
  </tr>

  <tr>
    <td id="titulo"><p><br>LISTA DE ADENDOS</p>
      <p>
        
    <?php

  $query_adendo = "SELECT * FROM adendos WHERE processo_id = '".$id."' ";
  $adendo = Adendos::findBySql($query_adendo)->all(); 
  foreach ($adendo as $adendos) {
     
     $Adendos = $adendos["adendos"];

     $arquivoAdendos = substr($Adendos, strrpos($Adendos, '/') + 1);

   ?>
          <?php echo "<div class='row'>";?>
          <?php echo '<a href="../web/uploads/adendos/'.$arquivoAdendos.'" target="_blank">';?>
          <?php echo "<button type='button' class='btn btn-link'></button>"?><?php echo $arquivoAdendos; ?>
          <?php echo "</div></a>";

            }
    ?>

      </p></td>
  </tr>

  <tr>
    <td id="titulo"><p><br>LISTAS DE RESULTADOS</p>
      <p>
        
    <?php

  $query_resultados = "SELECT * FROM resultados WHERE processo_id = '".$id."' ";
  $resultado = Resultados::findBySql($query_resultados)->all(); 
  foreach ($resultado as $resultados) {
     
     $Resultados = $resultados["resultado"];

     $arquivoResultados = substr($Resultados, strrpos($Resultados, '/') + 1);

   ?>
          <?php echo "<div class='row'>";?>
          <?php echo '<a href="../web/uploads/resultados/'.$arquivoResultados.'" target="_blank">';?>
          <?php echo "<button type='button' class='btn btn-link'></button>"?><?php echo $arquivoResultados; ?>
          <?php echo "</div></a>";

            }
    ?>

      </p></td>
  </tr>

</table>
</body>
</html>
