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
            [['email', 'name', 'gender', 'password'], 'required'],
            // email must be correct
            ['email', 'email'],
            // email must unique
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            // name must be without spaces
            ['name', 'trim'],
            // password is the string with min length = 6
            ['password', 'string', 'min' => 6],

        ];
    }

//    public function validatePassword($attribute, $params)
//    {
//        if (!$this->hasErrors()) {
//            if ( User::checkAuthKey( $this->password )) {
//                $this->addError($attribute, 'Incorrect  password. Password should be more than 5 symbols.');
//            }
//        }
//    }
//    public function validateEmail($attribute, $params)
//    {
//        if (!$this->hasErrors()) {
//            $user = $this->getUser();
//            if ( $user ) {
//                $this->addError($attribute, 'User with such e-mail already exist. Please, login.');
//            }
//        }
//    }



    public function signup(){

        if( $this->validate() )
        {
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->psw =  $this->password;
            $user->gender = $this->gender;
           // $user->load(Yii::$app->request->post());

            if ( $user->save() ) {
                return Yii::$app->getUser()->login( $user );
            }

        }

        return false;

    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'E-mail address'),
        ];
    }
}
