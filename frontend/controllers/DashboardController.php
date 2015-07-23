<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Result;
use frontend\models\DashboardForm;

class DashboardController extends \yii\web\Controller
{
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


}
