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
use common\models\Pacientes;
use common\models\Consultamedica;
use common\models\Citasmedicas;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 13/03/21
 * Time: 14:55
 */

class Medico_pacientes extends Component
{
    const MODULO='PACIENTES';

    public function getPacientes($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Pacientes::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Pacientes::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getPaciente($id=0,$idcita=0,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($idcita){
            $citamedica=Citasmedicas::find()->where(["isDeleted" => 0,"id"=>$idcita])->one();
            $result = Pacientes::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO", "id"=>$citamedica->idusuario])->one();
            if ($result)
            {
                //$result=$result["nombres"].' '.$result["apellidos"].')';
                return $result;
            }else{
                $result="NINGUNO";
            }
        }else{
            if ($id){
                $result = Pacientes::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO", "id"=>$id])->one();
                return $result;
            }else{
                $result= false;
            }
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
        $clientes = Pacientes::find()->where(["isDeleted" => 0])->orderBy(["apellidos" => SORT_ASC])->all();
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
        $model= new Pacientes;
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
            $model->telefono=$data['telefono'];
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
            $log->Nuevo(self::MODULO." :: Medico_pacientes ",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editar($data)
    {
        $id=0;
        $result=false;
        if ($data):
            $model= Pacientes::find()->where(["id"=>$data['id']])->one();
            $model->nombres=$data['nombres'];
            $model->apellidos=$data['apellidos'];
            $model->cedula=$data['cedula'];
            $model->alerta=$data['alerta'];
            $model->idgenero=$data['genero'];
            $model->idciudad=$data['ciudad'];
            $model->idprofesion=$data['profesion'];
            $model->direccion=$data['direccion'];
            $model->correo=$data['correo'];
            $model->fechanac=$data['fechanac'];
            $model->tiposangre=$data['tiposangre'];
            $model->antecedentesp=$data['antecedentesp'];
            $model->antecedenteso=$data['antecedenteso'];
            $model->antecedentesf=$data['antecedentesf'];
            $model->enfermedada=$data['enfermedada'];
            $model->antecedentesf=$data['antecedentesf'];
            $model->telefonoemer=$data['telefonoemer'];
            $model->telefono=$data['telefono'];
            $model->direccionemer=$data['direccionemer'];
            $model->usuarioact=Yii::$app->user->identity->id;
            $model->fechaact= date("Y-m-d H:i:s");
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
            $log->Nuevo(self::MODULO." :: Medico_pacientes -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editarantecedentes($data)
    {
        $id=0;
        $result=false;
        if ($data):
            $model= Pacientes::find()->where(["id"=>$data['idpaciente']])->one();
            $model->antecedentesp=$data['antecedentesp'];
            $model->antecedenteso=$data['antecedenteso'];
            $model->antecedentesf=$data['antecedentesf'];
            $model->enfermedada=$data['enfermedada'];
            $model->antecedentesf=$data['antecedentesf'];
            $model->usuarioact=Yii::$app->user->identity->id;
            $model->fechaact= date("Y-m-d H:i:s");
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
            $log->Nuevo(self::MODULO." :: Medico_pacientes -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
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
            $data= Pacientes::find()->where(["id"=>$id])->one();
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
            $log->Nuevo(self::MODULO." :: Medico_pacientes -> eliminar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
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