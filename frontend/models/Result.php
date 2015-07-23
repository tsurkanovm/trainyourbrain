<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "result".
 *
 * @property integer $idResult
 * @property integer $result
 * @property string $date_participate
 * @property string $idUser
 * @property integer $idTest
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['result', 'date_participate', 'idUser', 'idTest'], 'required'],
            [['result', 'idUser', 'idTest'], 'integer'],
            [['date_participate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idResult' => Yii::t('app', 'Id Result'),
            'result' => Yii::t('app', 'Result'),
            'date_participate' => Yii::t('app', 'Date Participate'),
            'idUser' => Yii::t('app', 'Id User'),
            'idTest' => Yii::t('app', 'Id Test'),
        ];
    }

    /**
     * @inheritdoc
     * @return ResultQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResultQuery(get_called_class());
    }
}
