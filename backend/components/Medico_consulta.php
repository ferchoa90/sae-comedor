<?php
namespace backend\components;
use Yii;
use common\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Roles;
use common\models\Rolespermisos;
use backend\components\Log_errores;
use backend\components\Archivos;
use common\models\Consultamedica;
use common\models\Consultamedicadet;
use common\models\Citasmedicas;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 13/03/21
 * Time: 14:55
 */

class Medico_consulta extends Component
{
    const MODULO='CONSULTA';

    public function getConsultamedica($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Consultamedica::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Consultamedica::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getPaciente($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result = Consultamedica::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["apellidos" => SORT_ASC])->one();
            if ($result)
            {
                //$result=$result["nombres"].' '.$result["apellidos"].')';
                return $result;
            }else{
                $result="NINGUNO";
            }
        }else{
            $result= false;
        }
        return $result;
    }

    public function getHistoriaclinica($idpaciente,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($idpaciente){
            $result = Consultamedica::find()->where(["idpaciente"=>$idpaciente,"isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["fechacreacion" => SORT_DESC])->all();
            if ($result)
            {
                return $result;
            }else{
                $result="NINGUNO";
            }
        }else{
            $result= false;
        }
        return $result;
    }


    public function getSelect()
    {
        $clientes = Consultamedica::find()->where(["isDeleted" => 0])->orderBy(["apellidos" => SORT_ASC])->all();
        //var_dump($clientes);
        $clientesArray=array();
        $cont=0;
        foreach ($clientes as $key => $value) {
            if ($cont==0){ $clientesArray[$cont]["value"]="Seleccione un paciente"; $clientesArray[$cont]["id"]=-1; $cont++; }
            $clientesArray[$cont]["value"]=$value->apellidos.' '.$value->nombres;
            $clientesArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $clientesArray;

    }

    public function Nuevo($data)
    {
        //$date = date("Y-m-d H:i:s");
        $idusuario=0;
        $idmodulo=0;
        $model= new Consultamedica;
        $result=false;

        $consultamed=Consultamedica::find()->where(["idcitamedica" => $data['idcita']])->one();
        if ($consultamed){
            $data['idconsultam']=$consultamed->id;
            $result= $this->Editar($data);
            return $result;
        }else{
            $citamedica=Citasmedicas::find()->where(["id" => $data['idcita']])->one();
            if ($data && $citamedica):
                $model->idpaciente=$data['idpaciente'];
                $model->idcitamedica=$data['idcita'];
                $model->fechacita=$citamedica->fechacita;
                $model->fechainatencion=date("Y-m-d h:i:s");
                $model->observacion="-";
                $model->horacita=$citamedica->horacita;
                $model->iddoctor=$data['iddoctor'];
                $model->idoptometrista=$data['idoptometrista'];
                $model->usuariocreacion=Yii::$app->user->identity->id;
                $model->estatus="ACTIVO";
                $model->isDeleted=0;
                if ($model->save()) {
                    $modeldetalle= new Consultamedicadet;
                    $modeldetalle->idconsulta=$model->id;

                    $modeldetalle->usolentes=$data['usolentes'];
                    $modeldetalle->causaconsulta=$data['motivo'];

                    $modeldetalle->agudezavscod=$data['agudezavscod'];
                    $modeldetalle->agudezavscoi=$data['agudezavscoi'];
                    $modeldetalle->agudezavcod=$data['agudezavcod'];
                    $modeldetalle->agudezavcoi=$data['agudezavcoi'];
                    $modeldetalle->agudezavotr=$data['agudezavscotr'];

                    $modeldetalle->visioncscod=$data['visioncercascod'];
                    $modeldetalle->visioncosci=$data['visioncercascoi'];
                    $modeldetalle->visionccod=$data['visioncercaccod'];
                    $modeldetalle->visionccid=$data['visioncercaccoi'];
                    $modeldetalle->visioncotr=$data['visioncercaotr'];

                    $modeldetalle->visionlscod=$data['visionlejosscod'];
                    $modeldetalle->visionlscoi=$data['visionlejosscoi'];
                    $modeldetalle->visionlcod=$data['visionlejosccod'];
                    $modeldetalle->visionlcoi=$data['visionlejosccoi'];
                    $modeldetalle->visionlcotr=$data['visionlejosotr'];

                    $modeldetalle->pioscod=$data['pioscod'];
                    $modeldetalle->pioscoi=$data['pioscoi'];
                    $modeldetalle->piocod=$data['piocod'];
                    $modeldetalle->piocoi=$data['piocoi'];
                    $modeldetalle->piootr=$data['piocotr'];

                    $modeldetalle->biomicroscopia=$data['microboscopia'];
                    $modeldetalle->visiondecolores=$data['visioncolores'];
                    $modeldetalle->visionprofundidad=$data['visionprof'];
                    $modeldetalle->reflejospup=$data['refloejospupi'];
                    $modeldetalle->campovisual=$data['campovisual'];
                    $modeldetalle->fondoojood=$data['fondoojood'];
                    $modeldetalle->fondoojooi=$data['fondoojooi'];
                    $modeldetalle->agujeroest=$data['agujeroest'];

                    $modeldetalle->examenes=$data['examenes'];

                    $modeldetalle->impdiag1=$data['impresion1'];
                    $modeldetalle->impdiag2=$data['impresion2'];
                    $modeldetalle->impdiag3=$data['impresion3'];
                    $modeldetalle->cie1001=$data['cie1'];
                    $modeldetalle->cie1002=$data['cie2'];
                    $modeldetalle->cie1003=$data['cie3'];

                    $modeldetalle->campim=$data['camping'];
                    $modeldetalle->octangular=$data['octangular'];
                    $modeldetalle->octm=$data['octm'];
                    $modeldetalle->octn=$data['octn'];
                    $modeldetalle->biood=$data['biometod'];
                    $modeldetalle->bioid=$data['biometoi'];
                    $modeldetalle->paquimod=$data['paquimod'];
                    $modeldetalle->paquimid=$data['paquimoi'];
                    $modeldetalle->ora=$data['ora'];
                    $modeldetalle->topografia=$data['topografia'];
                    $modeldetalle->angiog=$data['angioog'];
                    $modeldetalle->ecogra=$data['ecogra'];
                    $modeldetalle->endote=$data['endote'];
                    $modeldetalle->ubm=$data['ubm'];
                    $modeldetalle->retinografia=$data['retinografia'];

                    $modeldetalle->usuariocreacion=Yii::$app->user->identity->id;
                    $modeldetalle->estatus="ACTIVO";
                    $modeldetalle->isDeleted=0;
                    $archivoM= new Archivos;
                    //var_dump($_FILES["img1"]);
                    if ($_FILES){
                        $archivo=$archivoM->Subirarchivo(array($_FILES["img1"]));
                        //var_dump($archivo);
                        $modeldetalle->img1=$archivo["nombrearchivo"];
                        $archivo=$archivoM->Subirarchivo(array($_FILES["img2"]));
                        $modeldetalle->img2=$archivo["nombrearchivo"];
                        $archivo=$archivoM->Subirarchivo(array($_FILES["img3"]));
                        $modeldetalle->img3=$archivo["nombrearchivo"];
                        $archivo=$archivoM->Subirarchivo(array($_FILES["img4"]));
                        $modeldetalle->img4=$archivo["nombrearchivo"];
                        $archivo=$archivoM->Subirarchivo(array($_FILES["img5"]));
                        $modeldetalle->img5=$archivo["nombrearchivo"];
                    }


                    if ($modeldetalle->save()) {
                        $error=false;
                        return array("response" => true, "id" => $model->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
                    }else{
                        $this->callback(1,$idusuario,$modeldetalle->errors);
                        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);

                    }
                    //$this->callback(1,$idusuario,$model->errors);
                } else {
                    $this->callback(1,$idusuario,$model->errors);
                    return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
                }
            else:
                $log= new Log_errores;
                $observacion="ID: 0";
                $error="NO POST";
                $log->Nuevo(self::MODULO." :: Medico_consultamedica ",$error,$observacion,0,Yii::$app->user->identity->id);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            endif;
        }
        //var_dump($citamedica);


        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editar($data)
    {
        $id=0;
        $result=false;
        if ($data):
            $model= Consultamedicadet::find()->where(["id"=>$data['idconsultam']])->one();
            $model->causaconsulta=$data['motivo'];
            $model->agudezavscod=$data['agudezavscod'];
            $model->agudezavscoi=$data['agudezavscoi'];
            $model->agudezavcod=$data['agudezavcod'];
            $model->agudezavcoi=$data['agudezavcoi'];
            $model->agudezavotr=$data['agudezavscotr'];

            $model->visioncscod=$data['visioncercascod'];
            $model->visioncosci=$data['visioncercascoi'];
            $model->visionccod=$data['visioncercaccod'];
            $model->visionccid=$data['visioncercaccoi'];
            $model->visioncotr=$data['visioncercaotr'];

            $model->visionlscod=$data['visionlejosscod'];
            $model->visionlscoi=$data['visionlejosscoi'];
            $model->visionlcod=$data['visionlejosccod'];
            $model->visionlcoi=$data['visionlejosccoi'];
            $model->visionlcotr=$data['visionlejosotr'];

            $model->pioscod=$data['pioscod'];
            $model->pioscoi=$data['pioscoi'];
            $model->piocod=$data['piocod'];
            $model->piocoi=$data['piocoi'];
            $model->piootr=$data['piocotr'];

            $model->biomicroscopia=$data['microboscopia'];
            $model->visiondecolores=$data['visioncolores'];
            $model->visionprofundidad=$data['visionprof'];
            $model->reflejospup=$data['refloejospupi'];
            $model->campovisual=$data['campovisual'];
            $model->fondoojood=$data['fondoojood'];
            $model->fondoojooi=$data['fondoojooi'];
            $model->agujeroest=$data['agujeroest'];

            $model->examenes=$data['examenes'];

            $model->impdiag1=$data['impresion1'];
            $model->impdiag2=$data['impresion2'];
            $model->impdiag3=$data['impresion3'];
            $model->cie1001=$data['cie1'];
            $model->cie1002=$data['cie2'];
            $model->cie1003=$data['cie3'];

            $model->campim=$data['camping'];
            $model->octangular=$data['octangular'];
            $model->octm=$data['octm'];
            $model->octn=$data['octn'];
            $model->biood=$data['biometod'];
            $model->bioid=$data['biometoi'];
            $model->paquimod=$data['paquimod'];
            $model->paquimid=$data['paquimoi'];
            $model->ora=$data['ora'];
            $model->topografia=$data['topografia'];
            $model->angiog=$data['angioog'];
            $model->ecogra=$data['ecogra'];
            $model->endote=$data['endote'];
            $model->ubm=$data['ubm'];
            $model->retinografia=$data['retinografia'];
            $model->usuarioact=Yii::$app->user->identity->id;
            $model->fechaact= date("Y-m-d H:i:s");

            $archivoM= new Archivos;
            //var_dump($_FILES["img1"]);
            if ($_FILES){
                $archivo=$archivoM->Subirarchivo(array($_FILES["img1"]));
                //var_dump($archivo);
                $model->img1=$archivo["nombrearchivo"];
                $archivo=$archivoM->Subirarchivo(array($_FILES["img2"]));
                $model->img2=$archivo["nombrearchivo"];
                $archivo=$archivoM->Subirarchivo(array($_FILES["img3"]));
                $model->img3=$archivo["nombrearchivo"];
                $archivo=$archivoM->Subirarchivo(array($_FILES["img4"]));
                $model->img4=$archivo["nombrearchivo"];
                $archivo=$archivoM->Subirarchivo(array($_FILES["img5"]));
                $model->img5=$archivo["nombrearchivo"];
            }



            if ($model->save()) {
                $error=false;
                return array("response" => true, "id" => $model->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Medico_consultamedica -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
    }

    public function Eliminar($id)
    {
        //$date = date("Y-m-d H:i:s");
        $result=false;
        if ($id):
            //$data = $usuario;
            $data= Consultamedica::find()->where(["id"=>$id])->one();
            $data->isDeleted=1;
            if ($data->save()) {
                $error=false;
                return array("response" => true, "id" => $data->id, "mensaje"=> "Registro eliminado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$data->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO ID";
            $log->Nuevo(self::MODULO." :: Medico_consultamedica -> eliminar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
    }

    public function Nuevaficha($data)
    {
        //$date = date("Y-m-d H:i:s");
        $idusuario=0;
        $idmodulo=0;
        $model= new Consultamedica;
        $result=false;
        if ($data):
            $model->nombres=$data['nombres'];
            $model->apellidos=$data['apellidos'];
            $model->cedula=$data['cedula'];
            $model->idgenero=$data['genero'];
            $model->idciudad=$data['ciudad'];
            $model->direccion=$data['direccion'];
            $model->correo=$data['correo'];
            $model->alerta=$data['alerta'];
            $model->fechanac=$data['fechanac'];
            $model->idprofesion=$data['profesion'];
            $model->tiposangre=$data['tiposangre'];
            $model->antecedentesp=$data['antecedentesp'];
            $model->antecedenteso=$data['antecedenteso'];
            $model->antecedentesf=$data['antecedentesf'];
            $model->enfermedada=$data['enfermedada'];
            $model->antecedentesf=$data['antecedentesf'];
            $model->telefonoemer=$data['telefonoemer'];
            $model->direccionemer=$data['direccionemer'];
            $model->usuariocreacion=Yii::$app->user->identity->id;
            $model->estatus="ACTIVO";
            $model->isDeleted=0;
            if ($model->save()) {
                $idusuario=$model->id;
                $error=false;
                //$this->callback(1,$idusuario,$model->errors);
                return array("response" => true, "id" => $model->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$idusuario,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Medico_consultamedica ",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function callback($tipo,$id,$error)
    {
        switch ($tipo) {
            case 1:


                $log= new Log_errores;
                $observacion="ID: ".$id;
                $log->Nuevo("USUARIO ",$error,$observacion,0,Yii::$app->user->identity->id);
                //return true;
                break;

            default:
                # code...
                break;
        }
    }



}