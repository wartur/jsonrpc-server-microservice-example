<?php

namespace app\controllers;

use JsonRpc2\Exception as JsonRpc2Exception;
use app\models\WeatherHistorySearchByDate;
use app\models\WeatherHistorySearchLastDays;

/**
 * Контроллер по протоколу JSON-RPC
 */
class ApiController extends \JsonRpc2\Controller
{

    /**
     * 
     * @param string $date дата, которую требуется запросить
     */
    public function actionWeatherGetByDate($date)
    {
        $model = new WeatherHistorySearchByDate();
        $model->date = $date;
        if (!$model->execute()) {
            throw new JsonRpc2Exception('Invalid params', JsonRpc2Exception::INVALID_PARAMS, $model->getErrors());
        }

        if (empty($model->result)) {
            throw new JsonRpc2Exception('Not Found', 404);
        } else {
            return $model->result;
        }
    }

    /**
     * Получить историю погоды
     * @param integer $lastDays
     */
    public function actionWeatherGetHistory($lastDays)
    {
        $model = new WeatherHistorySearchLastDays();
        $model->lastDays = $lastDays;
        if (!$model->execute()) {
            throw new JsonRpc2Exception('Invalid params', JsonRpc2Exception::INVALID_PARAMS, $model->getErrors());
        }

        if (empty($model->result)) {
            throw new JsonRpc2Exception('Not Found', 404);
        } else {
            return $model->result;
        }
    }

    /**
     * Тестовый метод
     */
    public function actionHelloWorld($message)
    {
        return ["message" => "hello " . $message];
    }

}
