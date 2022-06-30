<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 17/03/22
 * Time: 22:29
 */

class Archivos extends Component
{
    public $ruta;
    public $tamanio;
    public $tipoarchivo;
    public $formatosdefecto;

    function __construct($ruta='',$tamanio='',$tipoarchivo='',$formatosdefecto='')
    {
        //$rutadefecto='E:/xampp-new/htdocs/sae-globalmed/backend/web/images/pedidos/';
        $rutadefecto='E:/xampp-new/htdocs/sae-cafeteria/frontend/web/images/articulos/';
        //$rutadefectoprod = '/var/www/html/frontend/web/images/pedidos/';
        $tamaniodefecto="100000000"; //MB
        $tipoarchivodefecto="*.jpg|*.png|*.gif|";
        $this->ruta=$rutadefecto;
        $this->tamanio=$tamaniodefecto;
        $this->tipoarchivo=$tipoarchivo;
        $this->formatosdefecto=$formatosdefecto;
    }

    public function Subirarchivo($archivo,$sobreescribir=true,$modulo="")
    {
        //$this->ruta = '/xampp-new/htdocs/cpn2/frontend/web/images/';
        $target_dir = $this->ruta;
        //echo $this->ruta;
        //var_dump($archivo);
       if($archivo) {

            $target_file = $target_dir . basename($archivo["name"]);
            $nombreArchivo=basename($archivo["name"]);
            $uploadOk = 0;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
                $check = getimagesize($archivo["tmp_name"]);
                //var_dump($check);
                if($check != false) {
                    //echo "File is an image - " . $check["mime"] . ".";

                    $uploadOk = 1;
                } else {
                    //echo "File is not an image.";
                    $return=array("success"=>false,"Mensaje"=>"El archivo no es una imagen.");
                    $uploadOk = 0;
                }
            // Check if file already exists
            if ($sobreescribir==false)
            {
                if (file_exists($target_file)) {
                    //echo "Sorry, file already exists.";
                    $return=array("success"=>false,"Mensaje"=>"La imagen ya existe en el repositorio.");
                    $uploadOk = 0;
                }
            }

            // Check file size
            if ($archivo["size"] > $this->tamanio) {
                $return=array("success"=>false,"Mensaje"=>"La imagen subida excede el límite de tamaño.");
                //echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $return=array("success"=>false,"Mensaje"=>"El archivo debe se una imagen válida. Extensión: ".$imageFileType);
                $uploadOk = 0;
            }

            //var_dump($return);
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $return=array("success"=>false,"Mensaje"=> $return["Mensaje"]);
                //echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                //echo move_uploaded_file($archivo["tmp_name"], $target_file);
                //echo  $archivo["tmp_name"];
                $upload=copy($archivo["tmp_name"], $target_file);
                //var_dump($upload);
                if ($upload) {
                    $return=array("success"=>true,"mensaje"=>"Imagen subida.","nombrearchivo"=>$nombreArchivo);
                    //$return=array("success"=>"true","Mensaje"=>"OK");
                    //echo json_encode($return);
                    //echo "The file ". basename( $value["name"]). " has been uploaded.";
                } else {
                    $return=array(["success"=>false,"mensaje"=>$return]);
                }
            }
        }
        return $return;
    }

    public function auditoria(){

    }


}