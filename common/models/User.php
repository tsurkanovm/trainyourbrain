<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use frontend\models\Role;
use yii\base\Event;

/**
 * User model
 *
 * @property integer $idUser
 * @property string $email
 * @property string $name
 * @property string $psw
 * @property string $settings
 * @property string $gender
 * @property integer $role_idrole
 * @property string (data) $registration_data
 * @property string  $photo
 */
class User extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'User';
    }


    public static function findIdentity($id)
    {
        return static::findOne(['idUser' => $id]);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }


    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }


    public function getId()
    {
        return $this->getPrimaryKey();
    }


    public function getAuthKey()
    {
        return $this->psw;
    }


    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === md5($authKey);


    }

    public static function checkAuthKey($authKey)
    {
        return  strlen( $authKey ) <= 5;
    }

    public function getRole()
    {
        return $this->hasOne(Role::className(), ['idrole' => 'role_idrole']);
    }



    public function init(){
        Event::on(User::className(), User::EVENT_BEFORE_INSERT, function ($event) {
            $event->sender->psw = md5($event->sender->psw);
        });
    }

}

