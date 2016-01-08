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
        $test_id = 0;
        $get_array = Yii::$app->request->get();

        if( isset( $get_array['test_id'] ) )
            $test_id = $get_array['test_id'];

        $dataProvider = new ActiveDataProvider([
            'query' => Result::find()->andFilterWhere(['user_id' => Yii::$app->user->id, 'test_id' => $test_id]),
            'pagination' => [
                'pageSize' => 2,
            ],]);

        return $this->renderAjax('results',
            ['dataProvider' => $dataProvider]);
    }


    public function actionTest()
    {
        $test_id = 0;
        $get_array = Yii::$app->request->get();

        if( isset( $get_array['test_id'] ) )
            $test_id = $get_array['test_id'];

        return $this->render('test',
            ['user' => Yii::$app->user->id,
            'test' => $test_id]);
    }

    public function actionSetResult()
    {
        $results_model = new Result();
        $results_model->loadDefaultValues();
        $testing_results_arr =  ['Result' => Yii::$app->request->post()];
        if ( $results_model->load( $testing_results_arr ) && $results_model->save() ) {

            echo 1;
        }
        else{
            //@todo - design error page and redirect yere to this page with AR validate errors
                echo 0;
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
