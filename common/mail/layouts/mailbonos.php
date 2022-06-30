<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
date_default_timezone_set('America/Guayaquil');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <table>
       <tbody width="600">
        <tr>
            <td><img src="http://www.cpn.fin.ec/frontend/web/images/logo_cpn.jpg"> </td>
        </tr> 
        <tr>
            <td style="text-align:center; font-size:14px; font-weight: bold;">Nueva Solicitud (Formulario Bono escolar Sierra)</td>
        </tr> 
       <tbody>
   </table>
   <table  width="600">
       <tbody>
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Nombre Rep.</td>
            <td style="text-align:left; font-size:12px;"><?=$model->nombresrep ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Número de Ced.</td>
            <td style="text-align:left; font-size:12px;"><?=$model->cedularep ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Nombre Socio F.</td>
            <td style="text-align:left; font-size:12px;"><?=$model->nombresocio ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Cédula Socio F.</td>
            <td style="text-align:left; font-size:12px;"><?=$model->cedulasocio ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Provincia</td>
            <td style="text-align:left; font-size:12px;"><?=$model->provincia0->nombre ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Dirección</td>
            <td style="text-align:left; font-size:12px;"><?=$model->direccion ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Celular</td>
            <td style="text-align:left; font-size:12px;"><?=$model->celular ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Teléfono</td>
            <td style="text-align:left; font-size:12px;"><?=$model->telefono ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Correo</td>
            <td style="text-align:left; font-size:12px;"><?=$model->correo ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Nombre Hijo 1</td>
            <td style="text-align:left; font-size:12px;"><?=$model->nombrehijo ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Céd. Hijo 1</td>
            <td style="text-align:left; font-size:12px;"><?=$model->cedulahijo ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Grado académico</td>
            <td style="text-align:left; font-size:12px;"><?=$model->gradoac ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Nombre Hijo 2</td>
            <td style="text-align:left; font-size:12px;"><?=$model->nombrehijo2 ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Céd. Hijo 2</td>
            <td style="text-align:left; font-size:12px;"><?=$model->cedulahijo2 ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Grado académico</td>
            <td style="text-align:left; font-size:12px;"><?=$model->gradoac2 ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Nombre Hijo 3</td>
            <td style="text-align:left; font-size:12px;"><?=$model->nombrehijo3 ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Céd. Hijo 3</td>
            <td style="text-align:left; font-size:12px;"><?=$model->cedulahijo3 ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Grado académico</td>
            <td style="text-align:left; font-size:12px;"><?=$model->gradoac3 ?></td>
        </tr> 
        <tr>
            <td style="text-align:left; font-size:12px; font-weight: bold;">Fecha creación</td>
            <td style="text-align:left; font-size:12px;"><?=date("Y/m/d H:i:s") ?></td>
        </tr> 
       <tbody>
   </table>
   <table>
       <tbody width="600">
        <tr>
            <td><img src="http://www.cpn.fin.ec/frontend/web/images/pie_cpn.jpg"> </td>
        </tr> 
        <tr>
            <td style="text-align:center; font-size:10px;">Creado por FCB&FIRE. Todos los derechos reservados. 2019.</td>
        </tr> 
       <tbody>
   </table>
</body>
</html>

