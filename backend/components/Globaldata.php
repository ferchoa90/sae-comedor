<?php
namespace backend\components;
use backend\models\User;
use backend\models\Configuracion;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
/**
 * Created by PhpStorm.
 * User: AndresGuerron
 * Date: 7/5/18
 * Time: 20:55
 */
class Globaldata extends Component
{    /**
     * Return the current date in DB format
     *
     * @return string
     */
    public function getEdad($fechanac='1990-01-01')
    {

        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fechanac), date_create($dia_actual));
        return $edad_diff->format('%y');
    }

    public static function getCurrentDateTime()
    {
        $date = date("Y-m-d H:i:s");
        return $date;
    }    /**
     * @param string $strFecha
     * @return string
     */
    public static function strToMysqlDateFormat($strFecha, $inFormat = "d/m/Y h:i A", $outFormat = "Y-m-d H:i:s")
    {
        $date = \DateTime::createFromFormat($inFormat, $strFecha);
        $mysql_date_string = $date->format($outFormat);        return $mysql_date_string;
    }    /**
     * @return string
     */
    public function getUid()
    {
        $model = User::findIdentity(Yii::$app->user->getId());
        return $model->uid;
    }    /**
     * @return bool
     */
    public function getIsUserAdminByUid()
    {
        if (User::findOne(['uid' => $this->getUid(), 'type' => 'ADMINISTRADOR', 'estado' => 'ACTIVO'])) {
            return true;
        } else {
            return false;
        }    }    /**
     * @return bool
     */
    public function getTkActive()
    {
        $model = Configuracion::findOne(['parametro' => 'api_key', 'estatus' => 'ACTIVE']);
        if ($model) {
            return $model->value;
        } else {
            return false;
        }    }    /**
     * @return bool
     */
    public static function getUserDataByUid($id)
    {
        $model = User::findOne(['uid' => $id, 'estatus' => 'ACTIVO']);
        if ($model) {
            return $model;
        } else {
            return false;
        }    }    /**
     * @return bool
     */
    public static function getUserDataById($id)
    {
        $model = User::findOne(['id' => $id, 'estatus' => 'ACTIVO']);
        if ($model) {
            /*$fullname = '';
            $nameParts = explode(" ", $model->nombre);
            $partes = count($nameParts);
            switch ($partes) {
                case 2:
                    $model->nombre = $nameParts[0];
                    $model->apellido = $nameParts[1];
                    break;
                case 3:
                    $model->nombre = $nameParts[0];
                    $model->apellido = $nameParts[2];
                    break;
                case 4:
                    $model->nombre = $nameParts[0];
                    $model->apellido = $nameParts[2];
                    break;
            }            $model->fullname = $model->nombre . " " . $model->apellido;*/            return $model;
        } else {
            return false;
        }    }    /**
     * @return bool
     */
    public function getUserData()
    {
        $model = User::findOne(['uid' => $this->getUid(), 'estado' => 'ACTIVO']);
        if ($model) {
            $fullname = '';
            $nameParts = explode(" ", $model->nombre);
            $partes = count($nameParts);
            switch ($partes) {
                case 2:
                    $model->nombre = $nameParts[0];
                    $model->apellido = $nameParts[1];
                    break;
                case 3:
                    $model->nombre = $nameParts[0];
                    $model->apellido = $nameParts[2];
                    break;
                case 4:
                    $model->nombre = $nameParts[0];
                    $model->apellido = $nameParts[2];
                    break;
            }            $model->fullname = $model->nombre . " " . $model->apellido;            return $model;
        } else {
            return false;
        }    }
    public static function generateID()
    {
        return self::create_guid();
    }    /**
     * This create a unique id for users
     * @return string
     */
    protected static function create_guid()
    {
        $microTime = microtime();
        list($a_dec, $a_sec) = explode(" ", $microTime);        $dec_hex = dechex($a_dec * 1000000);
        $sec_hex = dechex($a_sec);        self::ensure_length($dec_hex, 5);
        self::ensure_length($sec_hex, 6);        $guid = "";
        $guid .= $dec_hex;
        $guid .= self::create_guid_section(3);
        $guid .= '-';
        $guid .= self::create_guid_section(4);
        $guid .= '-';
        $guid .= self::create_guid_section(4);
        $guid .= '-';
        $guid .= self::create_guid_section(4);
        $guid .= '-';
        $guid .= $sec_hex;
        $guid .= self::create_guid_section(6);        return $guid;
    }    private static function create_guid_section($characters)
    {
        $return = "";
        for ($i = 0; $i < $characters; $i++)
            $return .= dechex(mt_rand(0, 15));        return $return;
    }    private static function ensure_length(&$string, $length)
    {
        $strlen = strlen($string);
        if ($strlen < $length) {
            $string = str_pad($string, $length, "0");
        } elseif ($strlen > $length) {
            $string = substr($string, 0, $length);
        }
    }}