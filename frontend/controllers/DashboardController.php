<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use frontend\models\Result;
use frontend\models\Test;
use frontend\models\SignupForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

class DashboardController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'test', 'index', 'profile'],
                'rules' => [
                    [
                        'actions' => ['logout', 'test', 'index', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        $user_model = User::findIdentity(Yii::$app->user->id);
        //$test_model = new Test();

        $dataProvider = new ActiveDataProvider([
            'query' => Test::find(),]);

        return $this->render('index',
            ['user_model' => $user_model,
       //         'test_model' => $test_model,
                'dataProvider' => $dataProvider]);
    }

    public function actionProfile()
    {
        $model = new SignupForm(['scenario' => 'profile']);
        if ($model->load(Yii::$app->request->post()) && $model->profile()) {
            return $this->redirect(['dashboard/index']);
        } else {
            return $this->render('profile', [
                'model' => $model,
            ]);
        }

    }

    public function actionTest()
    {
        return $this->render('test');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
