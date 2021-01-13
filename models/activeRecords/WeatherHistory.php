<?php

namespace app\models\activeRecords;

use Yii;

/**
 * This is the model class for table "weather_history".
 *
 * @property int $id ID
 * @property float $temp Температура
 * @property string $date_at Дата
 */
class WeatherHistory extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weather_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['temp', 'date_at'], 'required'],
            [['temp'], 'number'],
            [['date_at'], 'safe'],
            [['date_at'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'temp'    => 'Температура',
            'date_at' => 'Дата',
        ];
    }

}
