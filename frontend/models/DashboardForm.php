<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\VarDumper;

class DashboardForm extends Model{
    public $name;
    public $user_id;
    public $gender;
    public $role;
    public $photo;
    public $settings;
    public $test1_name;
    public $test1_best_result;
    public $test1_best_result_date;
    public $test2_name;
    public $test2_best_result;
    public $test2_best_result_date;
    public $test3_name;
    public $test3_best_result;
    public $test3_best_result_date;
    public $test4_name;
    public $test4_best_result;
    public $test4_best_result_date;



    public function __construct( $user_id ){

        //Yii::$app->user->identity
        $this->user_id = $user_id;
        $this->refreshAttributes( );
    }

    private function refreshAttributes(){

        $_user = User::findIdentity( $this->user_id );
        $this->name = $_user->name;
        $this->gender = $_user->gender;
        $this->photo = $_user->photo;
        $this->role = $_user->role->title;
       // $this->settings = $_user->settings;
        $this->test1_name = Test::findOne(1)->title;
        $this->test2_name = Test::findOne(2)->title;
        $this->test3_name = Test::findOne(3)->title;
        $this->test4_name = Test::findOne(4)->title;
        $res_array = Result::find()->where(['user_id' => $_user->user_id, 'test_id' => 1 ])->orderBy('result')->one();
        $this->test1_best_result = $res_array['result'];
        $this->test1_best_result_date = $res_array['date_participate'];

    }

    public function attributeLabels()
    {
//        return [
//            'email' => Yii::t('app', 'E-mail address'),
//        ];
    }
}

// VarDumper::dump($_user);
//die;