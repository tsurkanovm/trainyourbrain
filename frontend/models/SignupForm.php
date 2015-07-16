<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class SignupForm extends Model{
    public $email;
    public $name;
    public $password;
    public $gender;


    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'name', 'gender', 'password'], 'required'],
            // email must be correct
            ['email', 'email'],
            // email is validated by validateEmail()
            ['email',  'validateEmail'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],

        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ( User::checkAuthKey( $this->password )) {
                $this->addError($attribute, 'Incorrect  password. Password should be more than 5 symbols.');
            }
        }
    }
    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ( $user ) {
                $this->addError($attribute, 'User with such e-mail already exist. Please, login.');
            }
        }
    }

    private function getUser(){

            return User::findByEmail( $this->email );

    }

    public function signup(){

        if( $this->validate() )
        {
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->psw = md5( $this->password );
            $user->gender = $this->gender;

            if ( $user->save() ) {
                return Yii::$app->getUser()->login( $user );
            }

        }

        return false;

    }

}
