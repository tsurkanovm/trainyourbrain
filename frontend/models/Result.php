<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "result".
 *
 * @property integer $result_id
 * @property integer $result
 * @property string $date_participate
 * @property string $user_id
 * @property integer $test_id
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%result}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['result', 'date_participate', 'user_id', 'test_id'], 'required'],
            [['result', 'user_id', 'test_id'], 'integer'],
            [['date_participate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'result_id' => Yii::t('app', 'Id Result'),
            'result' => Yii::t('app', 'Result'),
            'date_participate' => Yii::t('app', 'Date Participate'),
            'user_id' => Yii::t('app', 'Id User'),
            'test_id' => Yii::t('app', 'Id Test'),
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
