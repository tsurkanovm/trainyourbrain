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
use common\components\CustomVarDamp;

class DashboardController extends \yii\web\Controller
{
    public function behaviors()
    {
        // @ todo - rewrite - now it's to clumsy
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'test', 'index', 'profile', 'viewResults'],
                'rules' => [
                    [
                        'actions' => ['logout', 'test', 'index', 'profile', 'results'],
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

        $dataProvider = new ActiveDataProvider([
            'query' => Test::find(),]);

        return $this->render('index',
            ['user_model' => $user_model,
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

    public function actionResults()
    {
        $testId = 0;
        $get_array = Yii::$app->request->get();

        if( isset( $get_array['testid'] ) )
            $testId = $get_array['testid'];

        $dataProvider = new ActiveDataProvider([
            'query' => Result::find()->andFilterWhere(['userid' => Yii::$app->user->id, 'testid' => $testId]),
            'pagination' => [
                'pageSize' => 2,
            ],]);

        return $this->render('results',
            ['dataProvider' => $dataProvider]);
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
