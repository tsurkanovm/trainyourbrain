<?php

namespace frontend\models;

use Yii;
use common\components\CustomVarDamp;

/**
 * This is the model class for table "test".
 *
 * @property integer $idTest
 * @property string $title
 * @property string $type
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['type'], 'string'],
            [['title'], 'string', 'max' => 20],
            [['title'], 'unique']
        ];
    }

    public function getBestResult()
    {
        $result = 0;
        $res_query = $this->hasOne(Result::className(), ['testid' => 'testid'])->andFilterWhere(['userid' => Yii::$app->user->id])->orderBy(['result' => SORT_ASC])->one();
        if ( $res_query !== null )
            $result = $res_query->result;


        return $result;

    }

    public function getLastResult()
    {
        $result = 0;
        $res_query = $this->hasOne(Result::className(), ['testid' => 'testid'])->andFilterWhere(['userid' => Yii::$app->user->id])->orderBy(['date_participate' => SORT_DESC])->one();
        if ( $res_query !== null )
            $result = $res_query->result;


        return $result;

    }
    //@todo rewrite accordingly to DRY principle
    public function getBestResultDate()
    {
        $result = Yii::t('app', 'not defined');
        $res_query = $this->hasOne(Result::className(), ['testid' => 'testid'])->andFilterWhere(['userid' => Yii::$app->user->id])->orderBy(['result' => SORT_ASC])->one();
        if ( $res_query !== null )
            $result = Yii::$app->formatter->asDate( $res_query->date_participate , 'medium' );


        return $result;

    }
    //@todo rewrite accordingly to DRY principle
    public function getLastResultDate()
    {
        $result = Yii::t('app', 'not defined');
        $res_query = $this->hasOne(Result::className(), ['testid' => 'testid'])->andFilterWhere(['userid' => Yii::$app->user->id])->orderBy(['date_participate' => SORT_DESC])->one();
        if ( $res_query !== null )
            $result = Yii::$app->formatter->asDate( $res_query->date_participate , 'medium' );


        return $result;

    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTest' => Yii::t('app', 'Id Test'),
            'title' => Yii::t('app', 'test name'),
            'type' => Yii::t('app', 'control test - launch after some days (5 by default) after usual test. Usual test user can launch every day without limitation'),
        ];
    }
}
