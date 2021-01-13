<?php
/*
 * Рабочие модели
 */

namespace app\models;

use app\models\activeModels\WeatherHistory;

/**
 * Поиск погоды по дате
 */
class WeatherHistorySearchByDate extends \yii\base\Model
{

    /**
     * @var string дата на которую ищем
     */
    public $date;

    /**
     * @var array Результат
     */
    public $result;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'required'],
        ];
    }

    /**
     * Поиск
     * @return array
     */
    public function execute()
    {
        if (!$this->validate()) {
            return false;
        }

        // ну, я тут не стал усложнять, можно было через модели и модели сериализировать,
        // но это все крсивости и с виду по задаче не особо нужны,
        // да и жрало бы это лишних ресурсов в данном случае
        $query = WeatherHistory::find();

        // grid filtering conditions
        $query->andFilterWhere([
            'weather_history.date_at' => $this->date,
        ]);

        $this->result = $query->asArray()->one();
        return true;
    }

}
