<?php
namespace backend\components;
use yii\helpers\Url;
use yii\helpers\Html;
use Yii;
use yii\web\View;
use backend\assets\AppAsset;
use yii\base\Component;
use yii\base\InvalidConfigException;
use backend\models\User;
use backend\models\Configuracion;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 06/09/21
 * Time: 22:22
 */

class Grid extends Component
{

    public function getGrid($objetos,$return=false)
    {
        $resultado;

           // var_dump($objetos['tipo']);

//echo $objetos;
        switch ($objetos[0]['tipo']) {
            case 'datagrid':
                $resultado.= $this->getGridBoostrap($objetos,$objetos[0]['tipo'],$objetos[0]['nombre'], $objetos[0]['id'], $objetos[0]['columnas'], $objetos[0]['clase'], $objetos[0]['estilo'], $objetos[0]['col'], $objetos[0]['adicional'], $objetos[0]['url']);
                break;

            case 'separador':
                $resultado.= $this->getSeparador($objetos[0]['clase'],$objetos[0]['estilo'], $objetos[0]['color']);
                break;

            case 'datagridsimple':
                $resultado.= $this->getGridBoostrap2($objetos,$objetos[0]['cabecera'],$objetos[0]['contenido'],$objetos[0]['pie'],$objetos[0]['data'],$objetos[0]['nombre'], $objetos[0]['id'], $objetos[0]['clase'], $objetos[0]['estilo'], $objetos[0]['col'], $objetos[0]['adicional']);

                break;

            default:

                break;
        }

        if ($return)
        {
            return $resultado;
        }else{
            echo $resultado;
        }
    }

    public function getGridBoostrap2($objetos, $cabecera,$contenido,$pie,$data, $nombre='', $id='', $clase='', $estilo='', $col='', $adicional='')
    {
        $result='';
        $tablein='<table class="table table-striped">';
        $tableend='</table>';
        $theadin='<thead><tr>';
        $theadend='</tr><thead>';
        $tbodyin='<tbody>';
        $tbodyend='<tbody>';
        $trin='<tr>';
        $trout='</tr>';
        $thheadconten='';

        $contcol=0;
       // print_r($contenido[1]);
        foreach ($cabecera as $key => $value) {
             $contcol++;
             $thheadconten.='<th scope="col" class="'.$value["clase"].'">'.$value["titulo"].'</th>';
        }

        $thbodyconten='';
        $controw=0;

        /*foreach ($contenido as $key => $value) {
            if ($controw==0){ $thbodyconten.=$trin; }
            $thbodyconten.='<td scope="col" class="'.$value["clase"].'">'.$value["titulo"].'</td>';
            if ($contcol==$controw){ $thbodyconten.=$trout; $controw=0; }
        }*/

        foreach ($data as $key => $value) {
            //echo array_keys($value)."\n";

            $thbodyconten.=$trin;
            foreach ($contenido as  $valueC) {
                $thbodyconten.='<td scope="col" >'.$value[$valueC].'</td>';

            }
            $thbodyconten.=$trout;
            $contcol++;
        }
        $result=$tablein.$theadin.$thheadconten.$theadend.$tbodyin.$thbodyconten.$tbodyend.$tableend;
        if ($contcol>5){
            $divscroll='<div class="col-12 col-md-12" style="position: relative;height: 300px;overflow: auto; padding-top:1%;"> ';
            $divscrollend='</div> ';
            $result=$divscroll.$tablein.$theadin.$thheadconten.$theadend.$tbodyin.$thbodyconten.$tbodyend.$tableend.$divscrollend;

         }
        return $result;
    }

    public function getGridBoostrap($objetos, $tipo, $nombre='', $id='',$columnas='', $clase='', $estilo='', $col='', $adicional='',$url)
    {

        $input='';
        $iddefault='table';
        $nombredefault='table';
        (!$id)? $id=$iddefault : $id=$id;
        (!$nombre)? $nombre=$nombredefault : $nombre=$nombre;
        (!$clase)? $clase=$classdefault : $clase=$clase;
        $classdefault='table table-striped table-bordered table-hover';
        $boxbody='<div class="box-body">';
        $enddiv='</div>';
        $columnas='';

        foreach($objetos[0]['columnas'] as $col):

            $columnas.='<th >'.$col['columna'].'</th>';

        endforeach;
//echo $columnas;
        $contentTable='<table id="'.$nombre.'"  name="'.$id.'" class="'.$classdefault.'"><thead><tr class="tableheader">'.$columnas.'</tr></thead><tbody></tbody> </table>';

        $resultado='
        <div class="card">
            <div id="bodydiv" class="card-body">
                <table id="'.$nombre.'"  name="'.$id.'" class="'.$classdefault.'">
                    <thead>
                    <tr class="tableheader ">
                    '.$columnas.'
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div><!-- /.box -->
        </div>
       ';

        if ($boxbody):
            $resultado=$resultado;
        endif;
        $this->getRegistrarJS($nombre,$objetos[0]['url'],$objetos[0]['columnas'],$contentTable);
        return $resultado;

    }

    public function getRegistrarJS($nombre,$url,$datareg,$contentTable)
    {
        //$urlrefer=$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
        $urlrefer=$_SERVER["REQUEST_URI"];
        $token=Yii::$app->request->getCsrfToken();
        $urlfinal= explode("/",$urlrefer);
        foreach ($urlfinal  as $value) {
            $urlfinal=$value;
        }
        $urlfinal2=$urlrefer;
        $urlfinal=str_replace("/".$urlfinal,"",$urlrefer);
        $data='';
        foreach ($datareg as $value) {
            $data.='{ "data": "'.$value['datareg'].'" },';
        }
       // echo $urlfinal;

        $script = <<< JS
function deleteReg(id) {
    var id_reg = id;
    urlflag=false;
    console.log('url2: '+'$urlfinal')
    //console.log(id)
    swal({
            title: "Eliminar Registro",
            text: "Esta seguro de eliminar el registro?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#32bc38",
            confirmButtonText: "Continuar",
            closeOnConfirm: true
        },
        function () {
            var url =  '$urlfinal2' + "eliminar?id=" + id_reg;
            //var url =  '/$urlfinal';
            $.post(url, {
                '_csrf-frontend': '$token'
            }).done(function (data) {
                loading(0);
                //$.notify('Registro eliminado', "success");
                notificacion("Registro eliminado","success");
                //$('#$nombre').DataTable().clear().draw();
                //$('#$nombre').table.fnDestroy();
                 $('#bodydiv').html('$contentTable');
                init();

            }).fail(function() {
                notificacion("Error al enviar la información","error");
            });
        });
}
var ref="";
function init()
{
    loading(1);

var url = '$url';
    $.post(url, { '_csrf-backend': '$token', '_csrf-frontend': '$token' })
    .done(function(data) {
    var data = JSON.parse(data);
       $('$nombre').DataTable({
            "paging": true,
            "fixedHeader": true,
            "lengthChange": true,
            "scrollX": true,
            "colReorder": true,
            "searching": true,
            "orderCellsTop": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "retrieve": true,
            "pageLength": 20,
            "data": data,
            "aaSorting": [],
            "language": {
                "search": "Buscar: ",
                "zeroRecords": "No se encontraron registros para la búsqueda.",
                "info": "Página _PAGE_ de _PAGES_ |  Total: _MAX_ registros",
                "infoEmpty": "No existen registros.",
                "lengthMenu": "Registros por página  _MENU_",
                "infoFiltered": "(Filtrado de _MAX_ registros).",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "paginate": {
                        "first": "Inicio",
                    "last": "Final",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            },
            "columns": [
                    $data
            ]
        });
        loading(0);
    });
}
$(document).ready(function () {
//alert('$nombre')
   init();
    });
JS;
Yii::$app->getView()->registerJs($script, \yii\web\View::POS_END);
    }


}