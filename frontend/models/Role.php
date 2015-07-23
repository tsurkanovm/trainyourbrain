<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $idrole
 * @property string $title
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idrole', 'title'], 'required'],
            [['idrole'], 'integer'],
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
            'idrole' => Yii::t('app', 'Idrole'),
            'title' => Yii::t('app', 'Title'),
        ];
    }
}
