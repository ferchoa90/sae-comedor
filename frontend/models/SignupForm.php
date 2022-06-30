<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $nombres;
    public $apellidos;
    public $cedula;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required','message' => 'Este campo es obligatorio.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'El nombre de usuario ya está tomado.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['nombres', 'trim'],
            ['nombres', 'required', 'message' => 'Este campo es obligatorio.'],
            ['nombres', 'string', 'min' => 2, 'max' => 100],

            ['apellidos', 'trim'],
            ['apellidos', 'required', 'message' => 'Este campo es obligatorio.'],
            ['apellidos', 'string', 'min' => 2, 'max' => 100],

            ['cedula', 'trim'],
            ['cedula', 'required', 'message' => 'Este campo es obligatorio.'],
            ['cedula', 'unique', 'targetClass' => '\common\models\User', 'message' => 'La cédula ya existe.'],
            ['cedula', 'string', 'min' => 10, 'max' => 10],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Este campo es obligatorio.'],
            ['email', 'email', 'message' => 'Ingrese un correo válido.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'El correo ingresado ya existe.'],

            ['password', 'required', 'message' => 'Este campo es obligatorio.'],
            ['password', 'string', 'min' => 6, 'message' => 'Debe ingresar mínimo 6 caracteres.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Usuario',
            'email' => 'Correo',
            'nombres' => 'Nombres Completos',
            'apellidos' => 'Apellidos',
            'cedula' => 'Cédula',
            'password' => 'Contraseña',
        ];
    }


    /** 
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->nombres = $this->nombres;
        $user->apellidos = $this->apellidos;
        $user->cedula = $this->cedula;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
