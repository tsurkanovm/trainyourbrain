<?php

namespace frontend\models;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTest' => Yii::t('app', 'Id Test'),
            'title' => Yii::t('app', 'test name'),
            'type' => Yii::t('app', 'control test - launch after some days (5 by default) after usual test. Usual tets user can launch every day without limitation'),
        ];
    }
}
