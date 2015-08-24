<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use frontend\models\Result;
use frontend\models\DashboardForm;
use frontend\models\SignupForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;
use yii\helpers\VarDumper;

class DashboardController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'test' , 'index' , 'profile'],
                'rules' => [
        [
                        'actions' => [ 'logout', 'test' , 'index', 'profile' ],
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

       $model = User::findIdentity( Yii::$app->user->id );

        $mainDashboardQuery = 'SELECT test.title, bestdate.maxdate as lastDate, result.result as lastResult, res.date_participate as bestDate,
        bestres.minres as bestResult  FROM (SELECT testid, max(date_participate) as maxdate FROM result where userid = :userId GROUP BY testid )as bestdate,
        (SELECT testid, min(result) as minres FROM result where userid = :userId GROUP BY testid )as bestres, result, result res,
        test where bestdate.testid = result.testid AND bestdate.maxdate = result.date_participate and bestres.testid = res.testid
        AND bestres.minres = res.result and bestdate.testid = bestres.testid and bestdate.testid = test.testid and res.userid = :userId and result.userid = :userId';

//        $count = Yii::$app->db->createCommand( 'SELECT COUNT(*) From (' . $mainDashboardQuery . ') countTable' , [':userId' => $model->getId()])->queryScalar();
//        $count = (int)$count;
        $dataProvider = new SqlDataProvider([
            'sql' => $mainDashboardQuery,
            'params' => [':userId' => $model->getId()],
     //       'totalCount' => $count,
        ]);
        return $this->render('index',
            ['model' => $model,
            'dataProvider' => $dataProvider]);
    }

    public function actionProfile( )
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
