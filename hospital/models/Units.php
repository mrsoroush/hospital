<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hps_units".
 *
 * @property int $id
 * @property string $title
 */
class Units extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%units}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public function getUnits(){
        return $this->hasMany(Contents::className(), ['unit_id' => 'id']);
    }
}
