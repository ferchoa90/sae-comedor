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
use common\models\Consultamedica;
use common\models\Consultamedicadet;
use common\models\Consultamedicadiag;
use common\models\Citasmedicas;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 13/03/21
 * Time: 14:55
 */

class Medico_diagnostico extends Component
{
    const MODULO='CONSULTA DIAGNOSTICO';

    public function getConsultamedica($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Consultamedicadiag::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Consultamedicadiag::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getDiagnostico($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result = Consultamedicadiag::find()->where(["isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["apellidos" => SORT_ASC])->one();
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
            $result = Consultamedicadiag::find()->where(["idpaciente"=>$idpaciente,"isDeleted" => 0,"estatus" => "ACTIVO"])->orderBy(["fechacreacion" => SORT_DESC])->all();
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
        $clientes = Consultamedicadiag::find()->where(["isDeleted" => 0])->orderBy(["apellidos" => SORT_ASC])->all();
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
        $model= new Consultamedicadiag;
        $result=false;
        $citamed=Citasmedicas::find()->where(["id" => $data['idcita']])->one();
        $consultamed=Consultamedica::find()->where(["idcitamedica" => $data['idcita']])->one();
        $consultameddiag=Consultamedicadiag::find()->where(["idconsulta" => $consultamed->id])->one();

        if ($consultameddiag){
            $data["id"]=$consultameddiag->id;
            $data["idant"]=$data["id"];
            $return=$this->Editar($data);
            return $return;
        }
        //var_dump($citamedica);
        if ($data && $consultamed):
            $model->idconsulta=$consultamed->id;
            $model->orbita=$data['orbita'];
            $model->globos=$data['globos'];
            $model->lagrim=$data['lagrimales'];
            $model->escler=$data['escler'];
            $model->conjunt=$data['conjunt'];
            $model->limbo=$data['limbo'];
            $model->parpados=$data['parpados'];
            $model->camant=$data['camant'];
            $model->iris=$data['iris'];
            $model->cornea=$data['cornea'];
            $model->presion=$data['presion'];
            $model->piocc=$data['piocc'];
            $model->reflpup=$data['reflejop'];
            $model->cristal=$data['cristal'];
            $model->midria=$data['midria'];
            $model->observacion=$data['obs1'];
            $model->metodo=$data['metodo'];
            $model->vitreo=$data['vitreo'];
            $model->papila=$data['papila'];
            $model->polpost=$data['polpos'];
            $model->macula=$data['macula'];
            $model->macula=$data['ecuador'];
            $model->macula=$data['vasos'];
            $model->perif=$data['perif'];
            $model->nervioopt=$data['nervioopt'];
            $model->observacion2=$data['obs2'];
            $model->visioncol=$data['visioncol'];
            $model->esteriopsis=$data['esteriopsis'];
            $model->ordenatencion=$data['ordenatencion'];
            $model->yaglaser=$data['yaglaser'];
            $model->segantodp=$data['odpotencia1'];
            $model->segantodd=$data['oddisparos1'];
            $model->segantidp=$data['oipotencia1'];
            $model->segantidd=$data['oidisparos1'];
            $model->compliant=$data['complicaciones1'];

            $model->segposodp=$data['odpotencia2'];
            $model->segaposodd=$data['oddisparos2'];
            $model->segposidp=$data['oipotencia2'];
            $model->segposidd=$data['oidisparos2'];
            $model->complipost=$data['complicaciones2'];

            $model->laserrodt=$data['odtamano1'];
            $model->laserrodti=$data['odtiempo1'];
            $model->laserrodn=$data['odnumero1'];
            $model->laserrodp=$data['odpoder1'];

            $model->laserroidt=$data['oitamano1'];
            $model->laserroiti=$data['oitiempo1'];
            $model->laserroin=$data['oinumero1'];
            $model->laserroip=$data['oipoder1'];
            $model->plan=$data['plan'];

            $model->med1=$data['medicamento1'];
            $model->presc1=$data['mprescripciono1'];
            $model->med2=$data['medicamento2'];
            $model->presc2=$data['mprescripciono2'];
            $model->med3=$data['medicamento3'];
            $model->presc3=$data['mprescripciono3'];
            $model->med4=$data['mprescripciono4'];
            $model->presc4=$data['medicamento4'];
            $model->med5=$data['mprescripciono5'];
            $model->presc5=$data['medicamento5'];


            $model->usuariocreacion=Yii::$app->user->identity->id;
            $model->estatus="ACTIVO";
            $model->isDeleted=0;
            if ($model->save()) {

                    $error=false;
                    $citamed->estatuscita="ATENDIDA";
                    //$citamed->save();
                    return array("response" => true, "id" => $model->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);

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

        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editar($data)
    {
        $id=0;
        $result=false;
        if ($data):
            $model= Consultamedicadiag::find()->where(["id"=>$data['id']])->one();
            $model->orbita=$data['orbita'];
            $model->globos=$data['globos'];
            $model->lagrim=$data['lagrimales'];
            $model->escler=$data['escler'];
            $model->conjunt=$data['conjunt'];
            $model->limbo=$data['limbo'];
            $model->parpados=$data['parpados'];
            $model->camant=$data['camant'];
            $model->iris=$data['iris'];
            $model->cornea=$data['cornea'];
            $model->presion=$data['presion'];
            $model->piocc=$data['piocc'];
            $model->reflpup=$data['reflejop'];
            $model->cristal=$data['cristal'];
            $model->midria=$data['midria'];
            $model->observacion=$data['obs1'];
            $model->metodo=$data['metodo'];
            $model->vitreo=$data['vitreo'];
            $model->papila=$data['papila'];
            $model->polpost=$data['polpos'];
            $model->macula=$data['macula'];
            $model->macula=$data['ecuador'];
            $model->macula=$data['vasos'];
            $model->perif=$data['perif'];
            $model->nervioopt=$data['nervioopt'];
            $model->observacion2=$data['obs2'];
            $model->visioncol=$data['visioncol'];
            $model->esteriopsis=$data['esteriopsis'];
            $model->ordenatencion=$data['ordenatencion'];
            $model->yaglaser=$data['yaglaser'];
            $model->segantodp=$data['odpotencia1'];
            $model->segantodd=$data['oddisparos1'];
            $model->segantidp=$data['oipotencia1'];
            $model->segantidd=$data['oidisparos1'];
            $model->compliant=$data['complicaciones1'];

            $model->segposodp=$data['odpotencia2'];
            $model->segaposodd=$data['oddisparos2'];
            $model->segposidp=$data['oipotencia2'];
            $model->segposidd=$data['oidisparos2'];
            $model->complipost=$data['complicaciones2'];

            $model->laserrodt=$data['odtamano1'];
            $model->laserrodti=$data['odtiempo1'];
            $model->laserrodn=$data['odnumero1'];
            $model->laserrodp=$data['odpoder1'];

            $model->laserroidt=$data['oitamano1'];
            $model->laserroiti=$data['oitiempo1'];
            $model->laserroin=$data['oinumero1'];
            $model->laserroip=$data['oipoder1'];
            $model->plan=$data['plan'];

            $model->med1=$data['medicamento1'];
            $model->presc1=$data['mprescripciono1'];
            $model->med2=$data['medicamento2'];
            $model->presc2=$data['mprescripciono2'];
            $model->med3=$data['medicamento3'];
            $model->presc3=$data['mprescripciono3'];
            $model->med4=$data['mprescripciono4'];
            $model->presc4=$data['medicamento4'];
            $model->med5=$data['mprescripciono5'];
            $model->presc5=$data['medicamento5'];

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
            $data= Consultamedicadiag::find()->where(["id"=>$id])->one();
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