<?php
/*
 * Рабочие модели
 */

namespace app\models;

use app\models\activeModels\WeatherHistory;

/**
 * Поиск погоды по последним N дням
 */
class WeatherHistorySearchLastDays extends \yii\base\Model
{

    /**
     * @var integer количество дней
     */
    public $lastDays;

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
            [['lastDays'], 'integer', 'min' => 1],
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

        $this->result = $query->orderBy('weather_history.date_at DESC')->limit($this->lastDays)->asArray()->all();
        return true;
    }

}
