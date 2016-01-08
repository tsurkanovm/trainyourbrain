<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $role_id
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
            [['role_id', 'title'], 'required'],
            [['role_id'], 'integer'],
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
            'role_id' => Yii::t('app', 'role_id'),
            'title' => Yii::t('app', 'Title'),
        ];
    }
}
