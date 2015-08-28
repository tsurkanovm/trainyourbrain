<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;
use yii\helpers\VarDumper;

class SignupForm extends Model{
    public $email;
    public $name;
    public $password;
    public $gender;
    public $photo;


    public function rules()
    {
        return [
            [['email', 'name', 'password'], 'required', 'on' => 'register'],
            [['name'], 'required', 'on' => 'profile'],
            // email must be correct
            ['email', 'email'],
            // email must unique
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            // name must be without spaces
            ['name', 'trim'],

            ['gender', 'safe'],

            // password is the string with min length = 6
            ['password', 'string', 'min' => 6],

            // @todo add extention
            [['photo'], 'validatePhoto', 'skipOnEmpty' => true ]//, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024],

        ];
    }

        public function validatePhoto($attribute, $params)
    {


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


            if ( $user->save() ) {

                return Yii::$app->getUser()->login( $user );

            }

        }

        return false;

    }
    public function profile( ){
        $this->photo = UploadedFile::getInstance($this, 'photo');

        if( $this->validate() )
        {
            $user = Yii::$app->user->identity;
            if ($this->photo) {

                $photoPath = '/uploads/' . $user->userid . '.' . $this->photo->extension;
                $this->photo->saveAs( Yii::getAlias('@webroot') . $photoPath );
                $user->photo = $photoPath;
            }


            $user->gender = $this->gender;
            $user->name = $this->name;


            if ( $user->save( false ) ) {

                return true;

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
