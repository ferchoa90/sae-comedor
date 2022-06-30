<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $nombres
 * @property string $apellidos
 * @property string $tipo
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $fechacreacion
 * @property string $estatus
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['tipo', 'estatus'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['nombres', 'apellidos'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'tipo' => 'Tipo',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    public static function isUserClient($username)
    {
        if (static::findOne(['username' => $username, 'tipo' => 'Usuario'])) {

            return true;
        } else {

            return false;
        }

    }

    public static function isUserAdmin($username)
    {
        if (static::findOne(['username' => $username, 'tipo' => 'Administrador'])) {

            return true;
        } else {

            return false;
        }

    }
}
