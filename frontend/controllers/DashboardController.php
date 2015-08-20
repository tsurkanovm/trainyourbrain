<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Result;
use frontend\models\DashboardForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class DashboardController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
        [
                        'actions' => ['logout'],
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
        $model = new DashboardForm( Yii::$app->user->id );

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['index', 'id' => $model->idResult]);
//
//        } else {
//            return $this->render('index', [
//                'model' => $model,
//            ]);
//        }
        return $this->render('index', ['model' => $model,]);
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
