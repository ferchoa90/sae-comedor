<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 06/09/21
 * Time: 22:22
 */

class Contenido extends Component
{

    public function getContenidoArray($objetos)
    {
        echo '<div class="row" style="line-height:30px;">';
        foreach($objetos as $obj):
            //var_dump($objetos);

            switch ($obj['tipo']) {
                case 'div':
                    echo $this->getDiv($obj['nombre'],$obj['id'],$obj['titulo'],$obj['clase'],$obj['style'],$obj['col'],$obj['tipocolor'],$obj['adicional'],$obj['contenido']);
                    break;

                case 'separador':
                    echo $this->getSeparador($obj['clase'],$obj['estilo'], $obj['color']);
                    break;
                default:

                    break;
            }

        endforeach;
        echo '</div>';
    }

    public function getContenidoArrayr($objetos)
    {
        $contenido="";
        $init='<div class="row"  style="line-height:30px;">';
        foreach($objetos as $obj):
            //var_dump($objetos);

            switch ($obj['tipo']) {
                case 'div':
                    $contenido.= $this->getDiv($obj['nombre'],$obj['id'],$obj['titulo'],$obj['clase'],$obj['style'],$obj['col'],$obj['tipocolor'],$obj['adicional'],$obj['contenido']);
                    break;

                case 'image':
                    $this->declareCss($obj['id']);
                    $this->registrarJs($obj['id']);
                    $contenido.= $this->getImage($obj['subtipo'],$obj['nombre'], $obj['id'], $obj['src'], $obj['clase'], $obj['estilo'],$obj['etiqueta'], $obj['col'], $obj['adicional']);
                    break;

                case 'separador':
                    $contenido.= '</div>'.$this->getSeparador($obj['clase'],$obj['estilo'], $obj['color']).$init;
                    break;
                default:

                    break;
            }

        endforeach;
        $contenidofinal=$init.$contenido.'</div>';
        return $contenidofinal;
    }

    private static function getImage($subtipo='',$nombre='', $id='',$src='', $clase='', $style='',$titulo='',  $col='' , $adicional)
    {
        $classdefault='';
        $tipocolordefault='card card-primary';
        $modal='';

        switch ($subtipo) {
            case 'popup':
                $modal='';
                break;

            case '':
                $tipocolor='card card-success';
                break;

            default:
                //$tipocolor=$tipocolordefault;
                break;
        }

        switch ($clase) {
            case !'':
                $clase=$clase;
                break;

            default:
                $clase=$classdefault;
                break;
        }
        if ($src){
            $image='<img class="col-12" src="/frontend/web/images/articulos/'.$src.'"  id="'.$id.'" name="'.$nombre.'"  />';
        }else{
            $image='';
        }
        $idn=str_replace("-","",$id);
        $modal='<div id="myModal'.$idn.'" class="modal'.$idn.'"><img class="modal-content" id="img'.$idn.'"></div>';
        $div='<div style="'.$style.'" class="'.$clase.' '.$col.'">
        <div class="col-12 text-center"><b>'.$titulo.' </b></div>
        <div class="col-12">'.$image.'</div>
        </div>'.$modal;

        $resultado=$div;
        return $resultado;
    }

    public function declareCss($id)
    {
        //$this->registerCssFile('@web/css/ccalendar.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
        $idn=str_replace("-","",$id);
        $modal='modal'.$idn;
        $cssnew= <<< CSS
$id {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            display: block;
            margin-left: auto;
            margin-right: auto
            }
            $id:hover {opacity: 0.7;}

.$modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1111; /* Sit on top */
    padding-top: 2%; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 75%;
    //max-width: 75%;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

.out {
  animation-name: zoom-out;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(1)}
    to {-webkit-transform:scale(2)}
}

@keyframes zoom {
    from {transform:scale(0.4)}
    to {transform:scale(1)}
}

@keyframes zoom-out {
    from {transform:scale(1)}
    to {transform:scale(0)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
CSS;
Yii::$app->getView()->registerCss($cssnew, \yii\web\View::POS_END);
        //Yii::$app()->clientScript->registerCss('customCSS',$css );
       // echo 'hola';
        return true;
    }

    private static function registrarJs($id){
        $idn=str_replace("-","",$id);
        $modal='modal'.$idn;
    $script = <<< JS
    var modal = document.getElementById('myModal$idn');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('$id');
var modalImg = document.getElementById("img$idn");
var captionText = document.getElementById("caption$idn");

if (img){
    img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    modalImg.alt = this.alt;
    //captionText.innerHTML = this.alt;
    }
}





// When the user clicks on <span> (x), close the modal
modal.onclick = function() {
    modalImg.className += " out";
    setTimeout(function() {
       modal.style.display = "none";
       modalImg.className = "modal-content";
     }, 400);

 }
JS;
Yii::$app->getView()->registerJs($script, \yii\web\View::POS_END);
    }


    private static function getDiv($nombre='', $id='', $titulo='', $clase='', $style='', $col='',$tipocolor='', $adicional,$contenido='')
    {
        $classdefault='';
        $tipocolordefault='card card-primary';

        switch ($tipocolor) {
            case 'azul':
                $tipocolor='card card-primary';
                break;

            case 'verde':
                $tipocolor='card card-success';
                break;

            case 'rojo':
                $tipocolor='card card-danger';
                break;

            case 'verdesuave':
                $tipocolor='card card-info';
                break;

            case 'amarillo':
                $tipocolor='card card-warning';
                break;

            case 'plomo' || 'gris':
                $tipocolor='card card-secondary';
                break;

            default:
                $tipocolor=$tipocolordefault;
                break;
        }

        switch ($clase) {
            case !'':
                $clase=$clase;
                break;

            default:
                $clase=$classdefault;
                break;
        }

        $div='<div style="'.$style.'" id="div-'.$clase.'" name="div-'.$clase.'" class="'.$clase.' '.$col.'"><b>'.$titulo.' </b> '.$contenido.'</div>';
        $resultado=$div;
        return $resultado;
    }

    public function getSeparador($clase='',$estilo='', $color='')
    {
        switch ($color) {
            case !'':
                return '<hr style="color: '.$color.'" />';
                break;

            default:
                return '<hr  style="color: #0056b2;" />';
                break;
        }
    }
}