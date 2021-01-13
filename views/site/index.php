<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>JSON-RPC-SERVER</h1>

        <p class="lead">Простая реализация сервера по протоколу <a href="https://www.jsonrpc.org/specification">JSON-RPC</a></p>

        <p>
            Он не имеет HTML представления. Пользуйтесь API:
        </p>
        <div class="well">
            <p>
                Поддерживаются следующие примеры:
                <br>{"jsonrpc": "2.0", "method": "weather-get-by-date", "params": {"date": "2020-02-30"}, "id": 1}
                <br>{"jsonrpc": "2.0", "method": "weather-get-history", "params": {"lastDays": 30}, "id": 1}
            </p>
            <hr>
            <p>
                Тестовая строка:
            <pre class="text-left"> 
[
  {
    "jsonrpc": "2.0",
    "method": "weather-get-by-date",
    "params": {
      "date": "2021-01-01"
    },
    "id": 1
  },
  {
    "jsonrpc": "2.0",
    "method": "weather-get-history",
    "params": {
      "lastDays": 30
    },
    "id": 2
  }
]
            </pre>
            </p>
        </div>
    </div>
</div>
