<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Users;

class SignupForm extends Model
{
    public $email;
    public $password;
    public $confirm_password;

    public function rules()
    {
        return [
            [['email', 'password', 'confirm_password'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\Users', 'message' => 'Email sudah terdaftar.'],
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Konfirmasi password tidak cocok.'],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new Users();
        $user->email = $this->email;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->role = 'user';
        $user->created_at = date('Y-m-d H:i:s');

        return $user->save() ? $user : null;
    }
}
